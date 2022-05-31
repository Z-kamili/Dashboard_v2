<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{

    use HasFactory,SoftDeletes;

    protected $fillable = [

        'title',
        'description',
        'user_id',

    ];
    
    public function article_category()
    {
        return $this->belongsToMany(Category::class,'article_categories');
    }

    /**
     * Get the Doctor's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

}
