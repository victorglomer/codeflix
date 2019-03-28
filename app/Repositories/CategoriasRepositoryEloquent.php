<?php

namespace CodeFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use CodeFlix\Models\Categorias;

/**
 * Class CategoriasRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class CategoriasRepositoryEloquent extends BaseRepository implements CategoriasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Categorias::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
