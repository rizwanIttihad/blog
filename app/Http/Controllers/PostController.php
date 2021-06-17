<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        return Post::all();
    }

    public function createPost(Request $request){
        try{
        Post::create([
            "title" => $request->input('title'),
            "body" => $request->input('body')
        ]);
        return response()->json(['success' => "Post created", 'status' => 200]);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => $e, 'status' => 500]);
        }
    }

    public function updatePost(Request $request){
        try{
            Post::where('id',$request->input('id'))->update([
                "title" => $request->input('title'),
                "body" => $request->input('body')
            ]);
            return response()->json(['success' => "Post updated", 'status' => 200]);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => $e, 'status' => 500]);
        }
    }

    public function delete(Request $request){
        try{
            Post::where('id',$request->input('id'))->delete();
            return response()->json(['success' => "Post deleted", 'status' => 200]);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => $e, 'status' => 500]);
        }
    }

    public function like(Request $request){
        try{
            Post::where('id',$request->input('id'))->update([
                "likes_count" => $request->likes_count
            ]);
            return response()->json(['success' => "Post liked", 'status' => 200]);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => $e, 'status' => 500]);
        }
    }
}
