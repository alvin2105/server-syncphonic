<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::all();
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title_blog' => 'required',
            'image' => 'image|file|max:1024',
            'content' => 'required',
            'category' => 'required',
            'date' => 'required',
            

        ]);
       // Upload an Image File to Cloudinary with One line of Code
       $nama_file = Cloudinary()->upload($request->file('image')->getRealPath(),[
           "folder" =>"Blog",
       ])->getSecurePath();

       $input = Blog::create([
            'title_blog' =>$request->title_blog,
            'image' =>$nama_file,
            'content' =>$request->content,
            'category' =>$request->category,
            'date' =>$request->date,
        ]);
        $response = [
            'message'=>'Blog Added Succesfully',
            'Blog' => $input,
            
            
        ];

         return response($response); 

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailBlog($id)
    {
        $result=Blog::find($id);
        
        $response = [
            
            'result' => $result
        ];
        return response($response); 
    }

   
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  \App\Instrument  $Instrument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//UPDATE IMAGENYA BELUM JADI :(())
    {
        
        $this->validate($request,[
            'title_blog' => 'required',
            'image' => 'required',
            'content' => 'required',
            'category' => 'required',
            'date'=>'required',
           

        ]);
        
       
        $input = Blog::find($id);
        $input -> title_blog= $request->title_blog;
        $input -> image = $request->image;
        $input -> content = $request->content;
        $input -> date = $request->date;
        $input -> category = $request->category;
        $input->save();
        $response = [
            'message'=>'Blog Update Succesfully',
            'Blog' => $input,
            
            
        ];

         return response($response); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_instrument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::destroy($id);
        $response = [
			'message'=>'Blog has been deleted ',
            
            
		
        ];
        return response($response);
    }
     /**
     * Search by status instrument
     *
     * @param  str  $category
     * @return \Illuminate\Http\Response
     */
    public function filterByCategory($category)
    {
      $filterCategory = Blog::where('category', 'like', '%'.$category.'%')->get();
      $count = Blog::where('category', 'like', '%'.$category.'%')->get()->count();
      $response = [
            'message'=>'Fetch All Data ',
            'Total' => $count,
            'Results' => $filterCategory
        
         ];
     return response($response);
  
    }

       /**
     * Search for a name
     *
     * @param  str  $title_blog
     * @return \Illuminate\Http\Response
     */
    public function filterByTitle($title_blog)
    {
      $filterTitle = Blog::where('title_blog', 'like', '%'.$title_blog.'%')->get();
      $count = Blog::where('title_blog', 'like', '%'.$title_blog.'%')->get()->count();
      $response = [
            'message'=>'Fetch All Data ',
            'Total' => $count,
            'Results' => $filterTitle
        
         ];
     return response($response);
  
    }
}
