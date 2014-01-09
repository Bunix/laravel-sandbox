<?php

use NewProject\Repositories\User\UserRepositoryInterface as UserRepositoryInterface;
use NewProject\Validator\User\EditValidator;

class UserAdminController extends BaseController {

    /**
     * User Repository
     *
     * @var User
     */
    protected $user_repo;
    protected $user_edit_validator;

    public function __construct(UserRepositoryInterface $user_repo, EditValidator $user_edit_validator)
    {
        $this->user_repo = $user_repo;
        $this->user_edit_validator = $user_edit_validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('Admin::users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('Admin::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, User::$rules);

        if($validation->passes())
        {
            $this->user_repo->createRow($input);

            return Redirect::route('Admin::users.index');
        }

        return Redirect::route('Admin::users.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //$user = $this->user_repo->findById($id, true);

        return View::make('Admin::users.show', compact('user'))->withInput;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user_repo->findById($id);

        if(is_null($user))
        {
            return Redirect::route('Admin::users.index');
        }

        return View::make('Admin::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');

        if($this->user_edit_validator->passes())
        {
            $user = $this->user_repo->findById($id);
            $user->updateRow($input);

            return Redirect::route('users.index');
        }

        return Redirect::route('users.edit', $id)
            ->withInput()
            ->withErrors($this->user_edit_validator->getErrors())
            ->with('message', 'There were validation errors.');
    }

    /**
     *  Delete user.
     *
     */
    public function delete()
    {
        $input = array_except(Input::all(), '_method');

        $this->user_repo->deleteRow($input['id']);
    }

    /**
     * Get Feed for datatables admin.
     *
     * @return JSON
     */
    public function dataFeed()
    {
        $users = $this->user_repo->getDataTable();

        return Datatables::of($users)
            ->edit_column('last_login','{{ date("m/d/Y g:i a", $last_login) }}')
            ->edit_column('created','{{ date("m/d/Y g:i a", strtotime($created)) }}')
            ->add_column('crud_actions', '<a href="users/{{$id}}/edit"><button class="action-button">Edit</button></a>
                                          <button class="action-button delete" user_id="{{$id}}">Delete</button>')
            ->add_column(
            'custom actions','@if($status == "USER_ACTIVE")
                            <button class="action-button change-status" status="{{$status}}" user_id="{{$id}}">Suspend User</button>
                        @else
                            <button class="action-button change-status" status="{{$status}}" user_id="{{$id}}">Activate User</button>
                        @endif
                            <button class="action-button resend-activation" user_id="{{$id}}">Resend Activation</button>
                            <button class="action-button password-reset" user_id="{{$id}}">Send Password Reset</button>')->make();
    }

    /**
     * Change User Status.
     *
     */
    public function changeStatus()
    {
        $input = array_except(Input::all(), '_method');

        $user = $this->user_repo->findById($input['id'], true);

        $user->updateRow(array('objectstate_id' => constant($input['status'])));
    }

    public function resendActivation()
    {
        $input = array_except(Input::all(), '_method');
        $user = $this->user_repo->findById($input['id'], true);

        $html = '<a href="https://www.carepilot.com"><img src="https://www.carepilot.com/ui/common/images/logo-white.png" alt=""></a><br /><br />' .
                $user['first_name'] . ' ' . $user['last_name'] . ',<br />
                Please click the following link (or paste the link into a browser’s location bar) to activate your account.<br />
                <a href="https://www.carepilot.com/users/activate?rid=' . $user['activate_rid'] . '">https://www.carepilot.com/users/activate?rid=' . $user['activate_rid'] . '</a><br />
                <br />
                Thank you for registering on CarePilot. Please use this email address ' . $user['email'] . ' to log in to your account in the future.<br />
                <br />
                We invite you to visit our facebook page at <a href="http://www.facebook.com/pages/CarePilotcom/191604534221426">http://www.facebook.com/pages/CarePilotcom/191604534221426</a> and become a fan of a new kind of healthcare... an online marketplace where you can finally access quality doctors and choose the right price, place and time for your procedure.<br />
                <br />
                Thank you.<br />
                <br />
                Your CarePilot Team';

        $payload = array(
            'message' => array(
                'subject' => 'CarePilot User Activation',
                'html' => $html,
                'from_email' => 'support@carepilot.com',
                'to' => array(array('email'=>$user['email']))
            )
        );

        $response = Mandrill::request('messages/send', $payload);
    }

    public function  passwordReset()
    {
        $input = array_except(Input::all(), '_method');
        $user = $this->user_repo->findById($input['id'], true);

        $html = '<a href="https://www.carepilot.com"><img src="https://www.carepilot.com/ui/common/images/logo-white.png" alt=""></a><br /><br />' .
                $user['first_name'] . ' ' . $user['last_name'] . ',<br />
                Resetting your password is easy. Simply click the secure link below and select a new password for your CarePilot account.<br />
                <a href="https://www.carepilot.com/users/actforgotpassword?rid=' . $user['activate_rid'] . '">https://www.carepilot.com/users/actforgotpassword?rid=' . $user['activate_rid'] . '</a><br />
                Thank you.<br />
                <br />
                Your CarePilot Team';

        $payload = array(
            'message' => array(
                'subject' => 'CarePilot Password Reset',
                'html' => $html,
                'from_email' => 'support@carepilot.com',
                'to' => array(array('email'=>$user['email']))
            )
        );

        $response = Mandrill::request('messages/send', $payload);
    }


}
