<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Website;
use App\Subscription;
use App\Post;
use Mail;
use App\Mail\Mailer;

class SendPostEmailToUser extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Email:Send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to user with subscripted post. pass user id as parameter.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $Users = $this->getSubscribedUser();
        
        
        foreach ($Users as $value) {
            $User = User::find($value->user_id);
            
            
            $Posts = Post::with('getWebsite.getSubscription')
                    ->whereHas('getWebsite.getSubscription', function($query)use($User) {
                        $query->where('subscriptions.user_id', $User->id);
                    })
                    ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime("-1 day"))) //this and next line secure to send last day post only.
                    ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime("-1 day")))
                    ->get();
                    
                    dd($Posts);
            if ($Posts->count()) {
                $this->sendEmail($Posts, $User);
            }
        }
        return 0;
    }

    private function getSubscribedUser() {
        $Data = Subscription::select('user_id')->groupBy('user_id')->get();

        return $Data;
    }

    private function sendEmail($Posts, $User) {
        $Data = [
            'posts' => $Posts,
            'user' => $User,
            'subject' => "Posts of " . date("d M, Y ", strtotime("-1 day")) . " you subscribed",
            'from' => "example@xyz.com",
            'from_name' => "Subscription platform"
        ];


        Mail::to($User->email)->send(new Mailer($details));
    }

}
