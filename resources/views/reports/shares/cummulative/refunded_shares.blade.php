 @extends('layouts.master')
       @section('title', '|Refunded Shares')
      @section('content')
       

      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
               <div class="box-header">
              
                       
                 <h3 class="box-title">From:  <strong>{{\Carbon\carbon::parse($startDate)->format('d/m/Y')}}</strong> <br> <br>To : <strong>{{\Carbon\carbon::parse($endDate)->format('d/m/Y')}}</strong></h3>         
            </div>
                    
             <table class="table">
              <thead>

                <tr>
              <th></th>
                 <th></th>
                 </tr>

              </thead>

              <tbody>

                 <tr style="background-color:#e8eefc; font-size:16px; font-weight:bold; color:#000;">
                      
                     <td>Total </td>
                    
                      <td class="pull-right"> {{number_format($shares->sum('amount'),2)}}</td>
                      
                  </tr>
                
              </tbody>
              
             </table>
            <!-- /.box-header -->
                                            <div class="col-md-6 col-md-offset-5">
                                          <h4 class="box-title">Refunded Shares</h4>
                                     </div>
                                        <div class="col-md-6 col-md-offset-3">
          <a ><button class="btn btn-default col-xs-3 print" style="margin-right: 5px;"><i style="color:red" class="fa fa-print" aria-hidden="true"></i> Print</button></a>
           <a  href="{{ url()->previous() }}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Members</th>
                  <th>Share Code</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($shares as $share)
                <tr>
              <td>{{$share->member->first_name}} {{$share->member->middle_name}} {{$share->member->last_name}}</td>
                <td>{{($share->member->memberaccount->where('name','Share Account')->first()->account_no)+$share->id}}</td>
                <td>{{number_format($share->amount,2)}}</td>
                <td>{{\Carbon\carbon::parse($share->share_date)->format('d/m/y')}}</td>
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