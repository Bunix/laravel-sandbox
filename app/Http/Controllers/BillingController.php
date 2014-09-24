<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Services\Billing\BillingInterface as BillingInterface;

class BillingController extends Controller
{

    protected $billing_service;

    public function __construct(BillingInterface $b)
    {
        $this->billing_service = $b;
        $this->billing_service = \App::make('StripeBilling');
    }


    public function getIndex()
    {
        //echo $this->billing_service->display();
    }

}
