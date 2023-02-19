<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //DIRECT PIZZA LIST PAGE
    public function list(){
      $pizzas = Product::select('products.*','categories.name as category_name')
      ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
      })
            ->leftJoin('categories','products.category_id','categories.id')
            ->orderBy('products.id','desc')
            ->paginate(2);



        $pizzas->appends(request()->all());

        return view ('admin.products.pizzaList',compact('pizzas'));
    }

    // DIRECT CREATE PAGE
    public function createPage(){
        $categories = Category::select('id','name')->get();

        return view ('admin.products.create',compact('categories'));
    }

    //CREATE PIZZA
    public function create(Request $request){

        $this->productValidationCheck($request,'create');
        $data = $this->getProductsData($request);

        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);

        $data['image'] = $fileName;
        Product::create($data);

        return redirect()->route('products#list');


    }

    //DELETE PIZZA
        public function delete($id){
            Product::where('id',$id)->delete();
            return back()->with(['productDelete' => 'Delete Success']);
        }

    //EDIT PIZZA
        public function edit($id){
            $product = Product::where('id',$id)->first();
            $categories = Category::select('name','id')->get();
            return view('admin.products.editPage',compact('product','categories'));
        }

    //VIEW PIZZA
        public function view($id,request $request){
            $product = Product::select('products.*','categories.name as category_name')
            ->leftJoin('categories','products.category_id','categories.id')
            ->where('products.id',$id)->first();
            return view('admin.products.view',compact('product'));
        }

    //UPDATE PIZZA
        public function update(request $request){
            $this->productValidationCheck($request,"update");
            $data = $this->getProductsData($request);
            //get db image
            $dbImage = Product::where('id',$request->id)->first();
            $dbImage = $dbImage->image;

            if($request->hasFile('image')){
                    //delete old image
                    if($dbImage != null){
                        Storage::delete('public/'.$dbImage);
                    }

                    //store new image name
                    $fileName = uniqid().$request->file('image')->getClientOriginalName();

                    //store new image
                    $request->file('image')->storeAs('public',$fileName);
                    $data['image'] = $fileName;

                                }

            Product::where('id',$request->id)->update($data);
            return redirect()->route('products#list')->with(['updateSuccess' => 'Update Success']);


        }


    //PRODUCT VALIDATION CHECK
    private function productValidationCheck($request,$status){

       $validationRules= [
            'name' => 'required|min:4|unique:products,name,'.$request->id,
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'waitingTime' => 'max:6',
        ];

        $validationRules['image'] = $status == "create" ?  'mimes:png,jpg,jpeg,webp,avif|file|required' : 'mimes:png,jpg,jpeg,webp,avif|file';

        Validator::make($request->all(),$validationRules)->validate();
    }

    //updateValidationCheck

    //GET PRODUCT DATA
    private function getProductsData($request){
            return [
                'name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
                'waiting_time' => $request->waitingTime,
                // 'view_count' => $request->viewCount,
                'updated_at' => Carbon::now(),
            ];
    }
}
