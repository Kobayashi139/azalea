<!DOCTYPE html>
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
            <input type="text" size="55" id="search" value="池袋駅付近のカフェ" />
            <input type="button" size="55" value="検索" onClick="SearchGo()" />
            <div id="map_canvas" style="width: 100%; height: 90%;"></div>
        </form>
        
        <script src="{{ asset('/public/js/map_search.js') }}"></script>
        <script type="text/javascript" script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&libraries=places" charset="utf-8"></script>
 
    </body>
</html>