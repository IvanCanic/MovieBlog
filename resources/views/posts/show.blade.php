@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="vv-container">
    <div class="posts">
        <article class="single">
            <div class="post-image"><img src="{{asset('/storage/'. $post->image)}}" alt="{{$post->title . ' image'}}"></div>
            <div class="text">
                <h2 class="post-title">{{$post->title}}</h2>
                <div class="post-meta"><a href="{{route('author', $post->user->id)}}">{{$post->user->name}}</a> | {{$post->created_at}}</div>
                <div class="categories">

                <a href="{{route('category', $post->category->id)}}" class="category-link">{{$post->category->name}}</a>

                </div>
                <div class="post-text">{{$post->description}}</div>
                @if($post->youtube_url)
                <div class="video">
                    <iframe width="100%" styles="margin:auto;" height="350" src="{{$post->youtube_url}}"></iframe> 
                </div>
                @endif
            </div>
            @auth()
            @if(Auth::user()->id == $post->user->id)
            <div class="post-auth">
                <a href="{{route('edit-post', $post->id)}}" class="vv-btn">Edit Post</a>
                <form action="{{route('delete-post', $post->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete Post" class="vv-btn">
                </form>
            </div>
            @endif
            @endauth
            <hr>
            <div class="comments">
                <div class="create-comments">
                    <form action="{{route('post-comment')}}" method="post">
                        @csrf
                        @if(Auth::guest())
                        <div>
                            <label for="name">Vase ime</label>
                            <input type="text" name="name">
                        </div>
                        @endif
                        @if(Auth::user())
                        <input type="hidden" name="user_name" value="{{Auth::user()->name}}">
                        @endif
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div>
                            <label for="comment">Vas komentar</label>
                            <textarea name="comment"></textarea>
                            @error('comment') <div class="vv-error"> {{ $message }} </div> @enderror
                        </div>
                        <input type="submit" class="vv-btn" value="Sacuvaj komentar">
                    </form>
                </div>
                <hr>
                <div class="show-comments">
                @if($post->comments)
                    @foreach($post->comments as $comment)
                    <div class="comment">
                        @auth
                        <div class="x">
                            <form action="{{route('delete-comment', $comment->id )}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="x">
                            </form>
                        </div>
                        @endauth
                        <div class="comment-meta">
                            <span class="name">{{$comment->name}}</span> posted at <small>{{$comment->created_at}}</small>
                        </div>
                        <hr>
                        <p>{{$comment->comment}}</p>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </article>
        <aside>
            @include('includes.aside')
        </aside>
    </div>
</section>
@endsection