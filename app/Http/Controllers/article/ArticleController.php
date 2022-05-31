<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::get()->all();
        return view('articles.index',compact('articles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Category::get()->all();
        return view('articles.add',compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request)
    {
        
       DB::beginTransaction();

       try 
       {

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->desc;
        $article->user_id = Auth::user()->id;
        $article->save();
        //insert in pivot table
        $article->article_category()->attach($request->category);
        //upload image 
        $this->verifyAndStoreImage($request,'photo','articles','upload_image',$article->id,'App\Models\Article');
        DB::commit();
        toastr()->success('Data has been saved successfully!');
        return redirect()->route('articles.index');

       }
       catch(\Exception $e) 
       {

        DB::rollBack();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $art_id  = Crypt::decrypt($id);
        $article = Article::where('id',$art_id)->with('article_category')->get()->first();
        $category = Category::get()->all();
        return view('articles.edit',compact(['article','category']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $article = Article::findorfail($request->id);
            $article->title = $request->title;
            $article->description = $request->desc;
            $article->user_id = Auth::user()->id;
            $article->save();
            //update pivot table 
            $article->article_category()->sync($request->category);
            //update photo 
            if($request->has('photo')) {
                //delete old photo
                if($article->image) {
                  $old_image = $article->image->filename;
                  $this->Delete_attachment('upload_image','articles/'.$old_image,$request->id);  
                }
             //upload image 
             $this->verifyAndStoreImage($request,'photo','articles','upload_image',$article->id,'App\Models\Article');
            }
            DB::commit();
            toastr()->success('Data has been updated successfully!');
            return redirect()->back();
        }
        catch(\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        //delete photo.
        $image = Image::where('imageable_id',$request)->get();

        if($image){

            $this->Delete_attachment('upload_image','articles/article_img'.$request,$request); 

        }
        try {

            $article = Article::findorfail($request)->delete();
            toastr()->success('Data has been deleted!');
            return redirect()->route('articles.index');
        }catch(\Exception $e)
        {

            dd($e->getMessage());

        }
       
       


    }
}
