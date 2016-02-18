<?php

namespace App\Http\Controllers\Examples;

use App\Models\User\User;
use App\Services\Support\Alert\Type\WebopsAlert as WebopsAlert;
use App\Services\Support\Logger\MyLogger as MyLogger;
use App\Services\Support\SMS\EmailSMSHandler;
use Illuminate\Routing\Controller;

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
     * @return Response
     */
    public function getIndex()
    {
        er('Test Controller');
    }

    /**
     *  Test Alert Service
     *
     * @param WebopsAlert $alert_service
     * @internal param WebopsAlert $alert
     */
    public function getAlert(WebopsAlert $alert_service)
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
    public function getLogger(MyLogger $logger)
    {
        $logger->write('Test Info Log', 'Test Controller', 0);
        $logger->write('Test Warning Log', 'Test Controller', 0, 'warning');
        $logger->write('Test Error Log', 'Test Controller', 0, 'error');
        er('Logs Written');
    }

    /**
     *  Test Text Service
     *
     * @param EmailSMSHandler $text
     */
    public function getText(EmailSMSHandler $text)
    {
        er('Text Started');
        $result = $text->send('9046109373', 'Verizon', 'Text to Eric');
        xr($result);
        er('Text Sent');
    }

    /**
     *  Test User Model
     *
     */
    public function getModel(User $user_model)
    {
        $user = $user_model->find(1);

        pr($user->created_at,1);
    }

}
