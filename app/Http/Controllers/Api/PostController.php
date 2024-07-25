<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $posts=PostResource::collection(Post::get());
        return $this->apiRespons($posts,'ok',200);
    }
    public function show($id){
        $post=Post::find($id);
        if($post){
            return $this->apiRespons(new PostResource($post),'ok',200);
        }
        return $this->apiRespons(null,'this post not found',404);

    }

    public function store(Request $request){
        $validator=validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required'
        ]);
        if ($validator->fails()){
            return $this->apiRespons(null,$validator->errors(),400);
        }
        $post=Post::create($request->all());
        if($post){
            return $this->apiRespons(new PostResource($post),'the post is save',201);
        }
        return $this->apiRespons(null,'the post not save',400);

    }
    public function update(Request $request,$id){
        $validator=validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required'
        ]);
        if ($validator->fails()){
            return $this->apiRespons(null,$validator->errors(),400);
        }
        $post=Post::find($id);
        if(!$post){
            return $this->apiRespons(null,'the post is not found',404);
        }
        $post->update($request->all());
        if($post){
            return $this->apiRespons(new PostResource($post),'the post is update',201);
        }
        return $this->apiRespons(null,'the post not update',400);
    }
    public function destroy($id){
        $post=Post::find($id);
        if(!$post){
            return $this->apiRespons(null,'the post is not found',404);
        }
        $post->delete($id);
        if ($post){
            return $this->apiRespons(null,'the post is delete',200);
        }
    }
}
