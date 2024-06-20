<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * This class provides a concrete implementation of the UserRepositoryInterface.
 * It extends the BaseRepository class and is responsible for handling operations
 * related to the User model.
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    
}
