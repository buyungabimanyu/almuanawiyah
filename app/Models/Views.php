<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function parent(){
        $this->belongsTo(self::class, 'parent_id');
    }

    public function children(){
        $this->hasMany(self::class, 'children_id');
    }

    public function mainHeader() {
        $main = self::select('image')->where('parent_id', 1)->where('active', true)->first();
        if($main == true ){
            return $main->image;
        } else {
            return 'main/home-background.jpg';
        }
    }

    public function homeTitle() {
        $title = self::select('body')->where('parent_id', 2)->where('children_id', 1)->where('active', true)->first();
        if($title == true ){
            return $title->body;
        } else {
            return 'Edusite Free Online Training Courses';
        }
    }
    
    public function homeBody() {
        $body = self::select('body')->where('parent_id', 2)->where('children_id', 2)->where('active', true)->first();
        if($body == true ){
            return $body->body;
        } else {
            return 'Libris vivendo eloquentiam ex ius, nec id splendide abhorreant, eu pro alii error homero.';
        }
    }

    public function aboutTitle() {
        $title = self::select('body')->where('parent_id', 3)->where('children_id', 1)->where('active', true)->first();
        if($title == true ){
            return $title->body;
        } else {
            return 'Welcome to Al-Muanawiyah';
        }
    }

    public function aboutBody() {
        $body = self::select('body')->where('parent_id', 3)->where('children_id', 2)->where('active', true)->first();
        if($body == true ){
            return $body->body;
        } else {
            return 'Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.';
        }
    }

    public function aboutImg() {
        $img = self::select('image')->where('parent_id', 3)->where('children_id', 3)->where('active', true)->first();
        if($img == true ){
            return $img->image;
        } else {
            return 'main/about.png';
        }
    }

    public function blogTitle(){
        $title = self::select('body')->where('parent_id', 8)->where('active', true)->first();
        if($title == true){
            return $title->body;
        } else {
            return 'Posts';
        }
    }
}
