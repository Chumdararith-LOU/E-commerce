<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'assigned_to', 'status'];

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
