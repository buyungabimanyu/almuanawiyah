<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function title(){
        $title = self::select('body')->where('parent_id', 1)->where('active', true)->first();
        if($title == true){
            if($title->body !== '' || $title !== null){
                return $title->body;
            } else {
                return 'Al-Muanawiyah';
            }
        } else {
            return 'Al-Muanawiyah';
        }
    }
        
    public function logo(){
        $img = self::select('image')->where('parent_id', 1)->where('active', true)->first();
        if($img == true){
            if($img->image !== '' || $img->image !== null){
                return $img->image;
            } else {
                return 'main/almuanawiyah.jpg';
            }
        } else {
            return 'main/almuanawiyah.jpg';
        }
    }

    public function icon(){
        $icon = self::select('icon')->where('parent_id', 1)->where('active', true)->first();
        if($icon == true ){
            if( $icon->icon !== '' || $icon->icon !== null ){
                return $icon->icon;
            } else {
                return 'main/almuanawiyah.jpg';
            }
        } else {
            return 'main/almuanawiyah.jpg';
        }
    }

    public function footer(){
        return self::where('parent_id', 2)->where('active', true)->get();
    }

    public function font()
    {
        return $this->belongsTo(FontAwesome::class, 'icon');
    }
}
