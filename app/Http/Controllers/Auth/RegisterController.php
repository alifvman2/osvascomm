<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\MailCreateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_telp' => ['required', 'string', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $password = Str::random(8);
        $hashedPassword = Hash::make($password);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'password' => $hashedPassword,
            'created_by'=> 1,
        ]);

        $user->update(['created_by' => $user->id]);

        $emailData = [
            'appName'   => config('app.name', 'Laravel'),
            'created_by'=> $user->name,
            'createMail'=> $user->email,
            'name'      => $user->name,
            'no_telp'   => $user->no_telp,
            'email'     => $user->email,
            'password'  => $password,
            'logo'      => public_path('assets/logo.png'),
        ];

        Mail::to($user->email)
            ->send(new MailCreateUser($emailData));

        return $user;

    }
}
