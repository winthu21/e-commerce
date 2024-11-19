<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    //category list
    public function list(){
        // $data = Category::get();
        $data = Category::orderBy('created_at','desc')->paginate(5);
        // $data = Category::paginate(5);
        return view('admin.category.list',compact('data'));
    }

    // category create page
    public function createPage(){
        return view('admin.category.create');
    }

    // create category
    public function create(Request $request){
        // dd($request->all());
        $validator=$request->validate([
            'category'=>'required|unique:categories,name'
        ]);

        Category::create([
            'name'=>$request->category
        ]);

        Alert::success('Create Success', 'New category created.....');

        return back();
        // return to_route('categoryList');
    }

    // delete category
    public function delete($id){
        // dd($id);
        Category::where('id',$id)->delete();

        Alert::success('Delete Success', 'Category deleted....');
        return back();
    }

    // edit category
    public function edit($id){
        $data = Category::where('id',$id)->first();
        // dd($data);
        return view('admin.category.edit',compact('data'));
    }

    public function update(Request $request){
        $validator=$request->validate([
            'category'=>'required|unique:categories,name,'.$request->categoryID
        ]);
        // dd($request)->array();
        Category::where('id',$request->categoryID)->update([
            'name'=> $request->category,
        ]);

        Alert::success('Update Success', 'Category successfully updated....');

        return to_route('categoryList');
    }
}
