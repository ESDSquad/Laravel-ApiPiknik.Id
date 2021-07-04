<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatWisata extends Model
{
    use HasFactory;
   
    public $timestamps = false;

    public function review()
{
   return $this->hasMany(Review::class);
}

public function paket()
{
   return $this->hasMany(User::class);
}

public function get()
{
    $data = collect([$this->review, $this->paket]);
    return $data->unique();
}
}
