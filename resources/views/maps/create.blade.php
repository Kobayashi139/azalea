<x-app-layout>
    <body class="antialiased">
        <h1>{{ $name }}</h1>
        <div id="map"></div>
        <input type="text" name="adress" value="{{ $name }}" id="address" class=hidden>
        <button type="button" id="search" class=hidden>検索</button>
        <div id="lat" class=hidden></div>
        <div id="lng" class=hidden></div>
        
        <script src="{{ asset('/js/map_search.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&callback=initMap" async defer></script>
        <div id="restaurants">
     
        <div class ='reviews'>
            <div class="title1">
                <h2>レビュー</h2>
            </div>
            @foreach ($reviews as $review)
                @if ($review->store_name  === $name)
                <div class='review'>
                    <h2 class='store_name'>
                        <a href="/maps/show/{{ $review->id }}" >{{ $review->body}}</a>
                        <!-- データベース内のstore_nameを表示-->
                    </h2>
                </div>
                @endif
            @endforeach
        </div>
        
        <div class="title2">
            <h3>レビュー作成</h3>
        </div>
        <form action="/reviews" method="POST">
            <div class="reviewpost">
                @csrf
                <div class="store_name">
                    <input type="text" name="review[store_name]" value="{{ $name }}" readonly/> 
                    <p class="title_error" style="color:red">{{ $errors->first('review.store_name') }}</p>
                </div>
                <div class="body">
                    <h3>レビューを記入</h3>
                    <textarea name="review[body]" placeholder="おいしかった！">{{ old('review.body') }}</textarea>
                    <p class="title_error" style="color:red">{{ $errors->first('review.body') }}</p>
                </div>
                <input type="submit" value="保存" />
            </div>
        </from>
            <div class="footer">
               <a href="/">戻る</a>
            </div>
        </div>
    </body>
</x-app-layout>
