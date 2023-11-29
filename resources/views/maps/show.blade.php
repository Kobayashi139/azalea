<x-app-layout>
    <body>
        <h1 class="title">
            {{ $review->store_name }}
        </h1>
        <div class ='content'>
            <div class='content__review'>
                <h3>レビュー</h3>
                <p>{{ $review->body }}</p>
            </div>
            <div class="edit"><a href="/reviews/{{ $review->id }}/edit">投稿を編集</a></div>
            <div class="footer">
                <a href="/reviews/create/{{ $review->store_name }}">戻る</a>
            </div>
        </div>
    </body>
</x-app-layout>