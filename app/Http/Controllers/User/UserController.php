<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //USER MAIN HOMEPAGE
    public function homePage(){
        $pizzas = Product::orderBy('id','desc')->get();
        $categories = Category::get();
        return view ('user.main.home',compact('pizzas','categories'));
    }

    //USER CHANGE PASSWORD PAGE
    public function changePasswordPage(){
        return view('user.password.changePassword');
    }

    //USER CHANGE PASSWORD
    public function changePassword(Request $request){
        // $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data= [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['passwordMessage' => 'Password Change Success...']);
        }
        return back()->with(['notMatch' => 'The Old Password does not match']);
    }

    //ACCOUNT VIEW PAGE
    public function viewPage(){
        return view('user.account.view');
    }

    //ACCOUNT EDIT PAGE
    public function editPage(){
        return view('user.account.edit');
    }

    //ACCOUNT UPDATE
    public function update($id,Request $request){
            $this->userValidationCheck($request);
            $data = $this->getUserData($request);

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
            return redirect()->route('user#viewPage')->with(['updateSuccess' => 'User Account Updated']);
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
