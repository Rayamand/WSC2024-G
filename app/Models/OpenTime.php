<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenTime extends BaseModel
{
    use HasFactory;
    protected $casts = [
        "start_time" => "datetime",
        "end_time" => "datetime",
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
