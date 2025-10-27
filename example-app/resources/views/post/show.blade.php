<x-app-layout>
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            個別表示
        </h2>

        @if (session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @endif

        <div class="mt-6 p-6 bg-white rounded-2xl shadow-md border border-gray-200">
            <div class="mt-4 p-4">
                <p class="text-lg font-semibold">
                    {{ $post->title }}
                </p>
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('post.edit', $post) }}">
                        <button variant="primary" class="cursor-pointer">
                            編集
                        </button>
                    </a>

                    <form method="post" action="{{ route('post.destroy', $post) }}">
                        @csrf
                        @method('delete')
                        <button variant="danger" type="submit" class="cursor-pointer">
                            削除
                        </button>
                    </form>
                </div>
                <hr class="w-full">
                <p class="mt-4 whitespace-pre-line">
                    {{ $post->body }}
                </p>
                <div class="flex justify-end w-full text-sm font-semibold">
                    <p>{{ $post->created_at }}</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
