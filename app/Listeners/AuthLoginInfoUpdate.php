<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthLoginInfoUpdate
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        Auth::user()->last_login = Carbon::now();
        Auth::user()->last_login_ip = Request::getClientIp();
        Auth::user()->save();
    }
}
