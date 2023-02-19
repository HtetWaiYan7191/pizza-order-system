<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //list function
    public function list(){

        $categories = Category::when(request('key'),function($query){
                $query->where('name','like','%'. request('key') .'%');
        })
        ->orderBy('id','desc')
        ->paginate(4);
        $categories->appends(request()->all());
        // dd($categories->toArray());
         // USE TOARRAY TO VIEW DATA //remove toarray when import data
        return view('admin.category.list',compact('categories'));
    }

    //create page function
    public function createPage(){
        return view ('admin.category.create');
    }

    //create post function
    public function createPost(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['categorySuccess' => 'Category Success...']);
    }

    //delete function
    public function delete($id){
            Category::where('id',$id)->delete();
            return back()->with(['categoryDelete' => 'Category Deleted...']);
    }


    //edit function
    public function edit($id){
        $category = Category::where('id',$id)
        ->first();
        return view('admin.category.edit',compact('category'));

    }

    //update function
    public function update(request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');


    }







    //category validation check
    private function categoryValidationCheck($request){
            Validator::make($request->all(),[
                'categoryName' => 'required|min:4|unique:categories,name,'.$request->categoryId,
            ],
            [
                'categoryName.required' => "need to be filled",
            ])->validate();
    }

    //converting request category data To ARRAY FORMAT
    private function requestCategoryData($request){
        return
            [
                'name' => $request->categoryName
            ];
    }


}
