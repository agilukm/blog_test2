<?php 
namespace App\Services\Post;
use Illuminate\Database\Eloquent\Model;
 
class Post extends Model {
 
    protected $fillable = ['title','author'];
    public static $rules = [
        'post_title' => 'required',
        'author' => 'required',
    ];
    public function meta() {
        return $this->hasMany(\App\Model\Meta::class, 'id','id');
    }
 
}
?>