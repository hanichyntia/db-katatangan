<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;
    protected $table='events';
    protected $fillable=['title','deskripsi','link_kitabisa','tanggal_berakhir','create_at','update_at'];
}
