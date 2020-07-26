@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="vv-container">
    <div class="posts">
        @if($posts->count() > 0)
        @foreach($posts as $key => $post)
        <article>
            <div class="post-image"><img src="{{asset('storage/' . $post->image)}}" alt="{{$post->title . ' image'}}"></div>
            <div class="text">
                <h2 class="post-title">{{ $post->title }}</h2>
                <div class="post-meta"><a href="{{route('author', $post->user->id )}}">{{$post->user->name}}</a> | {{$post->created_at->format('d/m/Y')}}
                | {{$post->comments->count()}} @if($post->comments->count() == 1) komentar @else komentara @endif
                </div>
                <div class="categories">
                    <a href="{{route('category', $post->category->id)}}" class="category-link">{{$post->category->name}}</a>
                </div>
                
                <div class="post-text">{{  substr($post->description, 0, 200) . '...' }}</div>
                <a href="{{route('single-post', $post->id )}}" class="vv-btn">Prikazi vise</a>
            </div>
        </article>
        @endforeach
        @endif
        <!--
        <article>
            <div class="post-image"><img src="/images/movie2.jpg" alt=""></div>
            <div class="text">
                <h2 class="post-title">Moj prvi post</h2>
                <div class="post-meta"><a href="">Author</a> | 11.11.2011</div>
                <div class="post-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</div>
                <a href="" class="vv-btn">Prikazi vise</a>
            </div>
        </article>
        <article>
            <div class="post-image"><img src="/images/movie3.jpg" alt=""></div>
            <div class="text">
                <h2 class="post-title">Moj prvi post</h2>
                <div class="post-meta"><a href="">Author</a> | 11.11.2011</div>
                <div class="post-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</div>
                <a href="" class="vv-btn">Prikazi vise</a>
            </div>
        </article>
        <article>
            <div class="post-image"><img src="/images/movie1.jpg" alt=""></div>
            <div class="text">
                <h2 class="post-title">Moj prvi post</h2>
                <div class="post-meta"><a href="">Author</a> | 11.11.2011</div>
                <div class="post-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</div>
                <a href="" class="vv-btn">Prikazi vise</a>
            </div>
        </article>
        <article>
            <div class="post-image"><img src="/images/movie2.jpg" alt=""></div>
            <div class="text">
                <h2 class="post-title">Moj prvi post</h2>
                <div class="post-meta"><a href="">Author</a> | 11.11.2011</div>
                <div class="post-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</div>
                <a href="" class="vv-btn">Prikazi vise</a>
            </div>
        </article>
        -->
    </div>
    <div class="vv-pagination">{{$posts->links()}}</div>
</section>
@endsection