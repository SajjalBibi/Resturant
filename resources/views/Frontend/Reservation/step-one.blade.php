<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Live Dinner Restaurant</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('backend/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('backend/images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">    
	<!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">    
	<!-- Pickadate CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/classic.css')}}">    
	<link rel="stylesheet" href="{{asset('backend/css/classic.date.css')}}">    
	<link rel="stylesheet" href="{{asset('backend/css/classic.time.css')}}">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/custom.css')}}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<!-- Start header -->
    @include('Admin.partials.header')
	<!-- End header -->
	
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
	
	<!-- Start Reservation -->
	<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Reservation</h2>
						<p>Make your Reservation and pay with stripe method </p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="contact-block">
                    <form action="{{Route('reservation.store.step.one')}}" method="POST" enctype="multipart/form-data">
                     @csrf							
                            <div class="row">
								<div class="col-md-6">
									<div class="col-md-12">
                                    <div class="form-group">
                                    <strong>FirstName:</strong>
                                    <input type="text" name="firstname" value="{{$reservation->firstname ?? ''}}" class="form-control" placeholder="Name">
                                    @error('firstname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>                                
								</div>
									<div class="col-md-12">
                                    <div class="form-group">
                                         <strong>LastName:</strong>
                                         <input type="text" name="lastname" value="{{$reservation->lastname ?? ''}}" class="form-control" placeholder="Name">
                                         @error('lastname')
                                         <span class="text-danger">{{$message}}</span>
                                         @enderror
                                     </div>                               
									</div>
									<div class="col-md-12">
                                     <div class="form-group">
                                      <strong>Email:</strong>
                                      <input type="text" name="email" value="{{$reservation->email ?? ''}}" class="form-control" placeholder="Name">
                                      @error('email')
                                      <span class="text-danger">{{$message}}</span>
                                      @enderror
                                  </div>									
                                </div>
								</div>
								  <div class="col-md-6">
									<div class="col-md-12">
                                    <div class="form-group">
                                  <strong>Tel_Number:</strong>
                                  <input type="number" name="tel_number" value="{{$reservation->tel_number ?? ''}}" class="form-control" placeholder="Name">
                                  @error('tel_number')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                              </div>									</div>
									<div class="col-md-12">
                                    <div class="form-group">
                               <strong>Reservation Date and Time:</strong>
                               <input type="datetime-local" name="reservation_date"
                                   min="{{ $min_date->format('Y-m-d\TH:i') }}" 
                                   max="{{ $max_date->format('Y-m-d\TH:i') }}" 
                                   value="{{ $reservation ? \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d\TH:i') : '' }}"
                                   class="form-control" id="reservationDateTime">
                               @error('reservation_date')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                               <span class="text-danger" id="timeValidationError" style="display:none;">
                                     Reservations are only available between 5 PM and 12 AM.
                                 </span>
                             </div>
                         </div>		
                         <div class="col-md-12">
                                    <div class="form-group">
                                 <strong>Guest_Number:</strong>
                                 <input type="number" name="guest_number" value="{{$reservation->guest_number ?? ''}}" class="form-control" placeholder="Name">
                                 @error('guest_number')
                                 <span class="text-danger">{{$message}}</span>
                                 @enderror
                             </div>									
                         </div>
						
                        	</div>
								
    </div>
                                <div class="col-md-12">
									<div class="submit-button text-center">
										<button class="btn btn-danger" id="submit" type="submit">Next</button>
									</div>
								</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Reservation -->
	
	
	<!-- Start Contact info -->
	<div class="contact-imfo-box">
		<div class="container">
			<div class="row">
				<div class="col-md-4 arrow-right">
					<i class="fa fa-volume-control-phone"></i>
					<div class="overflow-hidden">
						<h4>Phone</h4>
						<p class="lead">
							+01 123-456-4590
						</p>
					</div>
				</div>
				<div class="col-md-4 arrow-right">
					<i class="fa fa-envelope"></i>
					<div class="overflow-hidden">
						<h4>Email</h4>
						<p class="lead">
							yourmail@gmail.com
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-map-marker"></i>
					<div class="overflow-hidden">
						<h4>Location</h4>
						<p class="lead">
							800, Lorem Street, US
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact info -->
	
	<!-- Start Footer -->
	<footer class="footer-area bg-f">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3>About Us</h3>
					<p>Integer cursus scelerisque ipsum id efficitur. Donec a dui fringilla, gravida lorem ac, semper magna. Aenean rhoncus ac lectus a interdum. Vivamus semper posuere dui.</p>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Subscribe</h3>
					<div class="subscribe_form">
						<form class="subscribe_form">
							<input name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address..." type="email">
							<button type="submit" class="submit">SUBSCRIBE</button>
							<div class="clearfix"></div>
						</form>
					</div>
					<ul class="list-inline f-social">
						<li class="list-inline-item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Contact information</h3>
					<p class="lead">Ipsum Street, Lorem Tower, MO, Columbia, 508000</p>
					<p class="lead"><a href="#">+01 2000 800 9999</a></p>
					<p><a href="#"> info@admin.com</a></p>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Opening hours</h3>
					<p><span class="text-color">Monday: </span>Closed</p>
					<p><span class="text-color">Tue-Wed :</span> 9:Am - 10PM</p>
					<p><span class="text-color">Thu-Fri :</span> 9:Am - 10PM</p>
					<p><span class="text-color">Sat-Sun :</span> 5:PM - 10PM</p>
				</div>
			</div>
		</div>
		
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p class="company-name">All Rights Reserved. &copy; 2018 <a href="#">Live Dinner Restaurant</a> Design By : 
					<a href="https://html.design/">html design</a></p>
					</div>
				</div>
			</div>
		</div>
		
	</footer>
	<!-- End Footer -->
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>

	<!-- ALL JS FILES -->
	<script src="{{asset('backend/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('backend/js/popper.min.js')}}"></script>
	<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
	<script src="{{asset('backend/js/jquery.superslides.min.js')}}"></script>
	<script src="{{asset('backend/js/images-loded.min.js')}}"></script>
	<script src="{{asset('backend/js/isotope.min.js')}}"></script>
	<script src="{{asset('backend/js/baguetteBox.min.js')}}"></script>
	<script src="{{asset('backend/js/picker.js')}}"></script>
	<script src="{{asset('backend/js/picker.date.js')}}"></script>
	<script src="{{asset('backend/js/picker.time.js')}}"></script>
	<script src="{{asset('backend/js/legacy.js')}}"></script>
	<script src="{{asset('backend/js/form-validator.min.js')}}"></script>
    <script src="{{asset('backend/js/contact-form-script.js')}}"></script>
    <script src="{{asset('backend/js/custom.js')}}"></script>

    <!-- for datetime -->
    <script>
    document.getElementById('reservationDateTime').addEventListener('change', function() {
        const chosenTime = new Date(this.value).getHours();
        const withinTimeRange = chosenTime >= 17 || chosenTime === 0;

        const timeValidationError = document.getElementById('timeValidationError');
        if (!withinTimeRange) {
            timeValidationError.style.display = 'block';
        } else {
            timeValidationError.style.display = 'none';
        }
    });
</script>
</body>
</html>