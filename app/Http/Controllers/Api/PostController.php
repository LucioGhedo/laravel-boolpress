<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::paginate(9);

        $data = [
            'success' => true,
            'result' => $posts
        ];
        return response()->json($data);
    }

    public function show($slug) {
        $post = Post::where('slug', '=', $slug)->with(['tags', 'category'])->first();
        
        if($post) {
            $data = [
                'success' => true,
                'results' => $post
            ];
        } else {
            $data = [
                'success' => false
            ];
        }
        return response()->json($data);
    }
}
