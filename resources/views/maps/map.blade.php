<x-app-layout>

    <div id="headline">
        <h1>検索する地域を入力してください</h1>
        <div id="map" class=hidden></div>
        <div class="address_search">
            <input type="text" name="adress" value="東京都墨田区" id="address">
            <button type="button" id="search">検索</button>
        </div>
    </div>
    <div id="lat" class=hidden></div>
    <div id="lng" class=hidden></div>
    <script src="{{ asset('/js/map_search.js') }}"></script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&callback=initMap" async defer></script>-->
    <div class="strname" id="restaurants">
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&libraries=places&callback=initMap" async defer></script>
</x-app-layout>