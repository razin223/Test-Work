<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Website extends Model {

    protected $fillable = [
        'website',
    ];
    public static $Validator = [
        'website' => "required|max:255",
    ];
    public static $ValidationMessage = [
        'website.required' => "You must enter website.",
        'website.max' => "Website address can be maximum of 255 character.",
    ];

    public function getSubscription() {
        return $this->hasMany('App\Subscription', 'website_id', 'id');
    }

    public function getPost() {
        return $this->hasMany('App\Post', 'website_id', 'id');
    }

}
