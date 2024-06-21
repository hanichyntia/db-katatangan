<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    use HasFactory;
    protected $table='levels';
    protected $fillable=['judul','deskripsi','lesson_id','task_id','create_at','update_at'];
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
