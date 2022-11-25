<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseFolders extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'owner_id', 'access_type', 'slug'];

    public function contents()
    {
        return $this->morphMany('App\Models\Content', 'contentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function accesses()
    {
        return $this->morphMany('App\Models\Access', 'accessable');
    }
}
