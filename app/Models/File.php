<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['repo_id', 'name', 'pathname'];




    public function repo()
    {

    return $this->belongsTo(Repos::class);

    }
}
