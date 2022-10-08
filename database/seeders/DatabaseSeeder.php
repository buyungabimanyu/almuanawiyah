<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Category, Courses, Post, Setting, Views};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Buyung Abimanyu',
            'username' => 'buyungabimanyu',
            'email' => 'buyung@gmail.com',
            'password' => bcrypt('buyung24'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => true,
            'is_editor' => true
        ]);

        User::factory(4)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);
        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);
        
        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        $data = [
            [
                'parent_id' => 9,
                'icon' => 'fa-facebook',
                'body' => 'Facebook'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-twitter',
                'body' => 'Twitter'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-instagram',
                'body' => 'Instagram'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-tiktok',
                'body' => 'Tiktok'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-linkedin',
                'body' => 'Linkedin'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-github',
                'body' => 'GitHub'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-gitlab',
                'body' => 'GitLab'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-discord',
                'body' => 'Discord'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-youtube',
                'body' => 'Youtube'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-google',
                'body' => 'Google'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-google-plus',
                'body' => 'Google+'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-whatsapp',
                'body' => 'Whatsapp'
            ],[
                'parent_id' => 9,
                'icon' => 'fa-telegram',
                'body' => 'Telegram'
            ]
        ];
        foreach($data as $input){
            Setting::create($input);
        }
        
        Courses::factory(4)->create();

        $dataicon = [
        ['image' => 'fa-music'
        ],['image' => 'fa-bell'
        ],['image' => 'fa-atom-simple'
        ],['image' => 'fa-thought-bubble'
        ],['image' => 'fa-globe-stand'
        ],['image' => 'fa-school'
        ],['image' => 'fa-award'
        ],['image' => 'fa-chalkboard'
        ],['image' => 'fa-books'
        ],['image' => 'fa-user-graduate'
        ],['image' => 'fa-shapes'
        ],['image' => 'fa-ruler-triangle'
        ],['image' => 'fa-person-chalkboard'
        ],['image' => 'fa-pen-paintbrush'
        ],['image' => 'fa-microscope'
        ],['image' => 'fa-masks-theater'
        ],['image' => 'fa-laptop-file'
        ],['image' => 'fa-laptop-code'
        ],['image' => 'fa-graduation-cap'
        ],['image' => 'fa-glasses-round'
        ],['image' => 'fa-file-certificate'
        ],['image' => 'fa-diploma'
        ],['image' => 'fa-chalkboard-user'
        ],['image' => 'fa-bus-school'
        ],['image' => 'fa-book-open-reader'
        ],['image' => 'fa-book-open-cover'
        ],['image' => 'fa-book-open'
        ],['image' => 'fa-book-copy'
        ],['image' => 'fa-book-blank'
        ],['image' => 'fa-bell-slash'
        ],['image' => 'fa-bell-school-slash'
        ],['image' => 'fa-bell-school'
        ],['image' => 'fa-backpack'
        ],['image' => 'fa-atom'
        ],['image' => 'fa-apple-whole'
        ],['image' => 'fa-school-lock'
        ],['image' => 'fa-mosque'
        ],['image' => 'fa-person-praying'
        ],['image' => 'fa-book-quran'
        ],['image' => 'fa-landmark'
        ],['image' => 'fa-car-building'
        ],['image' => 'fa-building'
        ],['image' => 'fa-buildings'
        ],['image' => 'fa-building-user'
        ],['image' => 'fa-building-shield']
        ];
        foreach($dataicon as $icon){
            $datainput['parent_id'] = 5;
            $datainput['children_id'] = 9;
            $datainput['image'] = $icon['image'];
            Views::create($datainput);
        }
    }
}
