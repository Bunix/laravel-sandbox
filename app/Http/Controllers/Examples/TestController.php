<?php

namespace App\Http\Controllers\Examples;

use App\Services\Support\Alert\Type\WebopsAlert as WebopsAlert;
use App\Services\Support\Logger\MyLogger as MyLogger;
use App\Services\Support\SMS\EmailSMSHandler;
use Illuminate\Routing\Controller;
//use Larablocks\Highway\Facade\Highway;

class TestController extends Controller
{

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
     */
    public function index()
    {
        er('Test Controller');
    }

    /**
     *  Test Alert Service
     *
     * @param WebopsAlert $alert_service
     * @internal param WebopsAlert $alert
     */
    public function alert(WebopsAlert $alert_service)
    {
        er('Alert Started');
        $result = $alert_service->alert('Test Alert');
        xr($result);
        er('Alert Sent');
    }

    /**
     *  Test Logger Service
     *
     * @param MyLogger $logger
     */
    public function logger(MyLogger $logger)
    {
        $logger->write('Test Info Log');
        $logger->write('Test Warning Log','warning');
        $logger->write('Test Error Log','error');
        er('Logs Written');
    }

    /**
     *  Test Text Service
     *
     * @param EmailSMSHandler $text
     */
    public function text(EmailSMSHandler $text)
    {
        er('Text Started');
        $result = $text->send('555555555', 'Verizon', 'Text to Me');
        xr($result);
        er('Text Sent');
    }

    /**
     *  Test Highway
     *
     */
//    public function highway()
//    {
//        Highway::addReader('database', ['table' => 'users']);
//        Highway::addWriter('csv', ['file_path' => public_path('csv/users.csv')]);
//        Highway::addWriter('csv', ['file_path' => public_path('csv/users-table-delimited.csv'), 'delimiter' => "\t", 'enclosure' => "'"]);
//        Highway::run();
//    }

}
