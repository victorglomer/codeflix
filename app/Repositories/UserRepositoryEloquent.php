<?php

namespace CodeFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Jrean\UserVerification\Facades\UserVerification;

use CodeFlix\Models\User;


/**
 * Class UserRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    
    public function create(array $data) {
        $data['role'] = User::ROLE_ADMIN;
        $data['troca_senha'] = 0;
        $data['password'] = User::generatePassword();

        
        $model = parent::create($data);
        UserVerification::generate($model);
        
        $l1 = route('email-verification.check', $model->verification_token. '?email=' . urlencode($model->email));
        echo "<a href='".$l1."' target='_blank'>CLIQUE pois não ta indo os emails pro mailtrap</a>";
        die();
        
        UserVerification::send($model, 'Sua conta foi criada', '');
        return $model;
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
