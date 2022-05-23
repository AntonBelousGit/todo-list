<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'completed', 'completed_at'];


    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

}
