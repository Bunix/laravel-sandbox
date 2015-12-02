<?php

namespace App\Repositories;

use App\Models\ModelAbstract;

/**
 * Class EloquentRepositoryAbstract
 *
 * @package App\Repositories
 */
abstract class EloquentRepositoryAbstract extends ModelAbstract implements RepositoryInterface, RepositoryQueryInterface
{
    /**
     * Property to hold query while building
     *
     */
    protected $query;

    /**
     * Repository Abstract Constructor
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->query = $this->newQuery();

        parent::__construct($attributes);
    }


    /******************** Query Building and Result Functions *****************************/

    /**
     * Start New Query
     *
     * @return $this
     */
    public function startQuery()
    {
        $this->query = $this->newQuery();

        return $this;
    }

    /**
     * Select Only Distinct Results
     *
     * @return $this
     */
    public function selectDistinct()
    {
        $this->query->distinct();

        return $this;
    }

    /**
     * Select Columns for Query
     *
     * @param array $columns
     * @return $this
     */
    public function selectColumns(array $columns)
    {
        $this->query->select($columns);

        return $this;
    }

    /**
     *  Add Where Clause to Query
     *
     * @param $field
     * @param $value
     * @return $this
     */
    public function addWhere($field, $value)
    {
        $this->query->where($field, $value);

        return $this;
    }

    /**
     *  Add Where Not Null Clause to Query
     *
     * @param $field
     * @return $this
     */
    public function addWhereNotNull($field)
    {
        $this->query->whereNotNull($field);

        return $this;
    }

    /**
     *  Add Where Null Clause to Query
     *
     * @param $field
     * @return $this
     */
    public function addWhereNull($field)
    {
        $this->query->whereNull($field);

        return $this;
    }

    /**
     *  Add relations to query
     *
     * @param array $relations
     * @return $this
     */
    public function addRelations(array $relations)
    {
        $this->query->with($relations);

        return $this;
    }


    /**
     *  Add Group By to query
     *
     * @param array $column
     * @return $this
     */
    public function addGroupBy($column)
    {
        $this->query->groupBy($column);

        return $this;
    }

    /**
     * Add sort to query
     *
     * @param $sort_column
     * @param null $sort_dir
     * @return $this
     */
    public function sort($sort_column, $sort_dir = null)
    {
        if (!is_null($sort_dir)) {
            $this->query->orderBy($sort_column, $sort_dir);
        } else {
            $this->query->orderBy($sort_column, 'ASC');
        }

        return $this;
    }

    /**
     * Add limit to query
     *
     * @param null $count
     * @return $this
     */
    public function limit($count = null)
    {
        if (!is_null($count)) {
            $this->query->take($count);
        }

        return $this;
    }

    /**
     * Get Query Results
     *
     * @param string $type
     * @return mixed
     */
    public function getResults($type = null)
    {
        $results = $this->query->get();

        if ($type == 'array') {
            $results = $results->toArray();
        } elseif ($type == 'json') {
            $results = $results->toJson();
        }

        $this->query = $this->newQuery();

        return $results;
    }

    /**
     * Update Query Results
     *
     * @param $input
     * @return int
     */
    public function updateResults($input)
    {
        $result = $this->query->update($input);

        $this->query = $this->newQuery();

        return $result;
    }

    /**
     * Delete Query Results
     *
     * @return mixed affected rows
     */
    public function deleteResults()
    {
        $result = $this->query->delete();

        $this->query = $this->newQuery();

        return $result;
    }

    /******************** Repository Row Manipulation Functions *****************************/

    /**
     * Create row in repo
     *
     * @param $input
     * @return static
     */
    public function createRow($input)
    {
        return $this->create($input);
    }

    /**
     * Create Row in repo if row data does not exist
     *
     * @param $input
     * @return static
     */
    public function createRowOnlyIfNew($input)
    {
        return $this->firstOrCreate($input);
    }

    /**
     * Update row in repo
     *
     * @param $input
     * @return bool|int
     */
    public function updateRow($input)
    {
        return $this->update($input);
    }

    /**
     * Update repo row or create new row if row does not exist.
     *
     * @param $row_match_data
     * @param $input
     * @return static
     */
    public function updateRowOrCreate($row_match_data, $input)
    {
        return $this->updateOrCreate($row_match_data, $input);
    }

    /**
     * Delete row from repo
     *
     * @param $id
     * @return int
     */
    public function deleteRow($id)
    {
        return $this->find($id)->delete();
    }

}