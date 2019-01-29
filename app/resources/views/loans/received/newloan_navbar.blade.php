
      <input type="hidden" value="{{$id=Request::segment(2)}}" name=""> 
      <input type="hidden" value="{{$lid=Request::segment(4)}}" name=""> 

<div class="col-md-12">
          <div class="center col-md-12 btn btn-danger" >

                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                            <li class="{{Request::is('newloan_receive/'.$id.'/general') ? 'active' : '' }}  btn btn-default btn-block">
                               <a href="{{url ('newloan_receive/'.$id.'/general')}}"><b>General</b></a>
                            </li>  
                         
                        </span>
                        <span class="btn  btn-sm  no-hover">

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
     
                  </div>
             


          </div>




            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">New Loan</h3>
                <br>
                <br>
                 <h3 class="box-title">loan no:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                  <th>Month</th>
                 
                   <th>Loan Principle(Tsh)</th>
                   <th>Loan Interest(Tsh)</th>
                   
                   <th>Duration</th>
                   <th>Requesting Date</th>
                  
                 
                
                </tr>
                </thead>
                <tbody>
                 <tr>   
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>                  
                </tr>
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>