<!DOCTYPE html>
<html lang="{{ str_replace( '_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Review</title>
        <!-- Fonts -->
        <link href ="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
    </head>
    
    <body>
        <h1>レビュー作成</h1>
        <form action="/reviews" method="POST">
            @csrf
            <div class="store_name">
                <h2>店名</h2>
                <input type="text" name="review[store_name]" placeholder="お店の名前" value="{{ $name }}"/> 
                <p class="title_error" style="color:red">{{ $errors->first('review.store_name') }}</p>
            </div>
            <div class="body">
                <h2>評価</h2>
                <textarea name="review[body]" placeholder="お店の感想">{{ old('review.body') }}</textarea>
                <p class="title_error" style="color:red">{{ $errors->first('review.body') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </from>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </div>
    </body>
</html>