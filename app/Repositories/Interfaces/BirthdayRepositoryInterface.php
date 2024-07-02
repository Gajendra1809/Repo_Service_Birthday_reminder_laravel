<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface BirthdayRepositoryInterface
{
    public function all();
    public function create($data);
    public function delete($id);
    public function getUpComing();
    public function query(): Builder;
}
