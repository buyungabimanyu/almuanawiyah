<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Category, Courses, FontAwesome, Post, Setting, Views};

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
   
        Courses::factory(4)->create();

        $dataicon = [
            [
                'icon' => 'fa-facebook',
                'image' => 'icons/facebook.png',
                'body' => 'Facebook'
            ],[
                'icon' => 'fa-twitter',
                'image' => 'icons/twitter.png',
                'body' => 'Twitter'
            ],[
                'icon' => 'fa-instagram',
                'image' => 'icons/instagram.png',
                'body' => 'Instagram'
            ],[
                'icon' => 'fa-tiktok',
                'image' => 'icons/tik-tok.png',
                'body' => 'Tiktok'
            ],[
                'icon' => 'fa-youtube',
                'image' => 'icons/youtube.png',
                'body' => 'Youtube'
            ],[
                'icon' => 'fa-google',
                'image' => 'icons/google.png',
                'body' => 'Google'
            ],[
                'icon' => 'fa-google-plus',
                'image' => 'icons/google-plus.png',
                'body' => 'Google+'
            ],[
                'icon' => 'fa-whatsapp',
                'image' => 'icons/whatsapp.png',
                'body' => 'Whatsapp'
            ],[
                'icon' => 'fa-telegram',
                'image' => 'icons/telegram.png',
                'body' => 'Telegram'
            ],[
                'icon' => 'fa-school',
                'image' => 'icon/school.png',
                'body' => 'School'
            ],[
                'icon' => 'fa-books',
                'image' => 'icons/books.png',
                'body' => 'Books'
            ],[
                'icon' => 'fa-user-graduate',
                'image' => 'icons/user-graduate.png',
                'body' => 'User Gradueate'
            ],[
                'icon' => 'fa-graduation-cap',
                'image' => 'icons/graduation-cup.png',
                'body' => 'Graduation Cap'
            ],[
                'icon' => 'fa-chalkboard-user',
                'image' => 'icons/chalkboard-user.png',
                'body' => 'Chalkboard User'
            ],[
                'icon' => 'fa-chalkboard',
                'image' => 'icons/chalkboard.png',
                'body' => 'chalkboard'
            ],[
                'icon' => 'fa-bus-school',
                'image' => 'icons/bus-school.png',
                'body' => 'Bus School'
            ],[
                'icon' => 'fa-book-open',
                'image' => 'icons/book-open.png',
                'body' => 'Book Open'
            ],[
                'icon' => 'fa-bell-school',
                'image' => 'icons/school-bell.png',
                'body' => 'Bell School'
            ],[
                'icon' => 'fa-mosque',
                'image' => 'icons/mosque.png',
                'body' => 'Mosque'
            ],[
                'icon' => 'fa-person-praying',
                'image' => 'icons/praying.png',
                'body' => 'Person Praying'
            ],[
                'icon' => 'fa-book-quran',
                'image' => 'icons/quran.png',
                'body' => 'Quran Book'
            ],[
                'icon' => 'fa-building',
                'image' => 'icons/building.png',
                'body' => 'Building'
            ],[
                'icon' => 'fa-building-shield',
                'image' => 'icons/asrama.png',
                'body' => 'Building Shield' 
            ],[
                'icon' => 'fa-flask',
                'image' => 'icons/flask.png',
                'body' => 'Flask'
            ],[
                'icon' => 'fa-users',
                'image' => 'icons/users.png',
                'body' => 'Users'
            ],[
                'icon' => 'fa-comments',
                'image' => 'icons/comments.png',
                'body' => 'Comments'
            ]
        ];
        foreach($dataicon as $icon){
            FontAwesome::create($icon);
        }
    }
}
