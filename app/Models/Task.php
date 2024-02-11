<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    var $fillable = ['title', 'description', 'state', 'deadline', 'user_id', 'project_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
