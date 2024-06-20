<?php

namespace App\Repositories\Interfaces;

interface BirthdayRepositoryInterface
{
    public function all();
    public function create($data);
    public function delete($id);
    public function getUpComing();
    public function allWhereUserId($userId);
}
