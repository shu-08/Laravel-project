<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    use HasFactory;
    // なぜかテーブル名の語尾にsがつくため、宣言
    protected $table = 'state';
}
