@extends('member.member_template')
@section('memberinfo')

 @section('title', '|All Savings')

  <div class="row">
       <div class="col-xs-12">



             



          <div class="box">
            <div class="box-header">

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
                    
                      <td class="pull-right"> {{number_format($allmembersavings->sum('amount'),2)}}</td>
                      
                  </tr>
                
              </tbody>
              
             </table>
             
              <h3 class="box-title">Savings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Amount</th>
                  <th>Code</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
               
                    @foreach( $allmembersavings as $saving)

                   
                 <tr> 
                <td>{{number_format($saving->amount,2)}}</td>
                <td>{{$saving->saving_code}}</td>
                <td>{{ \Carbon\Carbon::parse($saving->saving_date)->format('d/m/y')}}</td>
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