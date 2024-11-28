<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'Name',
        'Description',
        'Image_path',
        'Status',
     
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
