<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends BaseModel
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    public function open_times()
    {
        return $this->hasMany(OpenTime::class);
    }
}
