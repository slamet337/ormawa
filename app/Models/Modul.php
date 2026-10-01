<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'file_path',
        'file_url',
        'cover_image',
        'badge',
        'downloads_count',
    ];
}
