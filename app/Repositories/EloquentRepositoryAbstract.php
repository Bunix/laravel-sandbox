<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/*
 * This class defines Eloquent methods
 */

abstract class EloquentRepositoryAbstract extends Model implements RepositoryInterface
{

    protected $guarded = ['id'];

    public $timestamps = true;

    /*
     * Find set of repo objects.
     *
     * @param $sort_column
     * @param $sort_dir
     * @param $limit
     * @@return StdClass Object with $items and $totalItems
     */
    public function findAll($sort_column = NULL, $sort_dir = NULL, $limit = NULL, $include = array())
    {

        $query = $this;

        if ($sort_column != null && $sort_dir != null) {
            $query = $query->orderBy($sort_column , $sort_dir);
        }

        if ($limit != null) {
            $query = $query->take($limit);
        }

        if (!empty($include)) {
            $query = $query->with($include);
        }

        $items = $query->get();

        $data = new \Stdclass;
        $data->items = $items->all();
        $data->totalItems = $items->count();

        return $items;
    }


    /*
     * Find repo object by id.
     *
     * @param $id
     * @return object
     */
    public function findById($id, $fail = false, $include = array())
    {

        $query = $this;

        if(!empty($include)) {
            $query = $query->with($include);
        }

        if($fail == true) {
            return $query->findOrFail($id);
        } else {
            return $query->find($id);
        }

    }

    /*
     * Find repo object by field.
     *
     * @param $field
     * @param $value
     * @return array
     */
    public function findByField($field, $value)
    {
        return $this->where($field, $value)->get();
    }

    /*
     * Create repo object.
     *
     * @param $input
     * @return bool
     */
    public function createRow($input)
    {
        return $this->create($input);
    }

    /*
     * Create repo object only if doesn't exist.
     *
     * @param $input
     * @return bool
     */
    public function createRowOnlyIfNew($input)
    {
        return $this->firstOrCreate($input);
    }

    /*
     * Update repo object.
     *
     * @param $input
     * @return bool
     */
    public function updateRow($input)
    {
        return $this->update($input);
    }

    /*
    * Update repo object or create object if row doesn't exist.
    *
    * @param $input
    * @return bool
    */
    public function updateRowOrCreate($row_match_data, $input)
    {
        return $this->updateOrCreate($row_match_data, $input);
    }

    /*
     * Delete repo object.
     *
     * @param $id
     * return int
     */
    public function deleteRow($id)
    {
        return $this->destroy($id);
    }

    /*
    * Get Total objects in table.
    *
    * @return integer
    */
    public function getTotal()
    {
        return $this->count();
    }

    /*
     * Get formatted create field.
     *
     * @return date
     */
    public function getFormattedCreatedAttribute()
    {
        if ($this->offsetExists('created_at')) {
            return date('m/d/Y g:i a', strtotime($this->getAttribute('created_at')));
        }
    }

    /*
     * Get formatted create field.
     *
     * @return date
     */
    public function getFormattedModifiedAttribute()
    {
        if ($this->offsetExists('updated_at')) {
            return date('m/d/Y g:i a', strtotime($this->getAttribute('updated_at')));
        }
    }


}