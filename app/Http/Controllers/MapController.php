<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Post $post){
        return view('maps.map')->with(['posts' => $post->getByLimit()]);
       
    }
    /*
    public function search(Request $request)
    {
        $location = $request->input('location');
        $apiKey = 'YOUR_GOOGLE_PLACES_API_KEY';
    
        // Google Places APIを呼び出して飲食店情報を取得
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
            'query' => [
                'query' => 'restaurants in ' . $location,
                'key' => $apiKey,
            ],
        ]);
    
        $data = json_decode($response->getBody());
    
        // 取得した飲食店情報をビューに渡す
        $restaurants = $data->results;
    
        return view('/maps/map_search', compact('restaurants'));
    }
    */
}
