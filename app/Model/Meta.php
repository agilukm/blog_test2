<?php 
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
 
class Meta extends Model {
 
    protected $fillable = ['meta_value','posts_id'];
    public static $rules = [
        'meta_value' => 'required',
        'posts_id' => 'required'
    ];
    public function post()
    {
    	return $this->belongsTo(\App\Services\Post\Post::class, 'id','id');
    }
 	
}
?>