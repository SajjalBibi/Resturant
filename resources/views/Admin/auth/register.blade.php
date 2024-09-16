<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    @include('Admin.partials.style')
</head>
@if($errors->any())
    @foreach ($errors->all() as $error)
    <p style ="color: red" >{{$error}}</p>
    @endforeach
@endif
<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h1 class="text-center mb-4">Sign up your account</h1>
                                    <form action="{{route('register.post')}}" method="post">
                                       @csrf
                                        <div class="form-group">
                                            <label><strong>username</strong></label>
                                            <input type="text" class="form-control"name="name" placeholder="username">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" value="Password">
                                        </div>


                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-danger btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="/">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@if(Session::has('success'))
<p style="color:green">{{session::get('success')}}</p>
@endif
    @include('Admin.partials.script')
</body>

</html>