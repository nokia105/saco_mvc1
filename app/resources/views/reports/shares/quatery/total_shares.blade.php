 @extends('layouts.master')
       @section('title', '|Total Shares')
      @section('content')
       

      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
               <div class="box-header">
                   
                      @php 
                      $startNum  =$startmonth;
                    $startName = date('F', mktime(0, 0, 0, $startNum, 10));
                     @endphp

                     @php 
                      $endNum  =$endmonth;
                    $endName = date('F', mktime(0, 0, 0, $endNum, 10));
                     @endphp
                       
                 <h3 class="box-title">Start Month :  <strong>{{$startName}}</strong>
                                           <br> <br>
                                        End Month : <strong>{{$endName}}</strong>

                                         <br> <br>
                                           Year :  <strong>{{$year}}</strong></h3>         
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
                                          <h4 class="box-title">Total Shares</h4>
                                     </div>
                                        <div class="col-md-6 col-md-offset-3">
    
           <a  href="{{ url()->previous() }}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>
            <div class="box-body">
              <table id="total_shares" class="table table-bordered table-striped">
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

                @section('js')
            <script type="text/javascript">
      $(document).ready(function() {
          
            
    $('#total_shares').DataTable({
      dom: 'Bfrtip',
buttons: [
       
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
             {extend: 'pdfHtml5',
              title:' Total shares from {{$startName}} to {{$endName}} of {{$year}} ',
           },
            {extend:'print',
            // messageTop: 'Loans in Date',
            customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10px' )
                        .prepend(
                            '<img src="{{asset('images/logo/saccos.jpg')}}" style="position:absolute; top:10%; left:50%; opacity:0.2;"  />'
                        );
 
                },
            title:' Total shares from {{$startName}} to {{$endName}} of {{$year}}',
           
            
              }

             
]
    });
} );
      

    </script>
      @endsection