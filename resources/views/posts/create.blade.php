@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="vv-container">
    <div class="posts">
        <article class="single">
            <!-- Make a new post-->
            <h2>Create a new post</h2>
            <form action="{{route('save-post')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Ime filma:</label>
                <input type="text" id="title" name="title" value="{{old('title')}}" required>
                @error('title') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <label for="description">Opis:</label>
                <textarea name="description" required>{{old('description')}}</textarea>
                @error('description') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <label for="youtube_url">Embed trejler:</label>
                <input type="text" id="youtube_url" name="youtube_url" value="{{old('youtube_url')}}" placeholder="https://www.youtube.com/embed/UWwt7leeJ7I">
                @error('youtube_url') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <p>Odaberi kategoriju:</p>
                @foreach($categories as $category)
                <div>
                    <input type="radio" name="category_id" id="category[{{$category->id}}]" value="{{$category->id}}" 
                    @if(old('category_id') == $category->id) checked @endif
                    required>
                    <label for="category[{{$category->id}}]">{{$category->name}}</label>
                </div>
                @endforeach
                @error('category_id') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <div>
                <label for="image">Uploaduj glavnu sliku</label>
                <input type="file" name="image">
                @error('image') <div class="vv-error"> {{ $message }} </div> @enderror
            </div>
            <button type="submit" class="vv-btn">Sacuvaj post</button>
            </form>
        </article>
        <aside>
        @include('includes.aside')
        </aside>
    </div>
</section>
@endsection