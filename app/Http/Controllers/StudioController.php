<?php

namespace App\Http\Controllers;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Studio::all();
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
            'studio_name' => 'required',
            'studio_desc' => 'required',
            'studio_capacity' => 'required',
            'studio_price' => 'required',
            'studio_img' => 'image|file|max:1024',
            'studio_available_day' => 'required',
            'studio_status' => 'required',

        ]);
        // Upload an Image File to Cloudinary with One line of Code
        $nama_file = Cloudinary()->upload($request->file('studio_img')->getRealPath(),[
            "folder" =>"Studio",
        ])->getSecurePath();

       $input = Studio::create([
            'studio_name' =>$request->studio_name,
            'studio_desc' =>$request->studio_desc,
            'studio_capacity' =>$request->studio_capacity,
            'studio_price' =>$request->studio_price,
            'studio_img' =>$nama_file,
            'studio_available_day' =>$request->studio_available_day,
            'studio_status' =>$request->studio_status,

        ]);
        $response = [
            'message'=>'Studio Added Succesfully',
            'studio' => $input,
            
            
        ];

         return response($response); 

      
            
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailStudio($id)
    {
        $result=Studio::find($id);
        
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
     * @param  \App\Studio  $Studio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//BELUM BISA UPDATE DONGGG :()
    {
        $studio = Studio::find($id);
        $studio->studio_name = $request->studio_name;
        $studio->studio_desc = $request->studio_desc;
        $studio->studio_capacity = $request->studio_capacity;
        $studio->studio_price = $request->studio_price;
        $studio->studio_img = $request->studio_img; //alternatif pake link
        $studio->studio_available_day = $request->studio_available_day;
        $studio->studio_status = $request->studio_status;

       

        $studio->save();
    
        $response = [
            'message'=>'Studio Updated Succesfully',
            'studio' => $studio,
            
            
        ];
    
         return response($response); 

         
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_Studio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Studio::destroy($id);
        $response = [
			'message'=>'Studio has been deleted ',
            
            
		
        ];
        return response($response);
    }

     /**
     * Search by status studio
     *
     * @param  str  $studio_status
     * @return \Illuminate\Http\Response
     */
    public function filterByStatus($studio_status)
    {
      $filterStatus = Studio::where('studio_status', 'like', '%'.$studio_status.'%')->get();
      $count = Studio::where('studio_status', 'like', '%'.$studio_status.'%')->get()->count();
      $response = [
            'message'=>'Fetch All Data ',
            'Total' => $count,
            'Results' => $filterStatus
        
         ];
     return response($response);
  
    }

       /**
     * Search for a name
     *
     * @param  str  $studio_status
     * @return \Illuminate\Http\Response
     */
    public function filterByDay($studio_available_day)
    {
      $filterDay = Studio::where('studio_available_day', 'like', '%'.$studio_available_day.'%')->get();
      $count = Studio::where('studio_available_day', 'like', '%'.$studio_available_day.'%')->get()->count();
      $response = [
            'message'=>'Fetch All Data ',
            'Total' => $count,
            'Results' => $filterDay
        
         ];
     return response($response);
  
    }
     /**
     * Search for a name
     *
     * @param  str  $studio_status
     * @return \Illuminate\Http\Response
     */
    public function filterByName($studio_name)
    {
      $filterName = Studio::where('studio_name', 'like', '%'.$studio_name.'%')->get();
      $count = Studio::where('studio_name', 'like', '%'.$studio_name.'%')->get()->count();
      $response = [
            'message'=>'Fetch All Data ',
            'Total' => $count,
            'Results' => $filterName
        
         ];
     return response($response);
  
    }
    public function TotalStudio()
    {
        $total=  Studio::all()->count();
        $response = [
            'Total' => $total, 
        
         ];
     return response($response);

    }
}
