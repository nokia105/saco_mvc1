     @extends('layouts.master')
      @section('cover')

         @section('title', '| Profile')

           <style type="text/css">
          .no-hover li  b{
           color:#ffff;

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
                  <button type="button" class="btn btn-success">Number Loans <a href="{{route('loanlist',$id)}}"><span class="badge"> {{$no_loans}}</span></a></button>
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

<div class="col-md-10">


<nav class="navbar navbar-dark bg-primary profile" style="padding-top: 0px;">

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
   

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse profile-list" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="white"><a href="{{route('member_profile',$id)}}" class=""><b>Profile</b></a></li>
         <li  class="white"><a href="{{route('memberShares',$id)}}" class=""><b>Shares </b></a></li>
         <li  class="white"><a href="{{route('membersavings',$id)}}" class=""><b>Savings</b></a></li>
         @role('Cashier|Secretary','member')
            @if($member->status=='active')
          <li  class="white"><a href="{{url ('profile/'.$id.'/newloan')}}" class=""><b>New Loan</b></a></li>
                  
           @endif
          @endrole
         
                  
          <li  class="white"><a href="{{url ('profile/'.$id.'/loanlist')}}" class=""><b>Loans</b></a></li>
         <li  class="white"><a href="{{url('profile/'.$id.'/pay')}}"><b>Pay</b></a></li>
         <li  class="white"><a href="{{url('profile/'.$id.'/payment')}}"><b>Payments</b></a></li>
         <li  class="white"><a href="{{route('memberShares',$id)}}" class=""><b>Shares </b></a></li> 
         @role('Cashier','member')
         <!--  <li  class="white"><a href="{{url('profile/'.$id.'/payment')}}"><b>Payments</b></a></li>
          <li  class="white"> <a href="{{url('profile/'.$id.'/refund')}}"><b>Refund</b></a></li>
           <li  class="white"><a href="{{url('profile/'.$id.'/previous_payment')}}"><b>Previous Payments</b></a></li> -->
          @endrole
        <li class="dropdown">
          <a href="#" class="dropdown-toggle white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @role('Cashier','member')
          
          <li  class="white"> <a href="{{url('profile/'.$id.'/refund')}}"><b>Refund</b></a></li>
           <li  class="white"><a href="{{url('profile/'.$id.'/previous_payment')}}"><b>Previous Payments</b></a></li>
          @endrole
          <li><a href="{{url ('profile/'.$id.'/collateral')}}" ><b>Collaterals</b></a></li>
          </ul>
        </li>
      </ul>

    </div><!-- /.navbar-collapse -->

</nav>
                 @yield('memberworkspace')

          </div>
          <!-- /.nav-tabs-custom -->



          <!--/.
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <style type="text/css">
         .member_navbar span {
             padding:2px;

         }
        .nav-menu-profile{
          margin-top: 0px;
        }
       .profile .white a, .profile .white{
          color:#fff;
        }
        .profile a:hover {
          color:#fff;
        }
        .profile .active {
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



         