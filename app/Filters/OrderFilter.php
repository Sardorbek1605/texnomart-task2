<?php

namespace App\Filters;

class OrderFilter extends BaseFilter
{
    public function filter()
    {
        if (isset($this->request['user_id']))
            $this->model = $this->model->where('user_id', $this->request['user_id']);

        if (isset($this->request['logistic_company_id']))
            $this->model = $this->model->where('logistic_company_id', $this->request['logistic_company_id']);

        if (isset($this->request['payment_id']))
            $this->model = $this->model->where('payment_id', $this->request['payment_id']);

        if (isset($this->request['status_id']))
            $this->model = $this->model->where('status_id', $this->request['status_id']);

        return $this->model;
    }
}
