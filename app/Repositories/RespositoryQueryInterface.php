<?php

namespace App\Repositories;

/**
 * Interface RepositoryQueryInterface
 * @package App\Repositories
 */
interface RepositoryQueryInterface
{
    /**
     * Start New Query
     *
     * @return mixed
     */
    public function startQuery();

    /**
     * Select Columns for Query
     *
     * @param array $columns
     * @return mixed
     */
    public function selectColumns(array $columns);

    /**
     * Select Only Distinct Results
     *
     * @return mixed
     */
    public function selectDistinct();

    /**
     * Add Where Clause to Query
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    public function addWhere($field, $value);

    /**
     * Add Where Null Clause to Query
     *
     * @param $field
     * @return mixed
     */
    public function addWhereNull($field);

    /**
     * Add Where Not Null Clause to Query
     *
     * @param $field
     * @return mixed
     */
    public function addWhereNotNull($field);

    /**
     * Add relations to query
     *
     * @param array $relations
     * @return mixed
     */
    public function addRelations(array $relations);

    /**
     * Add sort to query
     *
     * @param $sort_column
     * @param null $sort_dir
     * @return mixed
     */
    public function sort($sort_column, $sort_dir = null);

    /**
     * Add limit to query
     *
     * @param null $count
     * @return mixed
     */
    public function limit($count = null);

    /**
     * Get Query Results
     *
     * @param null $type
     * @return mixed
     */
    public function getResults($type = null);

    /**
     * Update Query Results
     *
     * @param $input
     * @return int
     */
    public function updateResults($input);

    /**
     * Delete Query Results
     *
     * @return mixed
     */
    public function deleteResults();
}