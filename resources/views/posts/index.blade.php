@extends('layouts.main')

@section('content')

    <h1 class="text-5xl font-bold text-center p-4">All Posts</h1>

    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection