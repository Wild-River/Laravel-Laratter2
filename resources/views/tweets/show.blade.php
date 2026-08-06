<!-- resources/views/tweets/show.blade.php -->

<x-layouts::app :title="__('Tweet詳細')">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
        {{ __('Tweet詳細') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tweets.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">一覧に戻る</a>
                    <p class="text-gray-800 dark:text-gray-300 text-lg">{{ $tweet->tweet }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">投稿者: {{ $tweet->user->name }}</p>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">
                        <p>作成日時: {{ $tweet->created_at->format('Y-m-d H:i') }}</p>
                        <p>更新日時: {{ $tweet->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <!--ログインしているユーザーとツイート投稿者が同じ場合のみ表示-->
                    @if (auth()->id() === $tweet->user_id)
                    <div class="flex mt-4">
                        <a href="{{ route('tweets.edit', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
                        <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                        </form>
                    </div>
                    @endif

                    <div class="flex mt-4">
                        @if ($tweet->likedByUsers->contains(auth()->id()))
                        <form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">♥ {{$tweet->likedByUsers->count()}}</button>
                        </form>
                        @else
                        <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-red-500">♡ {{$tweet->likedByUsers->count()}}</button>
                        </form>
                        @endif
                    </div>

                    <div class="mt-4">
                        <p class="text-gray-600 dark:text-gray-400 ml-4">comment {{ $tweet->comments->count() }}</p>
                        <a href="{{ route('tweets.comments.create', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">コメントする</a>
                    </div>

                    <div class="mt-4">
                        @foreach ($tweet->comments as $comment)
                        <a href="{{ route('tweets.comments.show', [$tweet, $comment]) }}">
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-2 mb-2 hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded">
                                <p class="text-gray-800 dark:text-gray-300">{{ $comment->comment }}</p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $comment->user->name }} • {{ $comment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layouts::app>