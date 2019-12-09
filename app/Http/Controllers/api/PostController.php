<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Post;

class PostController extends ApiResponseController
{
    public function index()
    {
        $posts = Post::join('post_images', 'post_images.post_id', '=', 'posts.id')->join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.*', 'categories.title as category', 'post_images.image')->orderBy('posts.created_at', 'desc')->paginate(10);
        return $this->successResponse($posts);
    }

    public function show(Post $post)
    {
        $post->image;
        $post->category;
        return $this->successResponse($post);
    }

    public function category(Category $category)
    {
        $posts = Post::join('post_images', 'post_images.post_id', '=', 'posts.id')->join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.*', 'categories.title as category', 'post_images.image')->orderBy('posts.created_at', 'desc')->where('categories.id', $category->id)
            ->paginate(10);
        return $this->successResponse(["posts" => $posts, "category" => $category]);
        // return $this->successResponse(["posts" => $category->post()->paginate(10), "category" => $category]);
    }
}
