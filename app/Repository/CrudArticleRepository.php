<?php

namespace App\Repository;

use App\Interfaces\CrudArticleInterface;
use App\Http\Requests\ArticlesRequest;
use App\Interfaces\CrudRepositoryInterface;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use App\Traits\UploadTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CrudArticleRepository implements CrudArticleInterface
{

    use UploadTrait;

    public function index() 
    {

        //index.
        $articles = Article::get()->all();
        return view('articles.index',compact('articles'));

    }

    public function create() 
    {
        //create  
        $category = Category::get()->all();
        return view('articles.add',compact('category'));  

    }

    public function store($request) 
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

    public function edit($id) 
    {

       //edit.
       $art_id  = Crypt::decrypt($id);
       $article = Article::where('id',$art_id)->with('article_category')->get()->first();
       $category = Category::get()->all();
       return view('articles.edit',compact(['article','category']));

    }

    public function update($request) 
    {

       //update.
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

    public function destroy($id) 
    {

              //delete photo.
              $image = Image::where('imageable_id',$id)->get();

              if($image){
      
                  $this->Delete_attachment('upload_image','articles/article_img'.$id,$id); 
      
              }
              try 
              {
      
                  $article = Article::findorfail($id)->delete();
                  toastr()->success('Data has been deleted!');
                  return redirect()->route('articles.index');
                  
              }catch(\Exception $e)
              {
      
                  dd($e->getMessage());
      
              }

    }

}