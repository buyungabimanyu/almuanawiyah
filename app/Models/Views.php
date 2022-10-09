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

    public function font()
    {
        return $this->belongsTo(FontAwesome::class, 'image', 'id');
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

    public function coursesTitle()
    {
        $title = self::select('body')->where('parent_id', 4)->where('children_id', 1)->where('active', true)->first();
        if($title == true){
            return $title->body;
        } else {
            return 'Explore Courses';
        }
    }

    public function coursesBody()
    {
        $body = self::select('body')->where('parent_id', 4)->where('children_id', 2)->where('active', true)->first();
        if($body == true){
            return $body->body;
        } else {
            return 'Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.';
        }
    }

    public function whyTitle()
    {
        $title = self::select('body')->where('parent_id', 5)->where('children_id', 1)->where('active', true)->first();
        if($title == true){
            return $title->body;
        } else {
            return 'Why Al-Muanawiyah';
        }
    }

    public function whyBody()
    {
        $body = self::select('body')->where('parent_id', 5)->where('children_id', 2)->where('active', true)->first();
        if($body == true){
            return $body->body;
        } else {
            return 'Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.';
        }
    }

    public function videoTitle()
    {
        $title = self::select('body')->where('parent_id', 6)->where('children_id', 1)->where('active', true)->first();
        if($title == true){
            return $title->body;
        } else {
            return 'Persius imperdiet incorrupte et qui, munere nusquam et nec.';
        }
    }

    public function videoBody()
    {
        $body = self::select('body')->where('parent_id', 6)->where('children_id', 2)->where('active', true)->first();
        if($body == true){
            return $body->body;
        } else {
            return 'Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.';
        }
    }

    public function videoText()
    {
        $text = self::select('body')->where('parent_id', 6)->where('children_id', 3)->where('active', true)->first();
        if($text == true){
            return $text->body;
        } else {
            return 'No vel facete sententiae, quodsi dolores no quo, pri ex tamquam interesset necessitatibus. Te denique cotidieque delicatissimi sed. Eu doming epicurei duo. Sit ea perfecto deseruisse theophrastus. At sed malis hendrerit, elitr deseruisse in sit, sit ei facilisi mediocrem.';
        }
    }

    public function videoPlay()
    {
        $play = self::select('body')->where('parent_id', 6)->where('children_id', 4)->where('active', true)->first();
        if($play == true){
            return $play->body;
        } else {
            return 'https://www.youtube.com/embed/icNSHX8QPLU?controls=1&amp;rel=0&amp;playsinline=0&amp;modestbranding=0&amp;autoplay=0&amp;enablejsapi=1&amp;origin=http%3A%2F%2Falmuanawiyah.com&amp;widgetid=1';
        }
    }

    public function contactTitle()
    {
        $title = self::select('body')->where('parent_id', 7)->where('children_id', 1)->where('active', true)->first();
        if($title == true){
            return $title->body;
        } else {
            return 'Contact Us';
        }
    }

    public function contactBody()
    {
        $body = self::select('body')->where('parent_id', 7)->where('children_id', 2)->where('active', true)->first();
        if($body == true){
            return $body->body;
        } else {
            return 'Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.';
        }
    }

    public function contactEmail()
    {
        $email = self::select('body')->where('parent_id', 7)->where('children_id', 3)->where('active', true)->first();
        if($email == true){
            return $email->body;
        } else {
            return 'example@example.com';
        }
    }

    public function contactPhone()
    {
        $phone = self::select('body')->where('parent_id', 7)->where('children_id', 4)->where('active', true)->first();
        if($phone == true){
            return $phone->body;
        } else {
            return '085645754384';
        }
    }

    public function contactAddress()
    {
        $address = self::select('body')->where('parent_id', 7)->where('children_id', 5)->where('active', true)->first();
        if($address == true){
            return $address->body;
        } else {
            return 'Jln. Sambisari RT 8/RW2 Desa Ceweng Kec. Diwek Kab. Jombang (samping Masjid Baitul Mu\'min)';
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
