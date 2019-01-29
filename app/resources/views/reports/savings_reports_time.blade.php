 @extends('layouts.master')
       @section('title', '| Savings In Time')
      @section('content')
       

      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Savings In Time Range</h3>
                         <br>
                         <br>
                 <h3 class="box-title">From  <strong>{{\Carbon\carbon::parse($startDate)->format('d/m/y')}}</strong> To  <strong>{{\Carbon\carbon::parse($endDate)->format('d/m/y')}}</strong></h3> 
                       <br>
                  
                   
                        
            </div>


             <table class="table">
              <thead>

                <tr>
              <th></th>
                 <th></th>
                 </tr>

              </thead>

              <tbody>

                 <tr style="background-color:#e8eefc; font-size:20px; font-weight:bold; color:#000;">
                      
                     <td>Total </td>
                    
                      <td class="pull-right"> {{number_format($savings->sum('amount'),2)}}</td>
                      
                  </tr>
                
              </tbody>
              
             </table>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Members</th>
                  <th>saving Code</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($savings as $saving)
                <tr>
              <td>{{$saving->member->first_name}} {{$saving->member->middle_name}} {{$saving->member->last_name}}</td>
                <td>{{($saving->member->memberaccount->where('name','Saving Account')->first()->account_no)+$saving->id}}</td>
                <td>{{number_format($saving->amount,2)}}</td>
                <td>{{\Carbon\carbon::parse($saving->saving_date)->format('d/m/y')}}</td>
                </tr>
                	      
                 @endforeach


 
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      @endsection