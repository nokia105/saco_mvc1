@extends('member.member_template')
@section('memberinfo')

 @section('title', '|All Shares')

 
        <div class="row">
       <div class="col-xs-12">


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Shares</h3>

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
                      
                     <td>Current Balance </td>
                    
                      <td class="pull-right"> {{number_format(($allmembershares->where('state','in')->sum('amount')-$allmembershares->where('state','out')->sum('amount')),2)}}</td>
                      
                  </tr>
                
              </tbody>
              
             </table>
            <!-- /.box-header -->

                                               <div class="col-md-6 col-md-offset-3">
          <a ><button class="btn btn-default col-xs-3 print" style="margin-right: 5px;"><i style="color:red" class="fa fa-print" aria-hidden="true"></i> Print</button></a>
           <a  href="{{ url()->previous() }}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Amount</th>
                  <th>No Shares</th>
                  <th>Date</th>
                  <th>Status</th>
                  
          
                    
                </tr>
                </thead>
                <tbody>

                   
                    @foreach( $allmembershares as $share)

                   @if($share->state=='in') 
                 <tr> 
                <td>{{number_format($share->amount,2)}}</td>
                <td>{{$share->No_shares}}</td>
                <td>{{ \Carbon\Carbon::parse($share->share_date)->format('d/m/Y')}}</td>
                  <td style="text-align:center;"><span class="label label-sm label-success">RECEIVED</span></td>
                </tr>
                 @else
                  <tr style="background-color:#f4d941; color:black; font-weight:bold;"> 
                <td>{{number_format($share->amount,2)}}</td>
                <td>{{$share->No_shares}}</td>
                <td>{{ \Carbon\Carbon::parse($share->share_date)->format('d/m/Y')}}</td>
                <td style="text-align:center;"><span class="label label-sm label-info">REFUNDED</span></td>
                </tr>
                @endif
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