<?php

namespace App\Repositories;

use App\Models\Birthday;
use App\Repositories\Interfaces\BirthdayRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BirthdayRepository
 *
 * This class provides a concrete implementation of the BirthdayRepositoryInterface.
 * It extends the BaseRepository class and includes additional methods specific to the Birthday model.
 */
class BirthdayRepository extends BaseRepository implements BirthdayRepositoryInterface
{

    /**
     * BirthdayRepository constructor.
     *
     * @param Birthday $birthday
     */
    public function __construct(Birthday $user)
    {
        $this->model = $user;
    }

    /**
     * Get upcoming birthdays for the authenticated user.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUpComing()
    {
        return $this->model->where('user_id', auth()->user()->id)
                    ->whereRaw("DATE_FORMAT(birthdate, '%m%d') >= DATE_FORMAT(CURDATE(), '%m%d')")
                    ->orderByRaw("DATE_FORMAT(birthdate, '%m%d')")
                    ->paginate(5);
    }

    /**
     * Get all birthdays for a specific user.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }
    
}
