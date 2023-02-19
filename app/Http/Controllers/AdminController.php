<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
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

    // ACCOUNT DETAILS
    public function details(){
        return view ('admin.account.details');
    }

    //ACCOUNT EDIT
    public function edit(){
        return view ('admin.account.edit');
    }

    //VIEW ADMIN LIST
    public function list(){
        $admins = User::when(request('key'),function($query){
                $query->orWhere('name','like','%'.request('key').'%')
                       ->orWhere('email','like','%'.request('key').'%')
                       ->orWhere('gender','like','%'.request('key').'%')
                       ->orWhere('phone','like','%'.request('key').'%')
                       ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')
        ->paginate(2); //no need get metho when using paginate...

        $admins->appends(request()->all());
        return view('admin.account.adminList',compact('admins'));
    }

    //Delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['listDelete' => 'Admin List Deleted']);//can't use viwe method only work back method
    }

    //Change Role Page
    public function changeRolePage($id){
        $accounts = User::where('id',$id)->first();
        return view('admin.account.changeRolePage',compact('accounts'));
    }

    //change Role

    public function changeRole($id,request $request){
        $data= $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //request user data
    private function requestUserData($request){
        return [
            'role' => $request->role
        ];
    }

    //ACCOUNT UPDATE
    public function update($id, Request $request){

        $this->userValidationCheck($request);
        $data = $this->getUserData($request);

        //image
        if($request->hasFile('image')){

            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin account Updated']);
    }

    // USER VALIDATION CHECK
    private function userValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ],
        [

        ])->validate();
    }

    // GET USER DATA
    private function getUserData($request){
            return [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'updated_at' => Carbon::now(),
            ];
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
