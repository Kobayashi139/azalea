<?php

//検索場所
$address = $_GET["address"];
//検索キーワード
$keyword = $_GET["keyword"];
//検索範囲(メートル)
$radius = $_GET["radius"];

//店舗情報取得
$resultHTML = getPlace($address, $keyword, $radius);
//HTMLを返却
echo $resultHTML;

function getPlace($address, $keyword, $radius){
    // APIキー
    $apiKey = 'AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ';
    
    //Geocoding API
    $geocodeApiUrl = "https://maps.googleapis.com/maps/api/geocode/json";
    $geocodeApiUrl .= "?key=" . $apiKey;
    $geocodeApiUrl .= "&address=" . urlencode($address);
    
    //Geocoding にリクエスト
    $context = stream_context_create(array(
        'http' => array('ignore_errors' => true)
    ));
    $geocodeJson = file_get_contents($geocodeApiUrl, false, $context);
    
    //JSON文字列をデコードして連想配列にする
    $geocodeData = json_decode($geocodeJson, true);
    
    //緯度・経度の取得
    if ($geocodeData["status"] == "OK"){
        
        $lat = $geocodeData["results"][0]["geometry"]["location"]["lat"];
        $lng = $geocodeData["results"][0]["geometry"]["location"]["lng"];
        
    } else if($geocodeData["status"] == "ZERO_RESULTS") {
      return "【Geocoding API】検索結果が0件です。";
    } else if($geocodeData["status"] == "ERROR") {
      return "【Geocoding API】サーバ接続に失敗しました。";
    } else if($geocodeData["status"] == "INVALID_REQUEST") {
      return "【Geocoding API】リクエストが無効でした。";
    } else if($geocodeData["status"] == "OVER_QUERY_LIMIT") {
      return "【Geocoding API】リクエストの利用制限回数を超えました。";
    } else if($geocodeData["status"] == "REQUEST_DENIED") {
      return "【Geocoding API】サービスが使えない状態でした。";
    } else if($geocodeData["status"] == "UNKNOWN_ERROR") {
      return "【Geocoding API】原因不明のエラーが発生しました。";
    }
    
    //【Places API】検索エリアのお店情報取得
    $placeApiUrl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json";
    $placeApiUrl .= "?key=" . $apiKey;
    $placeApiUrl .= "&location=" . $lat . "," . $lng;
    $placeApiUrl .= "&radius=" . $radius;
    $placeApiUrl .= "&types=restaurant";
    $placeApiUrl .= "&keyword=" . urlencode($keyword);
    $placeApiUrl .= "&language=ja";
     //Places APIにリクエスト
  $context = stream_context_create(array(
    'http' => array('ignore_errors' => true)
  ));
  $placeJson = file_get_contents($placeApiUrl, false, $context);
  
  //JSON文字列をデコードして連想配列にする
  $placeData = json_decode($placeJson, true);
  
  //お店情報取得
  $placesList = array();
  $nextPageToken = null;
  if ($placeData["status"] == "OK"){
    
    //resultsをplacesList配列にマージ
    $placesList = array_merge($placesList, $placeData["results"]);
    //next_page_tokenを取得
    $nextPageToken = $placeData["next_page_token"];
    
  } else if($placeData["status"] == "ZERO_RESULTS") {
    return "【Places API】検索結果が0件です。";
  } else if($placeData["status"] == "ERROR") {
    return "【Places API】サーバ接続に失敗しました。";
  } else if($placeData["status"] == "INVALID_REQUEST") {
    return "【Places API】リクエストが無効でした。";
  } else if($placeData["status"] == "OVER_QUERY_LIMIT") {
    return "【Places API】リクエストの利用制限回数を超えました。";
  } else if($placeData["status"] == "REQUEST_DENIED") {
    return "【Places API】サービスが使えない状態でした。";
  } else if($placeData["status"] == "UNKNOWN_ERROR") {
    return "【Places API】原因不明のエラーが発生しました。";
  }
  
  //next_page_tokenが取得された場合は次ページあり。
  //next_page_tokenが取得できなくなるまで、
  //次ページ情報の取得を繰り返す。
  while (empty($nextPageToken) == false){
    //2秒程間隔をおく（連続リクエストすると取得に失敗する）
    sleep(2);
    
    //【Places API】次ページのお店情報取得
    $placeApiUrl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json";
    $placeApiUrl .= "?key=" . $apiKey;
    $placeApiUrl .= "&pagetoken=" . $nextPageToken;
    
    //Places APIにリクエスト
    $context = stream_context_create(array(
      'http' => array('ignore_errors' => true)
    ));
    $placeJson = file_get_contents($placeApiUrl, false, $context);
    
    //JSON文字列をデコードして連想配列にする
    $placeData = json_decode($placeJson, true);
    
    if ($placeData["status"] == "OK"){
      
      //resultsをplacesList配列にマージ
      $placesList = array_merge($placesList, $placeData["results"]);
      //next_page_tokenを取得
      $nextPageToken = $placeData["next_page_token"];
      
    } else {
      $nextPageToken = null;
    }
    }
  
  //ソートを正しく行うため、
  //ratingが設定されていないものを
  //一旦「-1」に変更する。
  for ($i = 0; $i < count($placesList); $i++) {
    if (isset($placesList[$i]["rating"]) == false){
      $placesList[$i]["rating"] = -1;
    }
  }
  
  //ratingの降順でソート（多次元連想配列のソート）
  foreach ((array) $placesList as $key => $value) {
    $sort[$key] = $value['rating'];
  }
  array_multisort($sort, SORT_DESC, $placesList);
  
  //placesList配列をループして
  //結果表示のHTMLタグを組み立てる
  $resultHTML = "<ol>\n";
  
  for ($i = 0; $i < count($placesList); $i++) {
    $name = $placesList[$i]["name"];
    $vicinity = $placesList[$i]["vicinity"];
    $rating = $placesList[$i]["rating"];
    
    //ratingが-1のものは「---」に表示変更
    if ($rating == -1) $rating = "---";
    
    //表示内容（評価＋名称）
    $content = "【" . $rating . "】 " . $name;
    
    //詳細表示のリンク作成
    $resultHTML .= "<li>\n";
    $resultHTML .= "<a href=\"https://maps.google.co.jp/maps?q=" . urlencode($name . " " . $vicinity) . "&z=15&iwloc=A\"";
    $resultHTML .= " target=\"_blank\">" . $content . "</a>\n";
    $resultHTML .= "</li>\n";
  }
  
  $resultHTML .= "</ol>";
  
  return $resultHTML;

}
?>