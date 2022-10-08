<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Category, Courses, Post, Setting};

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
    }
}
