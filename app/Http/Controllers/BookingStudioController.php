<?php

namespace App\Http\Controllers;
use App\Models\BookingStudio;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Notifications\BookingStudioNotification;

class BookingStudioController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookingStudio::all();
      
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createBookingStudio(Request $request)
    {
        $book = new BookingStudio();
        $book->name = $request->name;
        $book->email = $request->email;
        $book->studio_name = $request->studio_name;
        $book->studio_price = $request->studio_price;
        $book->date = $request->date;
        $book->duration = $request->duration;
        $book->studio_id = $request->studio_id;
        $book->user_id = $request->user_id;
        $book->total= $request->total;
        $book->save();
       
        $book->notify(new BookingStudioNotification($book));
           $response = [
                'status'=>'Booking Succesfully',
                'booking' => $book,
                'message' => 'Silahkan cek email kamu untuk detail pembayaran '
  
            
            ];
            
            
            return response($response); 
    }

 // melihat list booking user tertentu
 public function MyBookingStudio($user_id){
        
    // return Booking::find($id);
    $mybooking = BookingStudio::where('user_id', 'like', '%'.$user_id.'%')->get();
    $count = BookingStudio::where('user_id', 'like', '%'.$user_id.'%')->get()->count();
    $response = [
        
        'message'=>'Fetch All Data',
        'Total' => $count,
        'booking' => $mybooking,

    ];
    return response($response);

}
   
// membatalkan booking
public function cancelBookingStudio(Request $request,$id)
{
    $booking = BookingStudio::find($id);
    $booking->status_booking = $request->status_booking='Canceled';
    $booking->save();

    $response = [
        'message'=>'Booking Has been Canceled',
        'booking' => $booking,
        
        
    ];

     return response($response); 
}

// menyetujui booking
public function AcceptBookingStudio(Request $request,$id)
{
    $booking = BookingStudio::find($id);
    $booking->status_booking = $request->status_booking='Approved';
    $booking->save();

    $response = [
        'message'=>'Booking Has been Approved',
        'booking' => $booking,
        
        
    ];

     return response($response); 
}
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //hapus riwayat booking
    public function deleteBookingStudio($id)
    {
        $booking = BookingStudio::destroy($id);
        $response = [
			'message'=>'Booking has been deleted',
           
  
        ];
        return response($response);
        
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //melihat semua booking
    public function allBookingStudio()
    {
       
      
            $booking = BookingStudio::all();
            $count = BookingStudio::all()->count();
            $response = [
                'message'=>'Fetch All Booking Studio List',
                'Total' => $count,
                'List booking' => $booking
               
      
            ];
            return response($response);
       
    }
}
