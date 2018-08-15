<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Stripe\Account;
use Stripe\Customer;
use Stripe\Stripe;

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => md5($data['password']),
        ]);

        if ($user) {
            //create stripe account first
            $company_email = $data['email'];
            //create company's stripe account
            Stripe::setApiKey(getenv('STRIPE_API_KEY'));

            //check whether stripe account exists with this email
            $last_customer = null;
            $customer_looking_for = null;
            while (true) {
                $stripe_customers = Account::all(array("limit" => 100, "starting_after" => $last_customer));
                foreach ($stripe_customers->autoPagingIterator() as $stripe_customer) {
                    if ($stripe_customer->email == $company_email) {

                        $customer_looking_for = $stripe_customer;
                        break 2;
                    }

                }
                if (!$stripe_customers->has_more) {
                    break;
                }
                $last_customer = end($stripe_customers->data);
            }

            $id = '';

            if ($customer_looking_for) {

                $id = $customer_looking_for->id;

            } else {
                $stripe_account_data = [
                    "type" => "standard",
                    "email" => $company_email,
                    "country" => "us"
                ];

                $error_occur = false;
                try {
                    $result = Account::create($stripe_account_data);
                } catch (\Stripe\Error\InvalidRequest $e) {
                    $body = $e->getJsonBody();
                    $err = $body['error'];
                    //print('Message is:' . $err['message'] . "\n");
                    $error_occur = true;
                    return redirect()->back()->with('error', 'STRIPE ERROR: ' . $err['message']);
                }

                if (!$error_occur) {
                    $id = $result["id"];
                }
            }

            if ($id != "") {
                $user->stripe_account = $id;
                $user->save();
            }
        }

        return $user;
    }
}
