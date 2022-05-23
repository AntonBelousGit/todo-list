<?php


namespace App\Http\Filters;


use App\Models\Traits\FullTextSearch;
use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{
    use FullTextSearch;

    public const TITLE = 'title';
    public const PRIORITY = 'priority';
    public const STATUS = 'status';
    public const PRIORITY_BETWEEN = 'priority_between';
    public const PRIORITY_AT = 'priority_at';
    public const CREATED_AT = 'created_at';
    public const COMPLETED_AT = 'completed_at';
    public const WITHOUT = 'without';


    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::PRIORITY => [$this, 'priority'],
            self::STATUS => [$this, 'status'],
            self::PRIORITY_BETWEEN => [$this, 'priority_between'],
            self::PRIORITY_AT => [$this, 'priority_at'],
            self::CREATED_AT => [$this, 'created_at'],
            self::COMPLETED_AT => [$this, 'completed_at'],
            self::WITHOUT => [$this, 'without'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->search($value);
    }

    public function priority(Builder $builder, $value)
    {
        $builder->where('priority', $value);
    }

    public function status(Builder $builder, $value)
    {
        $builder->where('status', $value);
    }

    public function priority_between(Builder $builder, $value)
    {
        $builder->whereBetween('priority', $value);
    }

    public function priority_at(Builder $builder, $value)
    {
        $builder->orderBy('priority', $value);
    }

    public function created_at(Builder $builder, $value)
    {
        $builder->orderBy('created_at', $value);
    }

    public function completed_at(Builder $builder, $value)
    {
        $builder->orderBy('completed_at', $value);
    }

    public function without(Builder $builder, $value)
    {
        $builder->without($value);
    }

}
