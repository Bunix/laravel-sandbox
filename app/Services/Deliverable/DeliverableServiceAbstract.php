<?php

namespace App\Services\Deliverable;

use App\Services\ServiceAbstract;

/**
 * Class DeliverableServiceAbstract
 *
 * @package App\Services\Deliverable
 */
abstract class DeliverableServiceAbstract extends ServiceAbstract
{
    /**
     * Service Type
     *
     * @var string
     */
    protected $service_type = 'deliverable';
}