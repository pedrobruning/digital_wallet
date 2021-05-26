<?php


namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{

    private $model;

    public function __construct(object $model)
    {
        $this->model = $model;
    }

    public function save(array $attributes)
    {
        return $this->model->create($attributes);
    }
}
