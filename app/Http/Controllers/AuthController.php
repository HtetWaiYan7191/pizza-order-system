<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //direct login page
    public function loginPage(){
        return view('login');
    }

    //direct register page
    public function registerPage(){
        return view ('register');
    }

    //direct dashboard page
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#homePage');
    }

    //CHANGE PASSWORD PAGE
    public function changePasswordPage(){
        return view ('admin/account/changePassword');

    }

    //CHANGE PASSWORD
    public function changePassword(Request $request){
        // 1.all field must be filled
        // 2.new password % confirm password length must be greater than 6
        // 3.new password and confirm password must same
        // 4.client old password must be same with db password
        // 5.password change

        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;
        if(Hash::check($request->oldPassword, $dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            return back()->with(['passwordMessage' => 'Password Change Success...']);

        }

        return back()->with(['notMatch' => 'The Old Password does not match']);
    }

    //PASSWORD VALIDATION CHECK
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
                'oldPassword' => 'required|min:6',
                'newPassword' => 'required|min:6|same:confirmPassword',
                'confirmPassword' => 'required|min:6|same:newPassword',
        ],[
                'oldPassword.required' => 'Need to be Filled ',
                'newPassword.required' => 'Need to be Filled ',
                'confirmPassword.required' => 'Need to be Filled ',

        ])->validate();
    }
}
