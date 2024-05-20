<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function edit($id){
        $post = Post::find($id);
        if(!Gate::allows('update-post', $post)){
            echo "u can't update this post";
        }else{
            echo "u can update this post";
        }
    }
}
