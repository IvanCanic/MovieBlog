<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Comment;

use Illuminate\Database\Eloquent\Relations;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Home page, return all posts

    public function index() {

        $posts = Post::with('comments')->orderBy('title')->paginate(4);
        $posts->load('category', 'user');

        $categories = Category::all();
        
        return view('posts.index', compact('posts', 'categories'));
    }

    public function create() {

        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function show($id) {

        $post = Post::with('comments')->findOrFail($id);

        $categories = Category::all();

        return view('posts.show', compact('post', 'categories'));
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'category_id' => 'required',
            'youtube_url' => 'sometimes',
            'image' => 'required|file|image|max:5000'
        ]);

        $post = new Post();
        
        $post_user_id = Auth::user()->id;

        $post->user_id = $post_user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;

        if($request->youtube_url) {
            $post->youtube_url = $request->youtube_url;
        }

        //$post->category_id = $request->category_id;
        //$post->category_names = $request->category;
        
        $post->image = $request->image->store('uploads', 'public');

        if(!$post->category_id) {
            $post->category_id = 1;
        }

        /*if(request()->has('image')){
            $post->update([
                'image' => $request->image->store('uploads'. 'public')
            ]);
        } */

        $post->save();
        
        return redirect('home');
    }

    public function edit($id) {

        $categories = Category::all();

        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id) {

        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'youtube_url' => 'sometimes',
            'image' => 'file|image|max:5000'
        ]);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;

        if($request->youtube_url) {
            $post->youtube_url = $request->youtube_url;
        }
        
        //$post->image = $request->image->store('uploads', 'public');

        /*if(!$post->category) {
            $post->category_id = 1;
        }*/

        if(request()->has('image')){
            $post->update([
                'image' => $request->image->store('uploads'. 'public')
            ]);
        }

        $post->save();

        return redirect('home');
    }

    public function destroy($id) {
    
        $post = Post::findOrFail($id);

        //brisanje komentara kroz odnose
        $post->comments()->delete();

        $post->delete();

        return redirect('home');

    }

    public function newCategory() {

        $categories = Category::all();

        return view('posts.makecategory', compact('categories'));
    }

    public function makeCategory(Request $request) {

        $category = new Category();

        $request->validate([
            'name' => 'required|min:3'
        ]);

        $category->name = $request->name;

        $category->save();

        return redirect()->back();

    }

    public function category($categoryName) {

        $categories = Category::all();

        // 1 solution
        //$posts = Post::where('category_id', $categoryName)->get();

        $posts = Post::with('category')->where('category_id', $categoryName)->get();
        $posts->load('user');
        
        return view('posts.archive', compact('posts', 'categories'));

        // 2 solution
        //$posts = Category::where('id', $categoryName)->get();
        //$posts->load('posts');
        //return view('posts.archive', compact('posts', 'categories'));
        
    }

    public function author($id) {

        $posts = Post::with('user', 'category')->where('user_id', $id)->get();

        return view('posts.archive', compact('posts'));
    }

    public function searchPost(Request $request) {

        $request->validate([
            'search' => 'required',
        ]);

        $s = $request->search;

        $posts = Post::with('comments')->where('description', 'LIKE', '%'.$s.'%')->orWhere('title', 'LIKE', '%'.$s.'%')->get();

        //dd($posts);

        return view('posts.search', compact('posts'));
    }

}
