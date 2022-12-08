<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Content extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $fillable = ['name', 'access_type', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function contentable()
    {
        return $this->morphTo();
    }

    public function baseFolder()
    {
        return $this->belongsTo(BaseFolder::class, 'basefolder_id', 'id');
    }

    public function contents()
    {
        return $this->morphMany('App\Models\Content', 'contentable');
    }

    public function accesses()
    {
        return $this->morphMany('App\Models\Access', 'accessable');
    }

    public function deleteWithInnerFolder()
    {
        if (count($this->contents) > 0) {
            foreach ($this->contents as $content) {
                if ($content->type == 'file') {
                    $content->getMedia('file')->first()->forceDelete();
                }
                $content->deleteWithInnerFolder();
            }
        }
        $this->delete();
    }
}
