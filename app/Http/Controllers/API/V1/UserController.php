<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\User\User;
use App\Services\Support\Validator\User\APIValidator;


class UserController extends APIController
{
    protected $data_type = 'user';

    public function __construct(User $model, APIValidator $validator)
    {
        $this->model = $model;
        $this->validator = $validator;
    }

    /**
     * Display a listing of all the resource.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $users = $this->model
            ->orderBy($request->input('sort_column') ?: 'created_at', $request->input('sort_dir') ?: 'DESC')
            ->take( $request->input('limit') ?: '100')
            ->get();

        return $this->outputResponse($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $user = $this->model->find($id);

        if (!$user) {
            return $this->outputErrorResponse(['User Not Found With ID: ' . $id]);
        }

        return $this->outputResponse($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $input = array_except($request->all(), '_method');

        if (!$this->validator->passes()) {
            $errors = $this->validator->getErrors();

            return $this->outputErrorResponse($errors->all());
        }

        $user = $this->model->create($input);

        return $this->outputResponse($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        $input = array_except($request->all(), '_method');

        if (!$this->validator->passes()) {

            $errors = $this->validator->getErrors();

            return $this->outputErrorResponse($errors->all());
        }

        $user = $this->model->find($id);
        $user->update($input);

        return $this->outputResponse($user);
    }

    /**
     *  Delete resource.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        $count = $this->model->find($id)->delete();

        return $this->outputResponse($count . ' Rows Deleted');
    }


    /**
     *  Search resource.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $input = array_except($request->all(), '_method');

        $users = $this->model->APIsearch($input);

        if (!is_object($users)) {
            return $this->outputErrorResponse($users);
        }

        return $this->outputResponse($users);
    }

}