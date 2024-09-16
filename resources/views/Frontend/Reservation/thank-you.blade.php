


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


<h2>Thank You for Your Reservation</h2>
    <p>Name: {{ $reservation->firstname }} {{ $reservation->lastname }}</p>
    <p>Email: {{ $reservation->email }}</p>
    <p>Tel_Number: {{ $reservation->tel_number }}</p>
    <p>Reservation Date: {{ $reservation->reservation_date }}</p>
    <p>Table ID: {{ $reservation->table_id }}</p>
    <p>Guest Number: {{ $reservation->guest_number }}</p>
    <p>Price: {{ $reservation->price }}</p>
    <!-- Display other reservation details -->
    <p>Your reservation details have been successfully saved.</p>
    <a href="{{ route('reservations.show', ['id' => $reservation->id]) }}" class="btn btn-info">
        Show Reservation Details
    </a>

	@include('Admin.partials.footer')
    @include('Admin.partials.script')
</body>
</html>