


<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Live Dinner Restaurant - Responsive HTML5 Template</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    @include('Admin.partials.style')
</head>

<body>
	
@include('Admin.partials.header')
	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Reservation</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Reservation Details</div>
                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <p><strong>Reservation ID:</strong> {{ $reservation->id }}</p>
                    <p><strong>Name:</strong> {{ $reservation->firstname }} {{ $reservation->lastname }}</p>
                    <p><strong>Email:</strong> {{ $reservation->email }}</p>
                    <p><strong>Tel_Number:</strong> {{ $reservation->tel_number }}</p>
                    <p><strong>Reservation Date</strong> {{ $reservation->reservation_date }}</p>
                    <p><strong>Table ID:</strong> {{ $reservation->table_id}}</p>
                    <p><strong>Guest Number:</strong> {{ $reservation->guest_number}}</p>
                    <!-- Other reservation details... -->
                    <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>

                    @if ($reservation->status === 'active')
                    @php
                        $cancellationTime = strtotime($reservation->created_at) + (24 * 60 * 60); // One day after reservation creation
                        $currentTime = time();
                    @endphp

                    @if ($currentTime <= $cancellationTime)
                    <p>You cannot cancel this reservation as more than one day: <span id="countdown"></span></p>
                    <form id="reservation-cancel-form" action="{{ route('reservations.cancel', ['id' => $reservation->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" id="cancelReservation">Cancel Reservation</button>
                    </form>

                    <script>
                        // const cancellationTime = {{ $cancellationTime }} * 1000; // Convert to milliseconds
                        const cancellationTime = {{$cancellationTime}} * 1000 ;
                        const countdownInterval = 1000; // Update countdown every second

                        function formatTime(number) {
                            return number < 10 ? `0${number}` : number;
                        }

                        function updateCountdown(targetTime, element) {
                            const currentTime = Date.now();
                            const timeDifference = targetTime - currentTime;

                            if (timeDifference <= 0) {
                                clearInterval(countdownInterval);
                                element.textContent = 'Expired';
                            } else {
                                const hours = Math.floor(timeDifference / (60 * 60 * 1000));
                                const minutes = Math.floor((timeDifference % (60 * 60 * 1000)) / (60 * 1000));
                                const seconds = Math.floor((timeDifference % (60 * 1000)) / 1000);
                                element.textContent = `${formatTime(hours)}h ${formatTime(minutes)}m ${formatTime(seconds)}s`;
                            }
                        }

                        function startCountdown(targetTime, element) {
                            updateCountdown(targetTime, element);
                            setInterval(() => {
                                updateCountdown(targetTime, element);
                            }, countdownInterval);
                        }

                        startCountdown(cancellationTime, document.getElementById('countdown'));
                    </script>
                    @else
                    <p>You cannot cancel this reservation as more than one day has passed since its creation.</p>
                    @endif

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



	@include('Admin.partials.footer')
    @include('Admin.partials.script')
</body>
</html>