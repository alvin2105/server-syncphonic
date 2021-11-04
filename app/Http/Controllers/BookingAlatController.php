<?php

namespace App\Http\Controllers;
use App\Models\BookingAlat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\BookingAlatNotification;
use PhpParser\Node\Expr\Cast\Array_;


class BookingAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookingAlat::all();
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createBookingInstrument(Request $request)
    {
       
        $book = new BookingAlat();
        $book->name = $request->name;
        $book->email = $request->email;
        $book->instrument_name = $request->instrument_name;
        $book->instrument_price = $request->instrument_price;
        $book->date = $request->date;
        $book->duration = $request->duration;
        $book->instrument_id = $request->instrument_id;
        $book->user_id = $request->user_id;
        $book->total = $request->total;
        $book->save();

        $book->notify(new BookingAlatNotification($book));
           $response = [
                'message'=>'Booking Succesfully',
                'booking' => $book,
                'payment'=>'Silahkan cek email anda untuk detail pembayaran'
                
                
            
            ];
            
            
            return response($response); 
    }

 // melihat list booking user tertentu
 public function MyBookingInstrument($user_id){
        
    // return Booking::find($id);
    $mybooking = BookingAlat::where('user_id', 'like', '%'.$user_id.'%')->get();
    $count = BookingAlat::where('user_id', 'like', '%'.$user_id.'%')->get()->count();
    $response = [
        
        'message'=>'Fetch All Data',
        'Total' => $count,
        'booking' => $mybooking,

    ];
    return response($response);

}
   
// membatalkan booking
public function cancelBookingInstrument(Request $request,$id)
{
    $booking = BookingAlat::find($id);
    $booking->status_booking = $request->status_booking='Canceled';
    $booking->save();

    $response = [
        'message'=>'Booking Has been Canceled',
        'booking' => $booking,
        
        
    ];

     return response($response); 
}

// menyetujui booking
public function AcceptBookingInstrument(Request $request,$id)
{
    $booking = BookingAlat::find($id);
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
    public function deleteBookingInstrument($id)
    {
        $booking = BookingAlat::destroy($id);
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
    public function allBookingInstrument()
    {
       
      
            $booking = BookingAlat::all();
            $count = BookingAlat::all()->count();
            $response = [
                'message'=>'Fetch All Booking Instrument List',
                'Total' => $count,
                'List booking' => $booking
               
      
            ];
            return response($response);
       
    }
    
}
