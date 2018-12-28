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
                      
                     <td>Total </td>
                    
                      <td class="pull-right"> {{number_format($allmembershares->sum('amount'),2)}}</td>
                      
                  </tr>
                
              </tbody>
              
             </table>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Amount</th>
                  <th>No Shares</th>
                  <th>Date</th>
                  
          
                    
                </tr>
                </thead>
                <tbody>

                   
                    @foreach( $allmembershares as $share)

                   
                 <tr> 
                <td>{{number_format($share->amount,2)}}</td>
                <td>{{$share->sum('No_shares')}}</td>
                <td>{{ \Carbon\Carbon::parse($share->share_date)->format('d/m/y')}}</td>
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