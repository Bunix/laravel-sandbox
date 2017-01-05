<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User\User;
use App\Transformers\UserTransformer;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\API\V1
 */
class UserController extends APIController
{
    /**
     * Resource Name
     *
     * @var string
     */
    protected $resource_name = 'User';

    /**
     * UserController constructor.
     *
     * @param User $model
     * @param UserTransformer $transformer
     */
    public function __construct(User $model, UserTransformer $transformer)
    {
        $this->model = $model;
        $this->transformer = $transformer;

        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        return parent::storeResource($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        return parent::updateResource($request, $id);
    }
}