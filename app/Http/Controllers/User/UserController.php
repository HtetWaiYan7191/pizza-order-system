<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
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
        $pizzas = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        return view ('user.main.home',compact('pizzas','categories','carts'));
    }

    //USER FILTER PAGE
    public function filter($categoryId){
        $pizzas = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        return view ('user.main.home',compact('pizzas','categories','carts'));
    }

    //HISTORY PAGE
    public function history(){
        $orders = Order::where('user_id',Auth::user()->id)->paginate(4);
        return view('user.main.history',compact('orders'));
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

    //DIRECT PIZZA DETAILS
    public function pizzaDetails($pizzaId){
        $pizzas = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizzas','pizzaList'));
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

    //USER CART LIST
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)->get();

        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->quantity;
        }


        return view('user.main.cart',compact('cartList','totalPrice'));
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
