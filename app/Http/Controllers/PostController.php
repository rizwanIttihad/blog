<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Auth;
use App\Models\PostLikeBy;

class PostController extends Controller
{
    public function index(){
        return Post::with(['user','postLikeBy'])->get();
    }

    public function createPost(Request $request){
        try{
        $token = $request->bearerToken();    
        $user = User::where('id',Auth::user()->id)->first();    
        Post::create([
            "title" => $request->input('title'),
            "body" => $request->input('body'),
            "user_id" => $user->id,
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
                "likes_count" => $request->likes_count,
                "is_liked" => 1,
            ]);

            PostLikeBy::create([
                'post_id' => $request->input('id'),
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['success' => "Post liked", 'status' => 200]);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => $e, 'status' => 500]);
        }
    }

    public function unLike(Request $request){
        try{    
            Post::where('id',$request->input('id'))->update([
                "likes_count" => $request->likes_count,
            ]);
            PostLikeBy::where('post_id',$request->input('id'))
            ->where('user_id',Auth::user()->id)
            ->delete();
            
            return response()->json(['success' => "Post unLiked", 'status' => 200]);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => $e, 'status' => 500]);
        }
    }
}
