<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class UserRequest
 *
 * @package App\Http\Requests\User
 */
class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255'
        ];
    }

}
