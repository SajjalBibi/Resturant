<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    @include('Admin.partials.style')
</head>

<body class="h-100">
    
@include('Admin.partials.header')
	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Reviews</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->
<!-- Start Customer Reviews -->
<div class="customer-reviews-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-title text-center">
                    <h2>Customer Reviews</h2>
                    <p>Describe Your Experience</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto text-center">
            @foreach ($testimonial as $test)    
                <div id="reviews" class="carousel slide" data-ride="carousel">
               
                    <div class="carousel-inner mt-4">
                        <div class="carousel-item text-center  active">
                            <div class="img-box p-1 border rounded-circle m-auto">
                                <img class="d-block w-100 rounded-circle" src="{{asset('backend/images/quotations-button.png')}}" alt="">
                            </div>
                          <h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">{{$test->user->name}}</strong></h5>
                            <p class="m-0 pt-3">{{$test->customer_content}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
         
        </div>
    </div>
</div>
<!-- End Customer Reviews -->

@include('Admin.partials.footer')



    <!--************
        Scripts
    *************-->
    <!-- Required vendors -->
  @include('Admin.partials.script')

</body>

</html>