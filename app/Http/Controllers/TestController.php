<?php namespace App\Http\Controllers;

use App\Services\Support\Alert\Type\WebopsAlert as WebopsAlert;

class TestController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getIndex()
    {

    }


    /**
     *  Test Alert Service
     * @param WebopsAlert $alert_service
     * @internal param WebopsAlert $alert
     */
    public function getAlert(WebopsAlert $alert_service)
    {
       $alert_service->alert('Test Alert', 'This is a test alert', '');

    }

    /**
     *  Test Logger Service
     */
    public function getLogger()
    {

    }

}
