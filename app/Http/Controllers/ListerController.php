<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\ListerApprovalEmail;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\Complete;
use App\Models\Application;
use App\Models\Gallery;

use Illuminate\Support\Facades\Auth;    

class ListerController extends Controller
{
    public function home()
    {
        $data = Listing::all();
        $gallery = Gallery::all();
        return view('home.index', compact('data', 'gallery'));
        
    }
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
    
        $usertype = Auth::user()->usertype;
    
        if ($usertype === 'user') {
            $data = Booking::all();
            return view('Dashboard.general', compact('data'));
        }
    
        if ($usertype === 'lister') {
            // All bookings for reference (not used directly below?)
            $data = Booking::where('lister_id', Auth::id())->get();
    
            // ✅ Monthly Sales (from completes table)
            $monthlySales = DB::table('completes')
                ->where('lister_id', Auth::id())
                ->selectRaw("MONTH(created_at) as month, SUM(payable_amount) as total")
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->pluck('total', 'month')
                ->toArray();

            $weeklySales = DB::table('completes')
                ->where('lister_id', Auth::id())
                ->selectRaw("MONTH(created_at) as month, SUM(payable_amount) as total")
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->pluck('total', 'month')
                ->toArray();
    
            $salesData = [];
            for ($i = 1; $i <= 12; $i++) {
                $salesData[] = $monthlySales[$i] ?? 0;
            }
    
            // ✅ Bookings per Property (from completes table)
            $bookingsPerProperty = DB::table('completes')
                ->join('listings', 'completes.property_id', '=', 'listings.id')
                ->where('completes.status', 'completed')
                ->where('completes.lister_id', Auth::id())
                ->select('listings.title', DB::raw('COUNT(*) as total_bookings'))
                ->groupBy('listings.title')
                ->pluck('total_bookings', 'listings.title');
    
            return view('Dashboard.lister', compact('data', 'salesData', 'weeklySales', 'bookingsPerProperty'));
        }
    
