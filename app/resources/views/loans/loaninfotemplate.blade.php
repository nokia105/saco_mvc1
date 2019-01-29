
      <input type="hidden" value="{{$id=Request::segment(2)}}" name=""> 
      <input type="hidden" value="{{$lid=Request::segment(4)}}" name=""> 

<div class="col-md-12">
          <div class="center col-md-12 btn btn-danger" >
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->

                           <li class="{{ Request::is('profile/'.$id.'/membersavings') ? 'active' : '' }} btn btn-default btn-block">
                             <a href="{{url ('profile/'.$id.'/membersavings')}}"><b>Loan Savings</b></a>
                           </li>
                          
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/membershares') ? 'active' : '' }} btn btn-default btn-block">
                            
                             <a href="{{url ('profile/'.$id.'/membershares')}}"><b> Shares</b></a>
                          </li>
                         
                        </span>
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                           
                         <li class="{{Request::is('profile/'.$id.'/newloan') ? 'active' : '' }}  btn btn-default btn-block">
                            <a href="{{url ('profile/'.$id.'/newloan')}}"><b> Collaterals</b></a>
                         </li>
                        </span>
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                            <li class="{{Request::is('profile/'.$id.'/loanlist') ? 'active' : '' }}  btn btn-default btn-block">
                               <a href="{{url ('profile/'.$id.'/loanlist')}}"><b> Guarator</b></a>
                            </li>  
                         
                        </span>

                        <span class="btn  btn-sm  no-hover">
                          
                            <li class="{{Request::is('profile/'.$id.'/schedule/' . $lid) ? 'active' : '' }}  btn btn-default btn-block">
                               <a href="{{url ('profile/'.$id.'/schedule/' . $lid)}}" ><b> Schedule</b></a>
                            </li>
                        </span>


                         <span class="btn  btn-sm  no-hover">
                          
                            <li class="{{Request::is('profile/'.$id.'/schedule/' . $lid) ? 'active' : '' }}  btn btn-default btn-block">
                               <a href="{{url ('profile/'.$id.'/schedule/' . $lid)}}" ><b>Repayment</b></a>
                            </li>
                        </span>
     
                  </div>
             


          </div>