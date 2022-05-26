<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::get()->all();
        return view('categories.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::get()->all();
        return view('categories.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try
        {
            $category = new Categorie();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categorie::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try{

            $category = Categorie::findOrFail($request->id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categorie::destroy($id);
        toastr()->success('Data has been saved successfully!');
        return redirect()->route('category.index');
    }
}
