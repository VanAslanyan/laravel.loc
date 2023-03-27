<?php

namespace App\Console\Commands;

use App\Jobs\SendingEmail;
use App\Models\Post;
use App\Models\SentEmail;

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
    protected $signature = 'send:email';

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
        $unsentEmails = SentEmail::select()->where('sent_status', 0)->get();
        foreach ($unsentEmails as $unsentEmail) {
            $subscribers = User::select()->where('id', $unsentEmail->user_id)->get();
            $posts = Post::select()->where('id', $unsentEmail->post_id)->get();
            foreach ($posts as $post) {
                $website = Website::select()->where('id', $post->website_id)->first();
                $websiteName = parse_url($website->url, PHP_URL_HOST);
                $chunkedSubscribers = $subscribers->chunk(100);
                foreach ($chunkedSubscribers as $subscribers) {
                    foreach ($subscribers as $users) {
                        $userId = $users->user_id;
                        $user = User::where('id', $userId)->get();
                        $data = array(
                            'website_name' => $websiteName,
                            'title' => $post->title,
                            'description' => $post->description,
                        );
                        $sendingEmail = SendingEmail::dispatch($data, $user);
                        if ($sendingEmail) {
                            SentEmail::where('sent_status', 0)
                                ->update([
                                    'sent_status' => 1,
                                ]);
                        } else {
                            echo 'Email is not send';

                        }
                    }
                }
            }
        }
    }
}
