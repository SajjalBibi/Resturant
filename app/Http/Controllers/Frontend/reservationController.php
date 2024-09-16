<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationStoreRequest;
use App\Enums\TableStatus;
use App\Models\Table;
use App\Http\Controllers\Frontend\Session;
use App\Mail\ReservationConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendReservationReminder;
use Illuminate\Database\Eloquent\ModelNotFoundException; // Don't forget to include this
use Illuminate\Support\Facades\Log;

class reservationController extends Controller
{
    //
  

    
    public function stepone(Request $request)
{
    $reservation = $request->session()->get('reservation');
    $min_date = Carbon::today();

    // Set the maximum date to 2 days from now
    $max_date = Carbon::now()->addDays(2);

    // Get the current time
    $current_time = Carbon::now();

     // Set the minimum time (5 PM)
    $min_time = Carbon::createFromTime(17, 0, 0);

    // Set the maximum time (12 AM next day)
    $max_time = Carbon::createFromTime(0, 0, 0)->addDay();

    // Check if the current time is within the allowed time range
    $within_time_range = $current_time->between($min_time, $max_time);

    return view('Frontend.Reservation.step-one', compact('reservation', 'min_date', 'max_date', 'within_time_range'));
}


    public function storestepone(Request $request)
    {
        // Validate the reservation form data
        $validated = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required'],
            'tel_number' => ['required'],
            'reservation_date' => ['required', 'date'],
            'guest_number' => ['required', 'integer', 'min:1'],
        ]);
    
        // Create a new instance of the Reservation model
        $reservation = new Reservation();
    
        // Fill the model attributes with the validated data
        $reservation->fill($validated);
    
        // Save the reservation data to the session
        $request->session()->put('reservation', $reservation);
    
        return redirect('/reservation/step-two');
    }

    public function steptwo(Request $request)
    {
        //
        $reservation = $request->session()->get('reservation');
        $reservationDate = Carbon::parse($reservation->reservation_date);
        $res_table_ids = Reservation::orderBy('reservation_date')->get()->filter(function ($value) use ($reservationDate) {
            // Convert the reservation_date string to a DateTime object
            $valueDate = Carbon::parse($value->reservation_date);
            return $valueDate->format('Y-m-d') == $reservationDate->format('Y-m-d');
        })->pluck('table_id');
    
       $table = Table::where('status', '=', TableStatus::Avaliable)
       ->where('guest_number', '>=', $reservation->guest_number)
       ->whereNotIn('id', $res_table_ids)
       ->get();
         
        return view('Frontend.Reservation.step-two',compact('reservation','table'));

    }
    public function storesteptwo(Request $request)
    {
        $validated = $request->validate([
            'table_id' => ['required']
        ]);
    
        // Retrieve the reservation data from the session
        $reservation = $request->session()->get('reservation');
    
        // Update the reservation with validated data
        $reservation->fill($validated);
        $reservation->save();
    
        try {
            // Fetch reservation from the database using reservation ID
            $reservationInstance = Reservation::findOrFail($reservation->id);
    
            // Calculate the reminder time (1 hour before reservation)
            $remindTime = Carbon::parse($reservationInstance->reservation_date)->subHour(1);
    
            // Dispatch the job to send the reminder email with a delay
            SendReservationReminder::dispatch($reservationInstance)->delay($remindTime);
    
            Log::info('Reminder email job dispatched for reservation: ' . $reservationInstance->id);
        } 
        catch (ModelNotFoundException $e) {
            Log::error('Error fetching reservation: ' . $e->getMessage());
            // Handle the exception, e.g., log an error or show a user-friendly message
        }
    
        // Send the confirmation email
        Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));
    
        // Clear the session reservation data
        $request->session()->forget('reservation');
    
        Log::info('Reservation confirmation email sent for reservation: ' . $reservation->id);
    
        return redirect()->with('reservation', $reservation);
    }
    
    public function thankYou()
{
    // Retrieve the reservation data from the session
    $reservation = session('reservation');

    // Return the "Thank You" view and pass the reservation data
    return view('Frontend.Reservation.thank-you', compact('reservation'));
}

    
        
    public function index()
    {
        // Retrieve all reservations from the database
        $reservations = Reservation::all();

        // Pass the reservations to the view and display them
        return view('Frontend.Reservation.index', compact('reservations'));
    }


    public function show($id)
    {
        // Retrieve the reservation by its ID from the database
        $reservation = Reservation::findOrFail($id);
    
        // Check if the reservation exists
        if (!$reservation) {
            // Handle the case when the reservation does not exist (e.g., show an error message or redirect)
            // For example:
            return redirect('/reservation/step-one')->with('error', 'Reservation not found.');
        }
    
        // Calculate the cancellation time (one day after creation)
        $cancellationTime = strtotime($reservation->created_at) + (24 * 60 * 60);
    
        // Pass the calculated cancellation time to the view
        return view('Frontend.Reservation.show', compact('reservation', 'cancellationTime'));
    }

public function cancel(Request $request, $id)
{
    // Find the reservation by ID
    $reservation = Reservation::findOrFail($id);

    // Calculate the time one day after the reservation was created
    $oneDayAfterCreation = strtotime($reservation->created_at) + (24 * 60 * 60);

    // Check if the current time is after the one-day window from creation
    if (time() > $oneDayAfterCreation) {
        return redirect()->back()->with('error', 'Cannot cancel the reservation as one day has passed since its creation.');
    }

    // Check if the reservation is already canceled
    if ($reservation->status === 'canceled') {
        return redirect()->back()->with('error', 'Reservation is already canceled.');
    }

    // Update the reservation status to 'canceled'
    $reservation->status = 'canceled';
    $reservation->save();

    // Add any additional cancellation logic here, e.g., notifying the user or releasing resources

    return redirect()->back()->with('success', 'Reservation canceled successfully.');
}



}
