@extends('layouts.main')

@section('meta-description', $post->title)

@section('content')
    <h1 class="text-5xl font-bold text-center p-4">{{ $post->title }}</h1>
@endsection