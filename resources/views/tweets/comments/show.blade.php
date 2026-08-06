<!-- resources/views/tweets/comments/show.blade.php -->

<x-layouts::app :title="__('コメント詳細')">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
        {{ __('コメント詳細') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">Tweetに戻る</a>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $tweet->tweet }}: {{ $tweet->user->name }}</p>
                    <p class="text-gray-800 dark:text-gray-300 text-lg">{{ $comment->comment }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $comment->user->name }}</p>
                    <div class="text-gray-6000 dark:text-gray-400 text-sm">
                        <p>コメント作成日時: {{ $comment->created_at->format('Y-m-d H:i') }}</p>
                        <p>コメント更新日時: {{ $comment->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    @if (auth()->id() === $comment->user_id)
                    <div class="flex mt-4">
                        <a href="{{ route('tweets.comments.edit', [$tweet, $comment]) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
                        <form action="{{ route('tweets.comments.destroy', [$tweet, $comment]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>