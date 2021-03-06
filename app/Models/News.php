<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function newsCategory() {
        return $this->belongsTo('App\Models\NewsCategory', 'category_id');
    }
}
