<?php namespace App\Transformers;

use App\Models\User\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 *
 * @package App\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    use TransformerFormatter;

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
            'created_at' => $this->formatDateTime($object->created_at),
            'updated_at' => $this->formatDateTime($object->updated_at)
        ];
    }

}