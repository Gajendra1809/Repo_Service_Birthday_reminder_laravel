<?php

namespace App\Services;

use App\Repositories\Interfaces\BirthdayRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BirthdayService
 *
 * This class handles business logic related to birthdays.
 * It interacts with the BirthdayRepository to perform CRUD operations and other business-specific tasks.
 */
class BirthdayService
{

    /**
     * The birthday repository instance.
     *
     * @var BirthdayRepositoryInterface
     */
    protected $repository;

    /**
     * BirthdayService constructor.
     *
     * @param BirthdayRepositoryInterface $repository
     */
    public function __construct(BirthdayRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all birthdays.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * Get upcoming birthdays for the authenticated user.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUpComing()
    {
        return $this->repository->getUpComing();
    }

    /**
     * Get all birthdays for a specific user.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function query(): Builder
    {
        return $this->repository->query();
    }

    /**
     * Create a new birthday record.
     *
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($request)
    {
        $request['user_id']=auth()->user()->id;
        return $this->repository->create($request);
    }

    /**
     * Delete a birthday record by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
    
}
