<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\User;
use App\Tag;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();

        return view('admin.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $tags = Tag::all();

        return view('admin.create',  compact('users', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([

            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'required',
            'published' => 'boolean',
            'slug' => 'required|unique:posts',
            'image' => 'image|required',
            'tags' => 'required'
        ]);

        $path = Storage::disk('public')->put('images', $data['image']);


        $newPost = new Post;
        $newPost->fill($data);
        $newPost->image = $path;
        $newPost->slug = Str::of($newPost->slug)->slug('-');
        $newPost->save();
        if (count($data['tags']) > 0) {
            $newPost->tags()->sync($data['tags']);
        }


        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();
        $tags = Tag::all();


        return view('admin.edit', compact('post', 'users', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();
        $request->validate([

            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'required',
            'published' => 'boolean',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($id)
            ],
            'image' => 'image|required',
            'tags' => 'required'

        ]);

        $path = Storage::disk('public')->put('images', $data['image']);
        $post = Post::findOrFail($id);
        $post->image = $path;
        $post->slug = Str::of($post->slug)->slug('-');
        $post->fill($data)->update();
        if (count($data['tags']) > 0) {
            $post->tags()->sync($data['tags']);
        }
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);
        if (Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete([$post->image]);
        };

        $post->tags()->detach();
        $post->delete();


        return redirect('admin/posts');
    }


    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3'
        ]);
        // Get the search value from the request
        $search = $request->input('search');

        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->get();

        return view('admin.search', compact('posts'));
    }
}
