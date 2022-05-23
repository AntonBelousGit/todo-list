<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\FullTextSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use Filterable;
    use FullTextSearch;

    protected $with = ['subtask'];

    protected $fillable = ['title', 'description', 'status', 'priority', 'completed_at', 'todo_list_id', 'task_id'];

    protected $dates = ['completed_at'];

    protected $searchable = ['title'];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function subtask()
    {
        return $this->hasMany(self::class);
    }

}
