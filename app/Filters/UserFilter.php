<?php

namespace App\Filters;

class UserFilter extends BaseFilter
{
    public function filter()
    {
        if (isset($this->request['phone']))
            $this->model = $this->model->where('phone', $this->request['phone']);

        if (isset($this->request['name']))
            $this->model = $this->model->where('name', 'like', "%{$this->request['name']}%");

        if (isset($this->request['email']))
            $this->model = $this->model->where('email', $this->request['email']);

        return $this->model;
    }
}
