<x-app-layout>
    <body class="antialiased">
        <h1>{{ $name }}</h1>
        <div id="map" style="height:300px; width:500px;"></div>
        
            <input type="text" name="adress" value="{{ $name }}" id="address">
            <button type="button" id="search">検索</button>
 
        <div id="lat"></div>
            <div id="lng"></div>
        <script src="{{ asset('/js/map_search.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&callback=initMap" async defer></script>
        <div id="restaurants">
     
        <x-slot name="text-2"><h2>みんなの声</h2></x-slot>
        <div class ='reviews'>
            @foreach ($reviews as $review)
                @if ($review->store_name  === $name)
                <div class='review'>
                    <h2 class='store_name'>
                        <a href="/maps/show/{{ $review->id }}">{{ $review->body}}</a>
                        <!-- データベース内のstore_nameを表示-->
                    </h2>
                </div>
                @endif
            @endforeach

        </div>
        <h3>レビュー作成</h3>
        <form action="/reviews" method="POST">
            @csrf
            <div class="store_name">
                <h3>店名</h3>
                <input type="text" name="review[store_name]" placeholder="お店の名前" value="{{ $name }}" readonly/> 
                <p class="title_error" style="color:red">{{ $errors->first('review.store_name') }}</p>
            </div>
            <div class="body">
                <h3>評価</h3>
                <textarea name="review[body]" placeholder="お店の感想">{{ old('review.body') }}</textarea>
                <p class="title_error" style="color:red">{{ $errors->first('review.body') }}</p>
            </div>
            <input type="submit" value="保存" />
            <!--保存と同時に画面が移動する原因がわからない、"/"に戻ってしまう-->
        </from>
        
            <div class="footer">
               <a href="/">戻る</a>
            </div>
        </div>
    </body>
</x-app-layout>
