@extends('layouts.app')

@section('title', 'Make a category')

@section('content')
<section class="vv-container">
    <div class="posts">
        <article class="single">
            <!-- Make a new post-->
            <h2>Create a new category</h2>
            <form action="{{route('make-category')}}" method="post">
            @csrf
            <div>
                <label for="title">Ime categorije:</label>
                <input type="text" name="name" required>
            </div>
            <button type="submit" class="vv-btn">Sacuvaj kategoriju</button>
            </form>
        </article>
        <aside>
        @include('includes.aside')
        </aside>
    </div>
</section>
@endsection