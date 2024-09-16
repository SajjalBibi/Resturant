<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminder;
use Carbon\Carbon;
use App\Jobs;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;


class SendReservationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservation;

    public function __construct($reservation)
{
    $this->reservation = $reservation;
}

    public function handle()
    {
        try {
            $reservation = Reservation::findOrFail($this->reservation->id);
    
            Log::info('Reminder email job started for reservation: ' . $reservation->id);
    
            // Set reminder_sent in database to true
            $reservation->update(['reminder_sent' => true]);
    
            $reservationTime = Carbon::parse($reservation->reservation_date);
            $reminderTime = $reservationTime->subHour(1);
    
            if ($reservationTime->isFuture()) {
                // Your email sending logic here
                // For example, sending the reminder email
                Mail::to($reservation->email)->send(new ReservationReminder($reservation));
    
                Log::info('Reminder email sent for reservation: ' . $reservation->id);
            } else {
                Log::info('Reminder email not sent. Reservation time has passed for reservation: ' . $reservation->id);
            }
    
            Log::info('Reminder email job completed for reservation: ' . $reservation->id);
        } catch (ModelNotFoundException $e) {
            Log::error('Model not found for reservation: ' . $this->reservation->id);
        } catch (\Exception $e) {
            Log::error('An error occurred in SendReservationReminder job: ' . $e->getMessage());
        }
}
}