<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Dingo\Api\Http\FormRequest;
use Dingo\Api\Routing\Helpers;
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
     * @return \Dingo\Api\Http\Response|void
     */
    public function show($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return $this->response->errorNotFound($this->resource_name.' Not Found');
        }

        return $this->response->item($item, $this->transformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FormRequest $request
     * @return \Dingo\Api\Http\Response
     */
    protected function storeResource(FormRequest $request)
    {
        $item = $this->model->create($request->all());

        return $this->response->item($item, $this->transformer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FormRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    protected function updateResource(FormRequest $request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return $this->response->errorNotFound($this->resource_name.' Not Found');
        }

        $item->update($request->all());

        return $this->response->item($item, $this->transformer);
    }

    /**
     *  Delete resource.
     *
     * @param  int $id
     * @return array|void
     */
    public function destroy($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return $this->response->errorNotFound($this->resource_name.' Not Found');
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
}