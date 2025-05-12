<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Message;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;    

class Home extends Controller
{
    public function add_booking(Request $request, $id)
{
    $overlap = Booking::where('property_id', $id)
        ->whereIn('status', ['pending', 'approved'])
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('start_date', '<=', $request->start_date)
                        ->where('end_date', '>=', $request->end_date);
                  });
        })->exists();

    if ($overlap) {
        $nextBooking = Booking::where('property_id', $id)
            ->where('status', 'pending')
            ->where('end_date', '>=', $request->end_date)
            ->orderBy('end_date', 'asc')
            ->first();

        if ($nextBooking && !empty($nextBooking->end_date)) {
            $suggestedStart = date('Y-m-d', strtotime($nextBooking->end_date . ' +1 day'));
        } else {
            $suggestedStart = date('Y-m-d');
        }

        return back()->with([
            'error' => 'This property is already booked for the selected dates.',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'suggested_start' => $suggestedStart
        ]);
    }
    
    $data = new Booking;
    $data->user_id = Auth::id();
    $data->lister_id = $request->lister_id;
    $data->property_id = $id;
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->start_date = $request->start_date;
    $data->end_date = $request->end_date;
    $data->number_of_guests = $request->number_of_guests;
    $data->price = $request->price;
    $commissionAmount = $request->input('commission_input');
    $payableAmount = $request->input('payable_input');
    $data->commission_amount = $commissionAmount;
    $data->payable_amount = $payableAmount;
    $data->payment_method = $request->payment_method;
    $data->stay_status = 'pending';
    $data->message = $request->message;
    $data->save();

    return redirect()->back()->with('success', 'Booking successfully submitted!');
}

public function message(Request $request, $id)
{
    $data = new Message;
    $user = Auth::User();
    $data->user_id = Auth::id();
    $data->property_id = $id;
    $data->name = $user->name;
    $data->email = $user->email;
    $data->phone = $user->phone;
    $data->message = $request->message;

    $data->save();

    return redirect()->back()->with('success', 'Message successfully submitted!');
}
    
    public function view_bookings()
    {
        $data = Booking::all();
        return view('Dashboard.view_bookings', compact('data'));
    }

    public function booking_delete($id)
    {
        $data = Booking::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Booking Deleted.');
    }
    
    public function approve_booking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();
    
        return redirect()->back()->with('success', 'Booking approved.');
    }
    public function reject_booking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();
    
        return redirect()->back()->with('success', 'Booking rejected.');
    }
    public function property_details($id)
    {
        $data = Listing::findOrFail($id);
        $gallery = Gallery::where('property_id', $id)->get();

        $rooms = json_decode($data->rooms, true) ?? [];
        $additionals = json_decode($data->additionals, true) ?? [];

        return view('home.property_details', compact('data', 'gallery', 'rooms', 'additionals'));
    }
    public function payment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->payment_status = 'paid';
        $booking->save();
    
        return redirect()->back()->with('success', 'payment approved.');
    }
    public function display()
    {
        $data = Listing::all();
        return view('home.display', compact('data'));
    }
    public function beach()
    {
        $data = Listing::all();
        return view('home.display-beach', compact('data'));
    }
    public function pool()
    {
        $data = Listing::all();
        return view('home.display-pool', compact('data'));
    }
    public function camp()
    {
        $data = Listing::all();
        return view('home.display-camping', compact('data'));
    }
    public function private()
    {
        $data = Listing::all();
        return view('home.display-privillas', compact('data'));
    }
    public function nature()
    {
        $data = Listing::all();
        return view('home.display-nature', compact('data'));
    }
    public function lake()
    {
        $data = Listing::all();
        return view('home.display-lakeside', compact('data'));
    }

    public function about()
    {
        return view('home.about');
    }
}
