<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreCompanyPost;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showCreateCompanyPage()
    {
        return view('create_company');
    }

    public function submitCreateCompany(StoreCompanyPost $request)
    {
        $data = $request->all();
        $password = $data['password'];
        $new_password = bcrypt($password);
        $data['password']  = $new_password;
        $new_company = Company::create($data);

        return Redirect::to('home')
            ->with('message', 'User created successfully');
    }
}
