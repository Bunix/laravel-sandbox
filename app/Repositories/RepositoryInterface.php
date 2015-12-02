<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 *
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * Create row in repo
     *
     * @param $input
     * @return static
     */
    public function createRow($input);

    /**
     * Create Row in repo if row data does not exist
     *
     * @param $input
     * @return static
     */
    public function createRowOnlyIfNew($input);

    /**
     * Update row in repo
     *
     * @param $input
     * @return bool|int
     */
    public function updateRow($input);

    /**
     * Update repo row or create new row if row does not exist.
     *
     * @param $row_match_data
     * @param $input
     * @return static
     */
    public function updateRowOrCreate($row_match_data, $input);

    /**
     * Delete row from repo
     *
     * @param $id
     * @return int
     */
    public function deleteRow($id);

    /**
     * Get Total from Repo
     *
     * @return mixed
     */
    public function getTotal();

}