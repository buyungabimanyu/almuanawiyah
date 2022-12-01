<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User,FontAwesome, Information, Views};

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
            'name' => 'Almuanawiyah',
            'username' => 'almuanawiyah',
            'email' => 'Almuanawiyah@pesantren.com',
            'password' => bcrypt('admin12345'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => true,
            'is_editor' => true
        ]);

        $dataicon = [
            [
                'parent_id' => 1,
                'icon' => 'fa-facebook',
                'image' => 'icons/facebook.png',
                'body' => 'facebook'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-twitter',
                'image' => 'icons/twitter.png',
                'body' => 'twitter'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-instagram',
                'image' => 'icons/instagram.png',
                'body' => 'instagram'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-tiktok',
                'image' => 'icons/tik-tok.png',
                'body' => 'tik-tok'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-youtube',
                'image' => 'icons/youtube.png',
                'body' => 'youtube'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-google',
                'image' => 'icons/google.png',
                'body' => 'Google'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-google-plus',
                'image' => 'icons/google-plus.png',
                'body' => 'Google-plus'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-whatsapp',
                'image' => 'icons/whatsapp.png',
                'body' => 'whatsapp'
            ],[
                'parent_id' => 1,
                'icon' => 'fa-telegram',
                'image' => 'icons/telegram.png',
                'body' => 'telegram'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-school',
                'image' => 'icons/school.png',
                'body' => 'school'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-books',
                'image' => 'icons/books.png',
                'body' => 'books'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-user-graduate',
                'image' => 'icons/user-graduate.png',
                'body' => 'user gradueate'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-graduation-cap',
                'image' => 'icons/graduation-cap.png',
                'body' => 'graduation-cap'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-chalkboard-user',
                'image' => 'icons/chalkboard-user.png',
                'body' => 'chalkboard-user'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-chalkboard',
                'image' => 'icons/chalkboard.png',
                'body' => 'chalkboard'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-bus-school',
                'image' => 'icons/bus-school.png',
                'body' => 'bus-school'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-book-open',
                'image' => 'icons/book-open.png',
                'body' => 'book-open'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-bell-school',
                'image' => 'icons/school-bell.png',
                'body' => 'bell-school'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-mosque',
                'image' => 'icons/mosque.png',
                'body' => 'mosque'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-person-praying',
                'image' => 'icons/praying.png',
                'body' => 'person-praying'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-book-quran',
                'image' => 'icons/quran.png',
                'body' => 'quran-book'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-building',
                'image' => 'icons/building.png',
                'body' => 'building'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-building-shield',
                'image' => 'icons/asrama.png',
                'body' => 'building-shield' 
            ],[
                'parent_id' => 2,
                'icon' => 'fa-flask',
                'image' => 'icons/flask.png',
                'body' => 'flask'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-users',
                'image' => 'icons/users.png',
                'body' => 'users'
            ],[
                'parent_id' => 2,
                'icon' => 'fa-comments',
                'image' => 'icons/comments.png',
                'body' => 'comments'
            ]
        ];
        foreach($dataicon as $icon){
            FontAwesome::create($icon);
        }

        Information::create(['parent_id' => 1, 'body' => 'on']);
    }
}
