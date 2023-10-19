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
        
        <form action="/search" method="post">
            
            <input type="text" size="55" id="location" name="location" value="池袋駅付近のカフェ" />
            <input type="button" size="55" value="検索"  />
            <div id="map_canvas" style="width: 100%; height: 90%;"></div>
        </form>
        @if(isset($restaurants) && count($restaurants) > 0)
            <div id="restaurant-list">
                <h2>Restaurants in the Area</h2>
                <ul>
                    @foreach ($restaurants as $restaurant)
                        <li>{{ $restaurant->name }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <p>No restaurants found in the area.</p>
        @endif
      
        <script type="text/javascript" script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDec7mudcnoMhynGZbFhZAefE85sce6_NQ&libraries=places" charset="utf-8"></script>
        <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 37.7749, lng: -122.4194 }, // マップの初期位置
                zoom: 10 // ズームレベル
            });
        
          
        }
        </script>
    </body>
</html>