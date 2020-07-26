@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="links">
                        <a href="{{route('index')}}">Home page</a>
                        <br>
                        <hr>
                        <a href="{{route('new-post')}}">Make a new post</a>
                        <br>
                        <hr>
                        <a href="{{route('new-category')}}">Make a new category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
