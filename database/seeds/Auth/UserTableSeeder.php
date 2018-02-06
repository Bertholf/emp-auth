<?php

use Illuminate\Database\Seeder;
use App\Models\Common\User\User;
//use App\Models\Common\User\UserSetting;
//use App\Models\App\Timeline\Timeline;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Reset Data
        User::query()->delete();

        // Add Default Users
        $seed =
        [ // name_first, name_last, name_slug, email, password, verified
            ['Rob', 'Bertholf', 'rob', 'rob@bertholf.com', bcrypt('asdfasdf'), 1],
            ['Rene', 'Schultz', 'rene', 'mail@rpschultz.de', bcrypt('qwerty123'), 1],
            ['Tester', 'Lester', 'tester', 'rob1@bertholf.com', bcrypt('asdfasdf'), 0],
            ['General', 'User', 'user', 'rob2@bertholf.com', bcrypt('asdfasdf'), 0],
        ];

        foreach ($seed as $key => $value) {
            // Get Values from Array
            $name_first = $value[0];
            $name_last = $value[1];
            $name_slug = $value[2];
            $email = $value[3];
            $password = $value[4];
            $confirmed = config('empauthable.users.confirm_email') ? 0 : 1;
            $confirmation_code = md5(uniqid(mt_rand(), true));
            $verified = $value[5];
            $language = config('app.locale');
            $timezone = config('app.timezone');

            // Create User
            $user = User::create([
                'name_first' => $name_first,
                'name_last' => $name_last,
                'name_slug' => $name_slug,
                'email' => $email,
                'password' => $password,
                'confirmation_code' => $confirmation_code,
                'confirmed' => $confirmed,
                'verified' => $verified,
                'language' => $language,
                'timezone' => $timezone,
                'timeline_id' => 0, // Temp, set below
            ]);
/*
            // Add Settings @TODO REFACTOR FOR TENANCY
            $settings = UserSetting::create([
                'user_id' => $user->id,
                'privacy_follow' => 'everyone',
                'privacy_follow_confirm' => 'no',
                // Unused v
                'privacy_comment' => 'all',
                'privacy_post' => 'all',
                'privacy_timeline_post' => 'all',
                'privacy_message' => 'all',
                'email_follow' => false,
                'email_post_like' => false,
                'email_post_share' => false,
                'email_comment_post' => false,
                'email_comment_like' => false,
                'email_comment_reply' => false,
            ]);

            // Add Timeline
            $timeline = $user->createTimeline();

            // Update User with Timeline ID
            $user->timeline_id = $timeline->id;
            $user->save();
*/

            echo 'Added User: '. $user->name_first .' '. $user->name_last . PHP_EOL;
        }
    }
}
