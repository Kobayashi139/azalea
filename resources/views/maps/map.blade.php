<x-app-layout>

        <div id="map" style="height:0px; width:0px;"></div>
        
        
            <input type="text" name="adress" value="東京都墨田区" id="address">
            <button type="button" id="search">検索</button>
        
        <div id="lat"></div>
            <div id="lng"></div>
        <script src="{{ asset('/js/map_search.js') }}"></script>
        <!--<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&callback=initMap" async defer></script>-->
        <div id="restaurants">
                
        </div>
        <!--レビュー一覧-->
        <!--<h1>Review List</h1>-->
        <!--<div class ='reviews'>-->
        <!--    @foreach ($reviews as $review)-->
        <!--        <div class='review'>-->
        <!--            <h2 class='store_name'>-->
        <!--                <a href="/maps/show/{{ $review->id }}">{{ $review->store_name }}</a>-->
                        <!-- データベース内のstore_nameを表示-->
        <!--            </h2>-->
        <!--        </div>-->
        <!--    @endforeach-->
        <!--</div>-->
        

    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&libraries=places&callback=initMap" async defer></script>
</x-app-layout>