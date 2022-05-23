<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 * @package App\Repositories
 *
 * Репозиторий для работы с сущностью.
 * Может выдавать наборы данныхю.
 * Не может создавать/изменять сущности
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */

    abstract protected function getModelClass();

    /**
     * @return Model|mixed|\Illuminate\Foundation\Application
     */
    protected function startCondition()
    {
        return clone $this->model;
    }
}
