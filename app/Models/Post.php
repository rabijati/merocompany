<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
    use HasFactory;
    use softDeletes;

   // protected $guarded= [];
   protected $fillable =['title','description'];

   public function comment(){
    return $this->hasMany(Comment::class,'post_id', 'id');
   }

}
