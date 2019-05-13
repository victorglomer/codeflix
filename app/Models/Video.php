<?php

namespace CodeFlix\Models;

use CodeFlix\Media\VideoPaths;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Bootstrapper\Interfaces\TableInterface;

class Video extends Model implements Transformable, TableInterface {

    use TransformableTrait;
    use VideoPaths;
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'duration', 'published', 'serie_id'
    ];

    public function serie() {
        return $this->belongsTo(Serie::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function getTableHeaders() {
        return ['#'];
    }

    public function getValueForHeader($header) {
        switch ($header) {
            case '#':
                return $this->id;
        }
    }

}
