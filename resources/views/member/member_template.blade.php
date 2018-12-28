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
          <div class="center col-md-12 btn btn-info" >

                          <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->

                           <li class="{{ Request::is('member/'.$id.'/profile') ? 'active' : '' }} btn btn-info btn-block">
                             <a href="{{url ('member/'.$id.'/profile')}}"><b>Profile</b></a>
                           </li>
                          
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->

                           <li class="{{ Request::is('member/'.$id.'/savings') ? 'active' : '' }} btn btn-info btn-block">
                             <a href="{{url ('member/'.$id.'/savings')}}"><b>Savings</b></a>
                           </li>
                          
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <li class="{{Request::is('member/'.$id.'/shares') ? 'active' : '' }} btn btn-info btn-block">
                            
                             <a href="{{url ('member/'.$id.'/shares')}}"><b>Shares </b></a>
                          </li>
                         
                        </span>
                        
                         
  
                        
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                            <li class="{{Request::is('member/'.$id.'/loans') ? 'active' : '' }} btn btn-info btn-block">
                               <a href="{{url ('member/'.$id.'/loans')}}"><b>Loans List</b></a>
                            </li>  
                         
                        </span>
                         <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                            <li class="{{Request::is('member/'.$id.'/apply_loan') ? 'active' : '' }} btn btn-info btn-block">
                               <a href="{{url ('member/'.$id.'/apply_loan')}}"><b>Apply Loan</b></a>
                            </li>  
                         
                        </span>


                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 23 </span>
                          <br /> -->
                         <li class="{{Request::is('member/'.$id.'/collaterals') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url ('member/'.$id.'/collaterals')}}" ><b>Collaterals</b></a>
                         </li>
                        </span>

                           <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 23 </span>
                          <br /> -->
                         <li class="{{Request::is('member/'.$id.'/payments') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url ('member/'.$id.'/payments')}}" ><b>Payments</b></a>
                         </li>
                        </span>

                        
                  </div>
              
                           @yield('memberinfo')
          </div>
                

          </div>
          <!-- /.nav-tabs-custom -->

     

          <!--/.
        </div>
        <!-- /.col -->
      </div>


          
     @endsection

