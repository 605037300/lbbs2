<?php

namespace App\Models;
use App\Models\Category;
use App\Models\User;

class Topic extends Model
{

    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeWithOrder($query,$order){
        switch($order){
            case "recent":
                $query->recent();
                break;
            default:
                $query->recentReply();
            break;
        };
    }

    public function scopeRecent($query){
        return $query->orderBy('created_at','desc');
    }

    public function scopeRecentReply($query){
        return $query->orderBy('updated_at','desc');
    }

   
}
