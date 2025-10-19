@extends('layouts.main')

@section('content')

    <h1 class="text-5xl font-bold text-center p-4">All Posts</h1>

    <div class="flex gap-5 justify-between flex-wrap">
        {{-- @foreach ($posts as $post)
        @include('components.cards.post')
        @endforeach --}}

        {{-- @each('components.cards.post', $posts, 'post') --}}


        @foreach ($posts as $post)



            <x-cards.post :$loop :post="$post" showReactions="{{ $post->reactions_count > 0 }}">
                @if (strlen($post->title) > 30)
                    <p>{{ substr($post->title, 0, 30) }}...</p>
                @else
                    <p>{{ $post->title }}</p>
                @endif

                <x-alert-component>
                    {{ $post->body }}
                </x-alert-component>
            </x-cards.post>

        @endforeach
    </div>

    <div class="flex gap-5 justify-center flex-wrap my-4 ">
        {{ $posts->onEachSide(2)->links() }}
    </div>


@endsection