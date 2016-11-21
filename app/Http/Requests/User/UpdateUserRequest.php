<?php

namespace App\Http\Requests\User;

/**
 * Class UpdateUserRequest
 *
 * @package App\Http\Requests\User
 */
class UpdateUserRequest extends UserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'email' => 'email|max:255',
           'first_name' => 'max:255',
           'last_name' => 'max:255'
        ];
    }

}
