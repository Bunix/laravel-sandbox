<?php

namespace App\Services\Support;

use App\Services\ServiceAbstract;

/**
 * Class SupportServiceAbstract
 *
 * @package App\Services\Support
 */
abstract class SupportServiceAbstract extends ServiceAbstract
{
    /**
     * Service Type
     *
     * @var string
     */
    protected $service_type = 'support';
}