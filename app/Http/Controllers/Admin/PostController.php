<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\User;



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
        return view('admin.create', compact('users'));
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
            'image' => 'image|required'
        ]);

        $path = Storage::disk('public')->put('images', $data['image']);


        $newPost = new Post;
        $newPost->fill($data);
        $newPost->image = $path;
        $newPost->save();

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
        //
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

        return view('admin.edit', compact('post', 'users'));
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
            'image' => 'image|required'


        ]);

        $path = Storage::disk('public')->put('images', $data['image']);
        $post = Post::findOrFail($id);
        $post->image = $path;

        $post->fill($data)->update();
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
        $post->image;
        if (Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete([$post->image]);
        };
        // Return the search view with the resluts compacted
        return view('search', compact('posts'));
        $post->delete();

        return redirect('admin/posts');
    }


    public function search(Request $request)
    {

        // Get the search value from the request
        $search = $request->input('search');

        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->get();

        return view('admin.search', compact('posts'));
    }
}
