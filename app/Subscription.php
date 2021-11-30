<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {
    

    protected $fillable = [
        'user_id', 'website_id'
    ];
    public static $Validator = [
        'email' => "required|email|max:255|exists:App\User,email",
        'website' => "required|max:255|exists:App\Website,website",
    ];
    public static $ValidationMessage = [
        'email.required' => "You must enter email properly.",
        'email.email' => "Email is not a vaild email format.",
        'email.max' => "Email can be maximum of 255 character.",
        'email.exists' => "Email do not exist in the system.",
        'website.required' => "You must enter website.",
        'website.max' => "Website can be maximum of 255 character.",
        'website.exists' => "Website does not exist in the system.",
    ];

    public function getUser() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getWebsite() {
        return $this->belongsTo('App\Website', 'website_id', 'id');
    }

}
