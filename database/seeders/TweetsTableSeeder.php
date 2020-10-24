<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::create([
            'fullname' => 'Python',
            'username' => '@drehimself',
            'quote' => 'This is a tweet for you. I plan to release some new screencasts soon!',
            'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1200px-Python-logo-notext.svg.png',
            'likes' => 4,
            'retweets' => 8,
            'comments' => 5,
            'user'=> rand(1, 10)
        ]);

        Tweet::create([
            'fullname' => 'Laravel',
            'username' => '@laravelphp',
            'quote' => 'Nova is a beautifully designed administration panel for Laravel. Coming soon!',
            'avatar' => 'https://laravel.com/img/logomark.min.svg',
            'likes' => 3,
            'retweets' => 6,
            'comments' => 24,
            'user'=> rand(1, 10)
        ]);

        Tweet::create([
            'fullname' => 'React',
            'username' => '@reactjs',
            'quote' => 'We are working on a large - scale rearchitecture of React Native to make the framework more flexible and integrate better with native infrastructure.',
            'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/React-icon.svg/1280px-React-icon.svg.png',
            'likes' => 15,
            'retweets' => 32,
            'comments' => 22,
            'user'=> rand(1, 10)
        ]);

        Tweet::create([
            'fullname' => 'Vue.js',
            'username' => '@vuejs',
            'quote' => 'Who is excited for the very first @vuejs Conference in #Canada? 🇨🇦',
            'avatar' => 'https://vuejs.org/images/logo.png',
            'likes' => 26,
            'retweets' => 22,
            'comments' => 36,
            'user'=> rand(1, 10)
        ]);
    }
}