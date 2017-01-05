<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

/**
 * Class APIController
 *
 * @package App\Http\Controllers\API\V1
 */
class APIController extends Controller
{
    use Helpers;

    /**
     * API Authorized User Object
     *
     * @var
     */
    protected $user;

    /**
     * API Object Model
     *
     * @var
     */
    protected $model;

    /**
     * Transformer Object
     *
     * @var TransformerAbstract
     */
    protected $transformer;

    /**
     * Records per pagination page
     *
     * @var int
     */
    protected $record_per_page = 25;

    /**
     * APIController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::guard('api')->user();
    }

    /**
     * Display a listing of all the resource.
     *
     */
    public function index()
    {
        return $this->response->collection($this->model->get(), $this->transformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        $item = $this->findRow($id);

        if (!$item) {
            return $this->response->errorNotFound($this->resource_name . ' Not Found');
        }

        return $this->response->item($item, $this->transformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param array $added_inputs
     * @return \Dingo\Api\Http\Response
     */
    protected function storeResource(Request $request, $added_inputs = [])
    {
        $input = $request->getConvertedInput();

        $input = array_merge($input, $added_inputs);

        try {
            $item = $this->model->create($input);
        } catch(QueryException $e) {
            return $this->response->errorBadRequest('Invalid Create Field in Request');
        }

        return $this->response->item($item, $this->transformer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @param array $added_inputs
     * @return \Dingo\Api\Http\Response
     */
    protected function updateResource(Request $request, $id, $added_inputs = [])
    {
        $item = $this->findRow($id);

        if (!$item) {
            return $this->response->errorNotFound($this->resource_name . ' Not Found');
        }

        $input = $request->getConvertedInput();

        $input = array_merge($input, $added_inputs);

        try {
            $item->update($input);
        } catch(QueryException $e) {
            return $this->response->errorBadRequest('Invalid Update Field in Request');
        }

        return $this->response->item($item, $this->transformer);
    }

    /**
     *  Delete resource.
     *
     * @param  int $id
     * @return array
     */
    public function destroy($id)
    {
        $item = $this->findRow($id);

        if (!$item) {
            return $this->response->errorNotFound($this->resource_name . ' Not Found');
        }

        $item->delete();

        return ['deleted' => true, 'id' => $id];
    }

    /**
     * Display a listing of all the resource paginated.
     *
     */
    public function paginate()
    {
        $paginator = $this->model->paginate($this->record_per_page);

        return $this->response->paginator($paginator, $this->transformer);
    }

    /**
     * Find Data Row by ID
     *
     * @param $id
     * @return mixed
     */
    protected function findRow($id)
    {
        return $this->model->find($id);
    }
}