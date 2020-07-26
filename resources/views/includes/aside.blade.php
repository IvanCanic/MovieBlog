<h3>Categories</h3>
<ul>
@if($categories)
@foreach($categories as $category)
    <li><a href="{{route('category', $category->id)}}">{{$category->name}}</a></li>
@endforeach
@endif
</ul>