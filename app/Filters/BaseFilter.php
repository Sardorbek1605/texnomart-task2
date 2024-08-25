<?php

namespace App\Filters;

class BaseFilter
{
    protected $request;

    protected $model;

    public function __construct($model, array $request)
    {
        $this->request = $request;
        $this->model = new $model;
    }
}