        if ($usertype === 'admin') {
            $user = User::all();
            $application = Application::all();
            $application = DB::table('applications')
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->select('applications.*', 'users.usertype')
            ->get();

            $monthlyCommission = DB::table('completes')
                ->selectRaw("MONTH(created_at) as month, SUM(commission_amount) as total")
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->pluck('total', 'month')
                ->toArray();

            // Always complete 12 months
            $salesData = [];
            for ($i = 1; $i <= 12; $i++) {
                $salesData[] = $monthlyCommission[$i] ?? 0;
            }
            
            return view('Dashboard.admin', compact('user', 'application', 'salesData'));
        }
    }
    

    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth::user()->usertype;
            if($usertype == 'user')
            {
                $data = Listing::all();
                $gallery = Gallery::all();
                return view('home.index', compact('data', 'gallery'));
            }
            if($usertype == 'admin' || $usertype == 'lister')
            {
                $data = Listing::all();
                $gallery = Gallery::all();
                
                return view('home.index', compact('data', 'gallery'));
            }
        }

    }

    public function create()
    {
        return view('lister.create');
    }
    public function create_listing()
    {
        return view('Dashboard.create_listing');
    }
    public function add_listing(Request $request)
    {
    $listing = new Listing;
    $listing->user_id = Auth::id();
    $listing->title = $request->input('title');

    if ($request->property_type === 'Other') {
        $propertyType = $request->input('other_property_type');
    } else {
        $propertyType = $request->input('property_type');
    }

    $listing->property_type = $propertyType;
    $listing->address = $request->input('address');
    $listing->guest_max = $request->input('guest_max');
    $listing->bathroom_count = $request->input('bathroom_count');
    $listing->description = $request->input('description');
    $listing->map_link = $request->input('map_link');

    $roomTotal = 0;
    $rooms = [];
    
    if ($request->has('rooms')) {
        foreach ($request->input('rooms') as $index => $room) {
            $image = $request->file("rooms.$index.image");
            $imageName = null;
    
            if ($image) {
                $imageName = time() . "_room_$index." . $image->getClientOriginalExtension();
                $image->move(public_path('listing'), $imageName);
            }
    
            $subtotal = $room['quantity'] * $room['price'];
            $roomTotal += $subtotal;
    
            $rooms[] = [
                'type' => $room['type'],
                'quantity' => $room['quantity'],
                'price' => $room['price'],
                'image' => $imageName,
            ];
        }
    }
    
    $additionals = [];
    if ($request->has('additionals')) {
        foreach ($request->input('additionals') as $index => $add) {
            $addImage = $request->file("additionals.$index.image");
            $addImageName = null;

            if ($addImage) {
                $addImageName = time() . "_add_$index." . $addImage->getClientOriginalExtension();
                $addImage->move(public_path('listing'), $addImageName);
            }

           $additionals[] = [
            'type'  => $add['type'] ?? 'Amenity',
            'item'  => $add['item'] ?? '',
            'price' => $add['price'] ?? 0,
            'image' => $addImageName ?? null,
        ];
        }
    }

    // Store JSON data (adjust field types in DB as needed)
    $listing->rooms = json_encode($rooms);
    $listing->room_total_price = $roomTotal;
    $listing->additionals = json_encode($additionals);

    // Main property image (if any)
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_main.' . $image->getClientOriginalExtension();
        $image->move(public_path('listing'), $imageName);
        $listing->image = $imageName;
    }
    $listing->commission_amount = $request->input('commission_input');
    $listing->payable_amount = $request->input('payable_input');



    $listing->save();

    return redirect()->back()->with('success', 'Property added successfully');
}


    public function view_listing()
{
    $data = Listing::all();  // $data is a collection (list of listings)
    $user_id = Auth::id();    // Current logged user

    return view('Dashboard.view_listing', compact('data', 'user_id'));
}
    public function listing_delete($id)
    {
        $data = Listing::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Listing deleted successfully');
    }

    public function delete_booking($id)
    {
        $data = Booking::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully');
    }

    public function cancel_booking($id)
    {
        $data = Booking::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Booking Cancelled successfully');
    }
    public function listing_update($id)
    {
        $listing = Listing::findOrFail($id);
        $rooms = json_decode($listing->rooms, true);
        $additionals = json_decode($listing->additionals, true);
        return view('Dashboard.listing_update', compact('listing', 'rooms', 'additionals'));
    }
 public function listing_update_confirm(Request $request, $id)
{
    $listing = Listing::findOrFail($id);

    // Update simple fields
    $listing->title = $request->input('title');
    $listing->address = $request->input('address');
    $listing->guest_max = $request->input('guest_max');
    $listing->bathroom_count = $request->input('bathroom_count');
    $listing->description = $request->input('description');
    $listing->map_link = $request->input('map_link');

    // Handle Property Type
    if ($request->input('property_type') == 'Other') {
        $listing->property_type = $request->input('other_property_type');
    } else {
        $listing->property_type = $request->input('property_type');
    }

    // Handle Rooms
    $rooms = [];

    // Get existing rooms that user kept
    if ($request->has('existing_rooms')) {
        foreach ($request->input('existing_rooms') as $encoded) {
            $rooms[] = json_decode(base64_decode($encoded), true);
        }
    }

    // Add new rooms
    if ($request->has('rooms')) {
        foreach ($request->input('rooms') as $key => $room) {
            $roomImage = null;
            if ($request->hasFile("rooms.$key.image")) {
                $roomImageFile = $request->file("rooms.$key.image");
                $roomImage = time() . "_room_$key." . $roomImageFile->getClientOriginalExtension();
                $roomImageFile->move(public_path('listing'), $roomImage);
            }

            $rooms[] = [
                'type' => $room['type'],
                'quantity' => $room['quantity'],
                'price' => $room['price'],
                'image' => $roomImage ?? '',
            ];
        }
    }
    $listing->rooms = json_encode($rooms);

    // Handle Additionals
    $additionals = [];

    // Get existing additionals that user kept
    if ($request->has('existing_additionals')) {
        foreach ($request->input('existing_additionals') as $encoded) {
            $additionals[] = json_decode(base64_decode($encoded), true);
        }
    }

    // Add new additionals
    if ($request->has('additionals')) {
        foreach ($request->input('additionals') as $index => $add) {
            $addImage = $request->file("additionals.$index.image");
            $addImageName = null;

            if ($addImage) {
                $addImageName = time() . "_add_$index." . $addImage->getClientOriginalExtension();
                $addImage->move(public_path('listing'), $addImageName);
            }

          $additionals[] = [
            'type' => $add['type'] ?? 'Amenity',
            'item' => $add['item'] ?? '',
            'price' => $add['price'] ?? 0,
            'image' => $addImageName ?? '',
        ];
        }
    }
    $listing->additionals = json_encode($additionals);
    $listing->room_total_price = $request->input('room_total_price');

    // Update main listing image (optional)
    if ($request->hasFile('image')) {
        // Optional: delete old image
        if ($listing->image && File::exists(public_path('listing/' . $listing->image))) {
            File::delete(public_path('listing/' . $listing->image));
        }

        $image = $request->file('image');
        $imageName = time() . '_main.' . $image->getClientOriginalExtension();
        $image->move(public_path('listing'), $imageName);
        $listing->image = $imageName;
    }

    $commission = $request->input('commission_input');
    $payableAmount = $request->input('payable_input');
    $listing->commission_amount = $commission;
    $listing->payable_amount = $payableAmount;

    $listing->save();

    return redirect()->back()->with('success', 'Property updated successfully!');
}

    public function messages()
    {   
        $data = Booking::all();
        $user_id = Auth::id();
        return view('Dashboard.messages', compact('data', 'user_id'));
    }
    public function checkin($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->stay_status = 'checked_in';
        $booking->save();
    
        return redirect()->back()->with('success', 'Arrived.');
    }
    public function checkout($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->stay_status = 'completed';
        $booking->save();
    
        return redirect()->back()->with('success', 'Checkout.');
    }
    public function complete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->stay_status = 'completed';
        $booking->save();
    
        return redirect()->back()->with('success', 'Complete.');
    }
    public function save_complete($id) 
    {
        $booking = Booking::findOrFail($id);
        $data = new Complete;
        $data->id = $booking->id;
        $data->user_id = $booking->user_id;
        $data->lister_id = $booking->lister_id;
        $data->property_id = $booking->property_id;
        $data->name = $booking->name;
        $data->phone = $booking->phone;
        $data->email = $booking->email;
        $data->start_date = $booking->start_date;
        $data->end_date = $booking->end_date;
        $data->price = $booking->price;
        $data->commission_amount = $booking->commission_amount;
        $data->payable_amount = $booking->payable_amount; 
        $data->payment_status = $booking->payment_status;
        $data->status = $booking->stay_status;
    
        $data->save();
        $booking->delete();   
        return redirect()->back()->with('success', 'Booking successfully submitted!');
    }
    public function view_complete()
    {
        $completedBookings = DB::table('bookings')
        ->where('status', 'completed')
        ->orderBy('created_at', 'desc') // Sort by newest first
        ->get();
        $data = Complete::all();
        return view('Dashboard.complete', compact('data'));
    }

    public function apply()
    {
        $data = User::all();
        return view('Dashboard.apply', compact('data'));
    }
    public function apply_confirm(Request $request)
    {
        $application = new Application;
        $application->user_id = Auth::id();
        $application->fullname = $request->input('fullname');
        $application->age = $request->input('age');
        $application->gender = $request->input('gender');
        $application->email = $request->input('email');
        $application->phone = $request->input('phone');
        $application->current_address = $request->input('current_address');
        $application->permanent_address = $request->input('permanent_address');
        $application->status = 'pending';

        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ID'), $imageName);
            $application->image = $imageName;
        }
        $application->save();
        return redirect()->back()->with('success', 'Application submitted successfully');
    }

    public function application_update()
    {
        $data = Application::all();
        return view('Dashboard.application_update', compact('data'));
    }

    public function approve_application($id)
    {
        $user = User::findOrFail($id);  // ✅ Corrected here
        $user->usertype = 'lister';
        $user->save();

        Mail::to($user->email)->send(new ListerApprovalEmail($user));  // ✅ This is correct

        return redirect()->back()->with('success', 'User approved and email notification sent!'); 
    }

    public function make_lister($id)
    {
        $user = User::findOrFail($id);
        $user->usertype = 'lister';
        $user->save();

        return redirect()->back()->with('success', 'privilege approved.');
    }
    public function make_user($id)
    {
        $user = User::findOrFail($id);
        $user->usertype = 'user';
        $user->save();
    
        return redirect()->back()->with('success', 'privilege approved.');
    }
    public function make_admin($id)
    {
        $user = User::findOrFail($id);
        $user->usertype = 'admin';
        $user->save();
    
        return redirect()->back()->with('success', 'privilege approved.');
    }
    public function user()
    {
        $user = User::all();
        return view('Dashboard.user', compact('user'));
    }
    public function gallery_view()
{
    $data = Listing::all();
    $gallery = Gallery::all();
    return view('Dashboard.gallery_view', compact('data', 'gallery'));
}
public function add_image(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'property_id' => 'required|exists:listings,id'
    ]);

    $listing = Listing::findOrFail($request->property_id);

    $gallery = new Gallery;
    $gallery->property_id = $listing->id;

    $image = $request->file('image');
    if ($image) {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Gallery'), $imageName);
        $gallery->image = $imageName;
    }

    $gallery->save();

    return redirect()->back()->with('success', 'Image added successfully!');
}
public function image_delete($id)
{
    $data = Gallery::findOrFail($id);
    $data->delete();
    return redirect()->back()->with('success', 'Image deleted successfully');
}

}
