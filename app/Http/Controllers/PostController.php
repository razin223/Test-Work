<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller {

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Post::$Validator, Post::$ValidationMessage);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $file = $request->cover_image->store('public/cover_image');

        $User = User::where('email', $request->email)->first();

        $Data = new Post();
        $Data->website_id = $request->website_id;
        $Data->title = $request->title;
        $Data->post = $request->post;
        $Data->summary = $request->summary;
        $Data->cover_image = $file;
        $Data->user_id = $User->id;
        $Data->save();

        return response()->json(['status' => true, 'success' => "Post has been created.", 'post_id' => $Data->id], 200);
    }

}
