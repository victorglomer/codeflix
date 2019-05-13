<?php

namespace CodeFlix\Models;

use CodeFlix\Media\SeriePaths;
use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;


class Serie extends Model implements TableInterface
{
    use SeriePaths;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'thumb'];


    /**
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#id'];
    }

    /**
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#id':
                return $this->id;
        }
    }


}
