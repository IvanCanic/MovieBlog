@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="vv-container">
    <div class="posts">
        <article class="single">
            <!-- Make a new post-->
            <h2>Create a new post</h2>
            <form action="{{route('update-post', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div>
                <label for="title">Ime filma:</label>
                <input type="text" name="title" value="{{$post->title}}" required>
                @error('title') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <label for="description">Opis:</label>
                <textarea name="description" required>{{$post->description}}</textarea>
                @error('description') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <label for="youtube_url">Embed trejler:</label>
                <input type="text" id="youtube_url" name="youtube_url" value="{{$post->youtube_url}}" placeholder="https://www.youtube.com/embed/UWwt7leeJ7I">
                @error('youtube_url') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <p>Odaberi kategoriju:</p>
                @foreach($categories as $category)
                <div>
                    <input type="radio" name="category_id" id="category[{{$category->id}}]" value="{{$category->id}}" 
                    @if($post->category_id == $category->id) checked @endif
                    required>
                    <label for="category[{{$category->id}}]">{{$category->name}}</label>
                </div>
                @endforeach
                @error('category_id') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <label for="image">Promeni sliku</label>
                <input type="file" name="image" value="{{$post->image}}">
                @error('image') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <button type="submit" class="vv-btn">Sacuvaj izmene</button>
            </form>
        </article>
        <aside>
        @include('includes.aside')
        </aside>
    </div>
</section>
@endsection