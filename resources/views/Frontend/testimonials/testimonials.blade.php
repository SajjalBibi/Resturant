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
    
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Review Us</h4>
                                    @if(Session::has('success'))
                                    <p class="text-success">{{Session::get('success')}}</a>
                                    @endif
                                
                                    <form action="{{url('customer/save-testimonials')}}" method="post">
                                    @csrf

                                    
                                    <div class="form-group">
                                        <strong><label class="text-danger">Testimonials</label></strong>
                                        <textarea name="customer_content" class="form-control" cols="88" rows="12"></textarea>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger btn-block">Submit</button>
                                    </div>
                                    </form>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    



    <!--************
        Scripts
    *************-->
    <!-- Required vendors -->
  @include('Admin.partials.script')

</body>

</html>