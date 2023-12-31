<x-app-layout>
    <body>
        <h1 class="title">レビューの編集</h1>
        <div class ='content'>
            <form action="/reviews/{{ $review->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="store_name">
                    <h2>店名</h2>
                    <input type="text" name="review[store_name]" placeholder="お店の名前" value="{{ $review->store_name }}"/> 
                    <p class="title_error" style="color:red">{{ $errors->first('review.store_name') }}</p>
                </div>
                <div class="body">
                    <h2>評価</h2>
                    <textarea name="review[body]" placeholder="お店の感想">{{ $review->body}}</textarea>
                    <p class="title_error" style="color:red">{{ $errors->first('review.body') }}</p>
                </div>
                <input type="submit" value="保存"/>
            </form>
            <div class="footer">
                <a href="/maps/show/{{ $review->id}}">戻る</a>
            </div>
            <div class="blank"></div>
        </div>
    </body>
</x-app-layout>