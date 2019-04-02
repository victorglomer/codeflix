<?php

namespace CodeFlix\Models;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;


class Serie extends Model implements TableInterface
{
    
    protected $table = 'series';

    protected $fillable = ['title', 'description'];


    /**
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#id', 'Título', 'Descrição'];
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
            case 'Título':
                return $this->title;
            case 'Descrição':
                return $this->description;
        }
    }


}
