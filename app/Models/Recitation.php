<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recitation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'durud_count', 'quran_para_count', 'date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
