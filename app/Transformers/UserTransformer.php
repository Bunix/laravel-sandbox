<?php namespace App\Transformers;

use App\Models\User\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 *
 * @package App\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform Function
     *
     * @param User $object
     * @return array
     */
    public function transform(User $object)
    {
        return [
            'id' => (int) $object->id,
            'email' => $object->email,
            'first_name' => $object->first_name,
            'last_name' => $object->last_name,
            'created_at' => Carbon::parse($object->created_at)->format('F d, Y h:i:s a'),
            'updated_at' => Carbon::parse($object->updated_at)->format('F d, Y h:i:s a')
        ];
    }

}