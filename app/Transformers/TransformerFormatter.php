<?php

namespace App\Transformers;

use Carbon\Carbon;

/**
 * Class TransformerFormatter
 *
 * @package App\Services\Transformers
 */
trait TransformerFormatter
{

    /**
     * Return Formatted Date
     *
     * @param $date
     * @return string
     */
    protected function formatDate($date)
    {
        return (string) Carbon::parse($date)->format('Y-d-m');
    }

    /**
     * Return Formatted Date Time
     *
     * @param $date
     * @return string
     */
    protected function formatDateTime($date)
    {
        return (string) Carbon::parse($date)->toIso8601String();
    }
}