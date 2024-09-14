<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenTime extends BaseModel
{
    use HasFactory;
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
