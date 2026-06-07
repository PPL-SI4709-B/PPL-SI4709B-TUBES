<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriEdukasi extends Model
{
    use HasFactory;

    protected $table = 'materi_edukasis';

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'thumbnail_path',
    ];
}
