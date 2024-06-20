<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 *
 * This class provides services related to user management.
 * It interacts with the UserRepository to perform authentication and user creation tasks.
 */
class UserService
{

    /**
     * The user repository instance.
     *
     * @var UserRepositoryInterface
     */
    protected $repository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Authenticate a user with provided credentials.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function login($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    /**
     * Logout the currently authenticated user.
     *
     * @return bool
     */
    public function logout()
    {
        Auth::logout();

        return true;
    }

    /**
     * Create a new user.
     *
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($request)
    {
        return $this->repository->create($request);
    }

    /**
     * Update a user's information.
     *
     * @param int $id
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, $request)
    {
        return $this->repository->update($id, $request);
    }
    
    /**
     * delete a user's account.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
    
}
