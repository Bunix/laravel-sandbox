<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ModelAbstract extends Model
{
    /**
     * Find set of repo objects.
     *
     * @param null $sort_column
     * @param null $sort_dir
     * @param null $limit
     * @param array $include
     * @param null $query
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll($sort_column = null, $sort_dir = null, $limit = null, $include = [], $query = null)
    {
        // If null use query from model
        if (is_null($query)) {
            $query = $this;
        }

        if ($sort_column != null && $sort_dir != null) {
            $query = $query->orderBy($sort_column, $sort_dir);
        }

        if ($limit != null) {
            $query = $query->take($limit);
        }

        if (!empty($include)) {
            $query = $query->with($include);
        }

        $items = $query->get();

        return $items;
    }

    /**
     * Get repo data by id.
     *
     * @param $id
     * @param bool $fail
     * @param array $include
     * @return Model|\Illuminate\Database\Eloquent\Collection|Model|\Illuminate\Support\Collection|null|static
     */
    public function findById($id, $fail = false, $include = [])
    {

        $query = $this;

        if (!empty($include)) {
            $query = $query->with($include);
        }

        if ($fail == true) {
            return $query->findOrFail($id);
        }

        return $query->find($id);
    }

    /**
     * Find repo data by field.
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    public function findByField($field, $value)
    {
        return $this->where($field, $value)->get();
    }

    /**
     * Get formatted created_at field
     *
     * @return bool|string
     */
    public function getFormattedCreatedAttribute()
    {
        if (!$this->offsetExists('created_at')) {
            return false;
        }

        return date('m/d/Y g:i a', strtotime($this->getAttribute('created_at')));
    }

    /**
     * Get formatted updated_at field.
     *
     * @return bool|string
     */
    public function getFormattedModifiedAttribute()
    {
        if (!$this->offsetExists('updated_at')) {
            return false;
        }

        return date('m/d/Y g:i a', strtotime($this->getAttribute('updated_at')));
    }

}
