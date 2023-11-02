<!DOCTYPE HTML>
<html lang="{{ str_replace( '_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Map</title>
        <!-- Fonts -->
        <link href ="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
    </head>
    
    <body class="antialiased">
        <div id="map" style="height:500px; width:800px;"></div>
        
        <form>
            <input type="text" name="adress" value="東京都墨田区押上1丁目1-2" id="address">
            <button type="button" id="button">検索</button>
        </form>
        
        <script src="{{ asset('/js/map.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&callback=initMap" async defer></script>
        
        <h1>Review List</h1>
        <div class ='reviews'>
            @foreach ($reviews as $review)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/maps/show/{{ $review->id }}">{{ $review->store_name }}</a>
                        <!-- データベース内のstore_nameを表示-->
                    </h2>
                </div>
            @endforeach
        </div>
        
        <a href='/maps/create'>レビューの作成</a>
    </body>
</html>