<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TableInterface {

    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders() {
        return ['#id', 'Nome'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header) {
        switch ($header) {
            case '#id':
                return $this->id;
            case 'Nome':
                return $this->name;
        }
    }    

}
