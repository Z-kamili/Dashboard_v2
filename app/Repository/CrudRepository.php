<?php

namespace App\Repository;

use App\Interfaces\CrudRepositoryInterface;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CrudRepository implements CrudRepositoryInterface
{

    public function index() {

        $categories = Category::get()->all();
        return view('categories.categories',compact('categories'));

    }

    public function create() {

        $categories = Category::get()->all();
        return view('categories.add',compact('categories'));

    }

    public function store($request) {

     try
        {
            $category = new Category();
            $category->user_id = Auth::user()->id;
            $category->title = $request->title;
            $category->description  = $request->Desc;
            $category->save(); 
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('category.create');
        } 
        catch(\Exception $e)
        {
          toastr()->error('An error has occurred please try again later.');
          return redirect()->back()->with(['error'=>$e->getMessage()]);
        }

    }

    public function edit($id) {

        $cat_id = Crypt::decrypt($id);
        $category = Category::findOrFail($cat_id);
        return view('categories.edit',compact('category'));

    }

    public function update($request) {

        try{

            $category = Category::findOrFail($request->id);
            $category->title = $request->title;
            $category->description  = $request->Desc;
            $category->save();
            toastr()->success('update successfully');
            return redirect()->route('category.index');

        }catch(Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function destroy($id) 
    {
        Category::destroy($id);
        toastr()->success('Data has been saved successfully!');
        return redirect()->route('category.index');
    }

}