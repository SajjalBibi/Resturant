<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

      @include('dashboard.style')
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            @include('dashboard.nav')
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               @include('dashboard.topbar')
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                           @include('dashboard.flashmessage')                           
                        </div>
                        </div>
                     </div>
                     <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-user yellow_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no">2500</p>
                                    <p class="head_couter">Welcome</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-clock-o blue1_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no">123.50</p>
                                    <p class="head_couter">Average Time</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-cloud-download green_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no">1,805</p>
                                    <p class="head_couter">Collections</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-comments-o red_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no">54</p>
                                    <p class="head_couter">Comments</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                    
     <!-- table -->
     <a href="{{action('App\Http\Controllers\Admin\ReservationController@create')}}" class="btn btn-danger">Make Reservation</a>
<br>
     <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Email</th>
      <th scope="col">Tel_Number</th>
      <th scope="col">Reservation_Date</th>
      <th scope="col">Table_Name</th>
      <th scope="col">Gest_Number</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($reser as $resers)
    <tr>
      <td>{{$resers->firstname}}</td>
      <td>{{$resers->lastname}}</td>
      <td>{{$resers->email}}</td>
      <td>{{$resers->tel_number}}</td>
      <td>{{$resers->reservation_date}}</td>
      <td> @if ($resers->table)
                                             {{ $resers->table->name }}
                                         @else
                                             Table Not Found
                                         @endif</td>
                                         <td> @if ($resers->table)
                                             {{ $resers->table->guest_number }}
                                         @else
                                             Table Not Found
                                         @endif</td>
      <td>            
          <form action="{{action('App\Http\Controllers\Admin\ReservationController@destroy',$resers->id)}}" method="POST"
                   onsubmit="return confirm('Are you sure')">
          @csrf
                  @method('DELETE')
                  <a href="{{action('App\Http\Controllers\Admin\ReservationController@edit',$resers->id)}}" class="btn btn-warning">Edit</a>

                  <input type="submit" value="Delete" class="btn btn-danger">
                </form>
         </td>
   
      
    </tr>
   @endforeach
  </tbody>
</table>
                  </div>
                  <!-- footer -->
                  <div class="container-fluid">
                     <div class="footer">
                     <p>Copyright © 2024 Designed by syeda sajjal bibi.<br><br>
                           Distributed By: <a href="">Sajjal Bibi</a>
                        </p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      @include('dashboard.script')
   </body>
</html>