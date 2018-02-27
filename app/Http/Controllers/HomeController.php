<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Matriphe\Imageupload\Imageupload;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Hash;
use App\Company;
use App\Http\Requests\StoreCompanyPost;
use App\Http\Requests\UpdateCompanyPost;
use App\Http\Requests\StoreContainerPost;
use App\Http\Requests\UpdateContainerPost;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\CompanyImage;
use App\Container;
use League\Flysystem\File;
use Illuminate\Support\Facades\Storage;


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
        return view('welcome');
    }

    public function showProfile()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        return view('user_profile')->with('user', $user);
    }

    public function updateProfileSubmit(UpdateProfileRequest $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        //check old password
        $data = $request->except('token');
        //update with new password
        $user->update($data);
        $user->save();

        Auth::logout();

        return redirect()->route('login');

    }

    public function showChangePasswordForm()
    {
        return view('auth.passwords.changepassword');
    }

    public function changePassword(UpdatePasswordRequest $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

//        if (strcmp($request->get('new-password'), $request->get('new-password_confirmation')) != 0) {
//            return redirect()->back()->with("error", "New Password does not match with Confirmation Password.");
//        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with("success", "Password changed successfully !");

    }

    public function companies(Request $request)
    {
        $user_id = Auth::id();

        $cur_companies = Company::where('user_id', $user_id)->get();

        if ($request->has('active_company')) {
            $active_company_id = $request->input('active_company');
            return view('companies')->with('companies', $cur_companies)->with('active_company_id', $active_company_id);
        } else {
            return view('companies')->with('companies', $cur_companies);
        }
    }

    public function showCreateCompanyPage()
    {
        return view('add_company');
    }

    public function submitCreateCompany(Request $request)
    {
        $user_id = Auth::id();

        $c_image_id = null;
        //first, upload image
        if ($request->hasFile('avatar_image')) {
            $img_upload_manager = new ImageManager();
            $img_upload = new Imageupload($img_upload_manager);
            $upload_result = $img_upload->upload($request->file('avatar_image'));

            if ($upload_result) {
                $new_file_name = $upload_result['filename'];
                $c_image = CompanyImage::create(['filename' => $new_file_name, 'user_id' => $user_id]);
                $c_image_id = $c_image->id;
            }
        }

        $data = $request->all();
        $data = array_add($data, 'status', Company::COMPANY_STATUS_REVIEW);

        $company_code = mt_rand(10000000, 99999999);
        $data = array_add($data, 'code', $company_code);

        $data = array_add($data, 'user_id', $user_id);

        $data = array_add($data, 'avatar_id', $c_image_id);

        $new_company = Company::create($data);
        $new_company_id = $new_company->id;

        if ($new_company) {
            //status, company_code
            return Redirect()->route('companies')->with('active_company_id', $new_company_id);
        } else {
            return Redirect()->back();
        }
    }

    public function showEditCompanyPage($company_id)
    {
        $company = Company::find($company_id);
        if (!$company) {
            return redirect()->route('companies')->with('error', 'Can not find the company.');
        }
        return view('edit_company')->with('company', $company);
    }

    public function submitEditCompany(Request $request)
    {
        $user_id = Auth::id();
        $data = $request->all();

        $company_id = $data['company_id'];
        $company = Company::find($company_id);

        if (!$company) {
            return redirect()->back()->with('error', 'Can not find the company.');
        }

        $c_image_id = null;
        //first, upload image
        if ($request->hasFile('avatar_image')) {

            //remove old image
            $old_image = CompanyImage::find($company->avatar_id);
            if ($old_image) {
                $old_image->delete();
            }

            $img_upload_manager = new ImageManager();
            $img_upload = new Imageupload($img_upload_manager);
            $upload_result = $img_upload->upload($request->file('avatar_image'));

            if ($upload_result) {
                $new_file_name = $upload_result['filename'];
                $c_image = CompanyImage::create(['filename' => $new_file_name, 'user_id' => $user_id]);
                $c_image_id = $c_image->id;
                $data = array_add($data, 'avatar_id', $c_image_id);
            }
        }

        $updated_result = $company->update($data);

        return redirect()->route('companies')->with('active_company_id', $company_id);
    }


    public function removeCompany($company_id)
    {
        $company = Company::find($company_id);
        if ($company) {
            //remove container's image too
            $company_image = CompanyImage::find($company->avatar_id);

            $file_url = public_path('uploads/images/');
            $file_url .= $company_image->filename;
            if (file_exists($file_url)) {
                unlink($file_url);
            }

            $company_image->delete();

            $containers = Container::where('company_id', $company_id)->get();
            foreach ($containers as $container) {
                if ($container) {
                    $this->removeContainers($container->id);
                }
            }
            $company->delete();
        }

        return redirect()->route('companies');
    }


    /*Containers*/
    public function showContainersPage($company_id)
    {
        $user_id = Auth::id();
        $company = Company::find($company_id);
        if (!$company) {
            return redirect()->route('companies')->with('error', 'Can not find this company.');
        }

        $containers = Container::where('company_id', $company_id)->get();

        return view('containers')->with('containers', $containers)->with('company_id', $company_id)->with('company_name', $company->name);
    }

    public function showAddContainerPage($company_id)
    {
        $user_id = Auth::id();
        $company = Company::find($company_id);
        if ($company) {
            $company_name = $company->name;
            return view('add_container')->with('company_id', $company_id)->with('company_name', $company_name);
        } else {
            return redirect()->route('containers')->with('error', 'Can not find this company.');
        }
    }

    public function addContainerSubmit(Request $request)
    {
        $user_id = Auth::id();

        //upload image first
        $ct_image_id = null;
        //first, upload image
        if ($request->hasFile('image')) {
            $img_upload_manager = new ImageManager();
            $img_upload = new Imageupload($img_upload_manager);
            $upload_result = $img_upload->upload($request->file('image'));

            if ($upload_result) {
                $new_file_name = $upload_result['filename'];
                $c_image = CompanyImage::create(['filename' => $new_file_name, 'user_id' => $user_id]);
                $ct_image_id = $c_image->id;
            }
        }

        $data = $request->except('token');
        $data = array_add($data, 'image_id', $ct_image_id);
        $data = array_add($data, 'status', Container::CONTAINER_STATUS_ACTIVE);

        $company_id = $data['company_id'];

        $new_container = Container::create($data);

        if ($new_container) {
            //status, company_code
            return redirect()->to('/containers/' . $company_id);
        } else {
            return Redirect()->back();
        }
    }

    public function showEditContainerPage($company_id, $container_id)
    {
        $company = Company::find($company_id);
        $container = Container::find($container_id);
        if ($company && $container) {
            $company_name = $company->name;
            return view('edit_container')->with('company_id', $company_id)->with('company_name', $company_name)->with('container', $container);
        } else {
            return redirect()->route('containers')->with('error', 'Can not find this company.');
        }
    }

    public function editContainerSubmit(Request $request)
    {
        $user_id = Auth::id();

        $data = $request->except('token');
        $container_id = $data['container_id'];
        $container = Container::find($container_id);

        $company_id = $container->company_id;

        //first, upload image
        if ($request->hasFile('image')) {

            //remove old image
            $old_image = CompanyImage::find($container->image_id);
            $old_image->delete();

            $img_upload_manager = new ImageManager();
            $img_upload = new Imageupload($img_upload_manager);
            $upload_result = $img_upload->upload($request->file('image'));

            if ($upload_result) {
                $new_file_name = $upload_result['filename'];
                $c_image = CompanyImage::create(['filename' => $new_file_name, 'user_id' => $user_id]);
                $ct_image_id = $c_image->id;
                $data = array_add($data, 'image_id', $ct_image_id);
            }
        }


        $container->update($data);
        return redirect()->to('/containers/' . $company_id);
    }

    public function removeContainers($container_id)
    {
        $container = Container::find($container_id);
        if ($container) {
            //remove container's image too
            $container_image = CompanyImage::find($container->image_id);

            $file_url = public_path('uploads/images/');
            $file_url .= $container_image->filename;
            if (file_exists($file_url)) {
                unlink($file_url);
            }

            $container_image->delete();
            $container->delete();
        }
        return;
    }

    public function removeContainer($company_id, $container_id)
    {
        $this->removeContainers($container_id);
        return redirect()->to('/containers/' . $company_id);
    }

    public function showContainer($company_id, $container_id)
    {
        $container = Container::find($container_id);
        if ($container) {
            $container->status = Container::CONTAINER_STATUS_ACTIVE;
            $container->update();
        }

        return redirect()->to('/containers/' . $company_id);
    }

    public function hideContainer($company_id, $container_id)
    {
        $container = Container::find($container_id);
        if ($container) {
            $container->status = Container::CONTAINER_STATUS_HIDDEN;
            $container->update();
        }

        return redirect()->to('/containers/' . $company_id);
    }

}
