<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $fillable = [
        'website_id', 'title', 'post', 'summary', 'cover_image',
    ];
    public static $Validator = [
        'website_id' => "required|number|exists:App\Website,id",
        'title' => 'required|max: 1024',
        'post' => 'required',
        'summary' => 'required|max:1024',
        'cover_image' => 'required|file|image|max:2048', //maximum 2MB file,
        'email' => 'required|email|max:255|exists:App\User,email',
    ];
    public static $ValidationMessage = [
        'website_id.required' => "You must select a website.",
        'website_id.number' => "You must provide a valid website.",
        'website_id.exists' => "Website does not exist in the system.",
        'title.required' => 'You must give a title of the post.',
        'title.max' => 'Title can be maximum of 1024 character.',
        'post.required' => 'You must provide your post content.',
        'summary.required' => 'You must provide a summary.',
        'summary.max' => 'Summary can be maximum of 1024 character.',
        'cover_image.required' => 'You must provide cover image.', //maximum 2MB file
        'cover_image.file' => 'Cover image must be a valid file.', //maximum 2MB file
        'cover_image.image' => 'Conver image must be a valid image file.', //maximum 2MB file
        'cover_image.max' => 'Cover image can be maximum of 2MB.', //maximum 2MB file
        'email.required' => 'You must provide email of the author.',
        'email.email' => 'You must provide a valid email.',
        'email.max' => 'Email can be maximum of 255 character.',
        'email.exists' => 'No user found with this email.',
    ];

    public function getWebsite() {
        return $this->belongsTo('App\Website', 'website_id', 'id');
    }

    public function getUser() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
