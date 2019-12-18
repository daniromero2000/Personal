<?php

namespace App\Http\Controllers\dashboard;

use App\Post;
use App\Http\Controllers\Controller;
use App\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $postComments = PostComment::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.postComment.index', ['postComments' => $postComments]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        // $postComment = PostComment::findOrFail($id);
        // dd($postComment);
        return view('dashboard.postComment.show', ['postComment' => $postComment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        $postComment->delete();
        return back()->with('status', 'PostComment eliminado con exito');
    }

    public function post(Post $post)
    {
        $posts = Post::all();
        $postComments = PostComment::orderBy('created_at', 'desc')
            ->where('post_id', '=', $post->id)
            ->paginate(10);
        return view('dashboard.postComment.post', [
            'postComments' => $postComments,
            'posts' => $posts,
            'post' => $post,
        ]);
    }
}
