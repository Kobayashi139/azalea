<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function index(){
       return view('/maps/map_search');
       
    }
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
    
        return view('maps.map_search', compact('restaurants'));
    }
    public function review(Review $review)
    {
        return view('maps.map')->with(['reviews' => $review->get()]);
    }
    
    public function show(Review $review)
    {
        return view('maps.show')->with(['review' => $review]);
    }
    
    public function create($name, Review $review)
    {
        return view('maps.create')->with(['name' => $name ,'reviews' => $review->get()]);
    }
    
    public function store( Review $review, ReviewRequest $request)
    {  
        $url = url()->previous();
        $input = $request['review'];
        $review->fill($input)->save(); //前回取得したURLをもう一度表示する
        return redirect($url);
    }
    
    public function edit(Review $review)
    {
        return view('maps.edit')->with(['review' => $review]);
        // $url = url()->previous();
        // $input = $request['review'];
        // $review->fill($input)->save(); //前回取得したURLをもう一度表示する
        // return redirect($url);
        
    }
    
    public function update(ReviewRequest $request, Review $review)
    {
        $input_review = $request['review'];
        $review->fill($input_review)->save();
        return redirect('/maps/show/' . $review->id);
    }

}