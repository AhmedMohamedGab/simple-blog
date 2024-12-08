<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::all();
        // dd($postsFromDB);

        // $allPosts = [
        //     ['id' => '1', 'title' => 'PHP', 'posted_by' => 'Ahmed', 'created_at' => '2024-12-02 09:00:00'],
        //     ['id' => '2', 'title' => 'HTML', 'posted_by' => 'Moatasim', 'created_at' => '2024-10-07 03:00:00'],
        //     ['id' => '3', 'title' => 'CSS', 'posted_by' => 'Hothaifa', 'created_at' => '2024-02-05 06:00:00'],
        //     ['id' => '4', 'title' => 'Javascript', 'posted_by' => 'Gezzaoui', 'created_at' => '2024-6-23 12:00:00']
        // ];
        return view('posts.index', ['posts' => $postsFromDB]);
    }
    
    public function show(Post $post)
    {
        // $singlePostFromDB = Post::find($postID);
        // $singlePostFromDB = Post::findOrFail($postID);
        // if(is_null($singlePostFromDB)){
        //     return to_route('posts.index');
        // }
        // $singlePostFromDB = Post::where('id', $postID)->first();
        // $singlePostFromDB = Post::where('title', 'HTML')->get();

        // $singlePost = ['id' => '1', 'title' => 'PHP', 'description' => 'This is description.', 'posted_by' => 'Ahmed', 'email' => 'Ahmed@gmail.com', 'created_at' => '2024-12-02 09:00:00'];
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $usersFromDB = User::all();

        return view('posts.create', ['users' => $usersFromDB]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'postCreator' => ['required', 'exists:users,id']
        ]);

        // $postData = request()->all();

        $title = request()->title;
        $description = request()->description;
        $userID = request()->postCreator;
        // dd($postData, $title, $description, $postCreator);
        // return $postData;

        // $post = new Post;
        // $post->title = $title;
        // $post->description = $description;
        // // $post->postCreator = $postCreator;
        // $post->save();

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userID
        ]);

        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        $usersFromDB = User::all();
        return view('posts.edit', ['post' => $post, 'users' => $usersFromDB]);
    }

    public function update(Post $post)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'postCreator' => ['required', 'exists:users,id']
        ]);

        $title = request()->title;
        $description = request()->description;
        $userID = request()->postCreator;
        // dd($title, $description, $postCreator);

        // $singlePostFromDB = Post::findOrFail($postID);
        // $singlePostFromDB->update([
        //     'title' => $title,
        //     'description' => $description
        // ]);

        $post->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $userID
        ]);

        return to_route('posts.show', $post->id);
    }

    public function destroy($postID)
    {
        $singlePostFromDB = Post::findOrFail($postID);
        $singlePostFromDB->delete();

        return to_route('posts.index');
    }
}
