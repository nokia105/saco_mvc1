     @extends('layouts.member_master')

      @section('title', '| Member')
      @section('member')
            <style type="text/css">
          .no-hover li  b{
           color:#ffff;

          }

          .panel-heading ul li a{
            color:#ffff;
          }

           .panel-heading ul li{
            margin:1%;
           }
        </style>

        <input type="hidden" value="{{$id=Request::segment(2)}}" name=""> 

           @php
           $user=\App\Member::find($id);

        @endphp

     <div class="row">
         <div class="col-md-2">
            
                       <!-- Profile Image -->
          <div class="box box-info">
            <div class="box-body box-profile">
          
              <img class="profile-user-img img-responsive img-circle" src="{{asset('uploads/profileimages/'.$member->member_image.'') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{strtoupper($member->first_name)}} {{strtoupper($member->last_name)}}</h3>

             <!--  <p class="text-muted text-center">Software Engineer</p> -->

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <button type="button" class="btn btn-success">Number Loans <a href="{{url ('member/'.$id.'/loans')}}"><span class="badge"> {{$no_loans}}</span></a></button>
                </li>
                 <li class="list-group-item">
                  <button type="button" class="btn btn-info">Submit Loans <span class="badge">{{$submitted_loans}}</span></button>
                </li>
                <li class="list-group-item">

                  <button type="button" class="btn btn-danger">Rejected Loan <span class="badge">{{$rejected_loans}}</span></button>
                </li>
                <li class="list-group-item">
                  <button type="button" class="btn btn-warning">Pending Loan <span class="badge">{{$pending_loans}}</span></button>
                </li>

              </ul>

             <!--  <a href="#" class="btn btn-info btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
   <div class="col-md-9">
    <nav class="navbar navbar-dark bg-primary" style="padding-top: 0px;">
      <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only white">Toggle navigation</span>
        <span class="icon-bar white"></span>
        <span class="icon-bar white"></span>
        <span class="icon-bar white"></span>
      </button>
      <!-- <a class="navbar-brand white active" href="#">Brand</a> -->
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="white"><a href="{{url ('member/'.$id.'/profile')}}"><b>Profile</b></a></li>
         <li  class="white"><a href="{{url ('member/'.$id.'/savings')}}"><b>Savings</b></a></li>
         <li  class="white"><a href="{{url ('member/'.$id.'/shares')}}"><b>Shares </b></a></li>
         <li  class="white"><a href="{{url ('member/'.$id.'/loans')}}"><b>Loans List</b></a></li>
         <li  class="white"><a href="{{url ('member/'.$id.'/apply_loan')}}"><b>Loan Request</b></a></li>
         <li  class="white"><a href="{{url ('member/'.$id.'/guarantor')}}"><b>Guarantor</b></a></li>
         <li  class="white"><a href="{{url ('member/'.$id.'/collaterals')}}" ><b>Collaterals</b></a></li>
         <li  class="white"><a href="{{url ('member/'.$id.'/payments')}}" ><b>Payments</b></a></li>
        
      </ul>

    </div><!-- /.navbar-collapse -->

</nav>
     
        @yield('memberinfo')
          </div>
                

          </div>
          <!-- /.nav-tabs-custom -->

     

          <!--/.
        </div>
        /.col -->
      </div>
       <style type="text/css">
         .member_navbar span {
             padding:2px;

         }
        .nav-menu-profile{
          margin-top: 0px;
        }
        .white a, .white{
          color:#fff;
        }
        a:hover {
          color:#fff;
        }
        .active {
    background-color: #00c0ef;
    color: white;
  }
    .navbar-dark .navbar-header .navbar-toggle .icon-bar{
        color:black;
        background-color: #fff;

      }
      .navbar-dark .navbar-header .navbar-toggle{
        float:left;
      }
      .navbar-dark .dropdown .dropdown-menu {
        background-color: #337ab7;

      }
       .navbar-dark  .dropdown-menu li>a {
        color:#fff;
       
      }
      </style>
            <script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>


          
     @endsection

