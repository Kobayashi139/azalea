<!DOCTYPE HTML>
<html lang="{{ str_replace( '_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Map</title>
        <!-- Fonts -->
        <link href ="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
    </head>
    
    <body>
        <h1 class="title">
            {{ $review->store_name }}
        </h1>
        <div class ='content'>
            <div class='content__review'>
                <h3>評価</h3>
                <p>{{ $review->body }}</p>
            </div>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </div>
    </body>
</html>