<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable=['level_id','tugas'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function tugass()
    {
        return $this->hasMany(Tugas::class);
    }
}
