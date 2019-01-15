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
          <div class="center col-md-12 btn btn-info member_navbar" >

                        <span class="btn  btn-sm  no-hover">
                           <li class="{{ Request::is('member/'.$id) ? 'active' : '' }} btn btn-info btn-block">
                             <a href="{{route('member_profile',$id)}}"><b>Profile</b></a>
                           </li>
                        </span>
                        <span class="btn  btn-sm  no-hover">
                           <li class="{{ Request::is('profile/'.$id.'/membersavings') ? 'active' : '' }} btn btn-info btn-block">
                             <a href="{{route('membersavings',$id)}}"><b>Savings</b></a>
                           </li>
                          
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/membershares') ? 'active' : '' }} btn btn-info btn-block">
                            
                             <a href="{{route('memberShares',$id)}}"><b>Shares </b></a>
                          </li>
                         
                        </span>
                        
                                     
                          @role('Cashier|Secretary','member')

                            @if($member->status=='active')

                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
 
                         <li class="{{Request::is('profile/'.$id.'/newloan') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url ('profile/'.$id.'/newloan')}}"><b>New Loan</b></a>
                            
                         </li>
                        </span>
                        @endif
                          @endrole
                      
  
                        
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                            <li class="{{Request::is('profile/'.$id.'/loanlist') ? 'active' : '' }} btn btn-info btn-block">
                               <a href="{{url ('profile/'.$id.'/loanlist')}}"><b>Loans</b></a>
                            </li>  
                         
                        </span>

                       <!--  <span class="btn  btn-sm  no-hover">
                         
                        <a href="#" class="btn btn-info btn-block"><b>Deposts</b></a>
                       </span> -->
                          @role('Cashier','member')
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 4 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/pay') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url('profile/'.$id.'/pay')}}"><b>Pay</b></a>
                          </li>
                          
                        </span>

                         <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 4 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/payment') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url('profile/'.$id.'/payment')}}"><b>Payments</b></a>
                          </li>
                          
                        </span>

                          <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 4 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/refund') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url('profile/'.$id.'/refund')}}"><b>Refund</b></a>
                          </li>
                          
                        </span>

                         <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 4 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/previous_payment') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url('profile/'.$id.'/previous_payment')}}"><b>Previous Payments</b></a>
                          </li>
                          
                        </span>

                          @endrole

                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 23 </span>
                          <br /> -->
                         <li class="{{Request::is('profile/'.$id.'/collateral') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url ('profile/'.$id.'/collateral')}}" ><b>Collaterals</b></a>
                         </li>
                        </span>

                       

                        
                  </div>
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
      </style>

    

     @endsection



         