<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class InstrumentController extends Controller


{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Instrument::all();
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
            'instrument_name' => 'required',
            'instrument_desc' => 'required',
            'instrument_brand' => 'required',
            'instrument_price' => 'required',
            'instrument_img' => 'image|file|max:1024',
            'instrument_count' => 'required',
            'instrument_status' => 'required',

        ]);
       // Upload an Image File to Cloudinary with One line of Code
       $nama_file = Cloudinary()->upload($request->file('instrument_img')->getRealPath(),[
           "folder" =>"Instrument",
       ])->getSecurePath();

       $input = Instrument::create([
            'instrument_name' =>$request->instrument_name,
            'instrument_desc' =>$request->instrument_desc,
            'instrument_brand' =>$request->instrument_brand,
            'instrument_price' =>$request->instrument_price,
            'instrument_img' =>$nama_file,
            'instrument_count' =>$request->instrument_count,
            'instrument_status' =>$request->instrument_status,

        ]);
        $response = [
            'message'=>'instrument Added Succesfully',
            'instrument' => $input,
            
            
        ];

         return response($response); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailInstrument($id)
    {
        $result=Instrument::find($id);
        
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
            'instrument_name' => 'required',
            'instrument_desc' => 'required',
            'instrument_brand' => 'required',
            'instrument_price' => 'required',
            'instrument_img'=>'required',
            'instrument_count' => 'required',
            'instrument_status' => 'required',

        ]);
        
       /*Upload an Image File to Cloudinary with One line of Code
       $nama_file = Cloudinary()->upload($request->file('instrument_img')->getRealPath(),[
           "folder" =>"Instrument",
       ])->getSecurePath();*/
        $input = Instrument::find($id);
        $input -> instrument_name = $request->instrument_name;
        $input -> instrument_desc = $request->instrument_desc;
        $input -> instrument_brand = $request->instrument_brand;
        $input -> instrument_price = $request->instrument_price;
        $input -> instrument_img = $request->instrument_img;
        $input -> instrument_count = $request->instrument_count;
        $input -> instrument_status = $request->instrument_status;
        $input->save();
        $response = [
            'message'=>'instrument Update Succesfully',
            'instrument' => $input,
            
            
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
        Instrument::destroy($id);
        $response = [
			'message'=>'Instrument has been deleted ',
            
            
		
        ];
        return response($response);
    }
     /**
     * Search by status instrument
     *
     * @param  str  $instrument_status
     * @return \Illuminate\Http\Response
     */
    public function filterByStatus($instrument_status)
    {
      $filterStatus = Instrument::where('instrument_status', 'like', '%'.$instrument_status.'%')->get();
      $count = Instrument::where('instrument_status', 'like', '%'.$instrument_status.'%')->get()->count();
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
    public function filterByName($instrument_name)
    {
      $filterName = Instrument::where('instrument_name', 'like', '%'.$instrument_name.'%')->get();
      $count = Instrument::where('instrument_name', 'like', '%'.$instrument_name.'%')->get()->count();
      $response = [
            'message'=>'Fetch All Data ',
            'Total' => $count,
            'Results' => $filterName
        
         ];
     return response($response);
  
    }
       /**
     * Search for a name
     *
     * @param  str  $instrument_brand
     * @return \Illuminate\Http\Response
     */
    public function filterByCategory($instrument_brand)
    {
      $filterCategory = Instrument::where('instrument_brand', 'like', '%'.$instrument_brand.'%')->get();
      $count = Instrument::where('instrument_brand', 'like', '%'.$instrument_brand.'%')->get()->count();
      $response = [
            'message'=>'Fetch All Data ',
            'Total' => $count,
            'Results' => $filterCategory
        
         ];
     return response($response);
  
    }
}
