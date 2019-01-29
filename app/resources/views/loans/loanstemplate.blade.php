     @extends('layouts.master')
      @section('loans')

       @section('title', '| Profile')
        
     <div class="row">

      <div class="  col-md-1" ></div>
        <!-- /.col -->
        <div class=" col-md-10">
          <div class="center col-md-12 btn btn-info" >
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <li class="{{ Request::is('newloans_received') ? 'active' : '' }} btn btn-info btn-block">
                            
                             <a href="{{ url('newloans_received') }} "><b>New loans</b></a>
                          </li>
                          
                        </span>
                        <span class="btn  btn-sm  no-hover">

                           <li class="{{ Request::is('appended_loans') ? 'active' : '' }} btn btn-info btn-block">
                              <a href="{{url('appended_loans')}}"><b>Pending loans</b></a>
                           </li>
                         
                        </span>


                          <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                           
                              <li class="{{ Request::is('rejected_loans') ? 'active' : '' }} btn btn-info btn-block">
                                <a href="{{url('rejected_loans')}}"><b>Rejected loans</b></a>
                              </li>

                        </span>

                        <span class="btn  btn-sm btn-light no-hover">       
                            <li class="{{ Request::is('approved_loans') ? 'active' : '' }} btn btn-info btn-block">
                               <a href="{{url('approved_loans')}}"><b>Approved loans</b></a>
                            </li>

                        </span>
                        

                        <div class=" col-md-1" ></div>

                        
                  </div>
                 @yield('loansworkspace')

          </div>
          <!-- /.nav-tabs-custom -->



          <!--/.
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    

     @endsection

