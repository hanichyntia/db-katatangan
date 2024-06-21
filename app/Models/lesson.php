<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    use HasFactory;
    protected $table='lessons';
    protected $fillable=['judul_lesson','deskripsi','video_url','status','create_at','update_at'];
    public function level()
    {
        return $this->belongsTo(Level::class);
    }


}
