<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\Traits\Filterable;

class Task extends Model
{
    use HasFactory;
    use Filterable;
    protected $fillable = ['name', 'description', 'status_id'];

    public function taskStatus() {
        return $this->hasMany(TaskStatus::class);
    }

    public function getAllStatuses() {
        return $this->hasMany(TaskStatus::class)->get()->toArray();
    }
}
