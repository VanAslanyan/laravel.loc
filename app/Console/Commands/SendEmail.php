<?php

namespace App\Console\Commands;

use App\Jobs\SendingEmail;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Console\Command;
use App\Models\User;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email all users running this command ';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $post = Post::orderBy('created_at', 'DESC')->first();
        if ($post !== null) {
            $website = Website::select()->where('id', '=', $post->website_id)->first();
            $website_name = parse_url($website->url, PHP_URL_HOST);
            $subscribers = Subscriber::select()->where('website_id', '=', $post->website_id)->get();
            $chunkSubscribers = $subscribers->chunk(100);
            foreach ($chunkSubscribers as $subscribers) {
                foreach ($subscribers as $users) {
                    $user_id = $users->user_id;
                    $user = User::where('id', '=', $user_id)->get();
                    $data = array(
                        'website_name' => $website_name,
                        'title' => $post->title,
                        'description' => $post->description,
                    );
                    SendingEmail::dispatch($data, $user);
                }
            }
        } else {

            echo( "Website  haven't new post ");
        }
    }
}
