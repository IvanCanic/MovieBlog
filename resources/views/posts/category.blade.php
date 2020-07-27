@extends('layouts.app')

@section('title', 'Category')

@section('content')
<section class="vv-container">
    <div class="posts">
        @if($category->count() > 0)
        @foreach($category as $cat)
            @foreach($cat as $post)
            <article>
                <div class="post-image"><img src="{{asset('storage/' . $post->image)}}" alt="{{$post->title . ' image'}}"></div>
                <div class="text">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <div class="post-meta"><a href="{{route('author', $post->user->id )}}">{{$post->user->name}}</a> | {{$post->created_at}}</div>
                    <div class="categories">
                    <a href="{{route('category', $post->category->id)}}" class="category-link">{{$post->category->name}}</a>
                    </div>
                    <div class="post-text">{{  substr($post->description, 0, 200) . '...' }}</div>
                    <a href="{{route('single-post', $post->id )}}" class="vv-btn">Prikazi vise</a>
                </div>
            </article>
            @endforeach
        @endforeach
        @endif
    </div>
</section>
@endsection