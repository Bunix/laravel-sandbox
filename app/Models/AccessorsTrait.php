<?php

namespace App\Models;

trait AccessorsTrait
{
    /**
     * Created At Accessor
     *
     * @param $value
     * @return bool|string
     */
    public function getCreatedAtAttribute($value)
    {
        if (!$this->offsetExists('created_at')) {
            return false;
        }

        return date('m/d/Y g:i a', strtotime($value));
    }

    /**
     * Updated At Accessor
     *
     * @param $value
     * @return bool|string
     */
    public function getUpdatedAtAttribute($value)
    {
        if (!$this->offsetExists('updated_at')) {
            return false;
        }

        return date('m/d/Y g:i a', strtotime($value));
    }
}