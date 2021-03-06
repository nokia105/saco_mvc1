 @extends('layouts.master')
       @section('title', '| Issued loans')
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
            <!-- /.box-header -->
                                  <div class="col-md-6 col-md-offset-5">
                                          <h3 class="box-title">Issued Loans</h3>
                                     </div>

                                <div class="col-md-6 col-md-offset-3">
   
           <a  href="{{ url()->previous() }}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Members</th>
                  <th>Loan Code</th>
                  <th>Principle</th>
                  <th>Interest</th>
                  <th>Fee</th>
                   <th>Inssued Date</th>
                 
                   <th>Status</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($loans as $loan)
                <tr>
                  <td>{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}</td>
                  <td><a href="{{route('loan_info',$loan->id)}}">#{{$code+$loan->id+$loan->member->member_id}}</a></td>
                  <td>{{number_format($loan->mounthlyrepayment_principle*$loan->duration,2)}}</td>
                   <td>{{number_format($loan->mounthlyrepayment_interest*$loan->duration,2)}}</td>
                  <td>{{number_format($loan->loan_fees->sum('fee_value'),2)}}</td>
                   <td>{{\Carbon\carbon::parse($loan->loanInssue_date)->format('d/m/Y')}}</td>
                
                  <td>{{strtoupper($loan->loan_status)}}</td>
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
          
            
    $('#example1').DataTable({
      dom: 'Bfrtip',
buttons: [
       
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
             {extend: 'pdfHtml5',
              title:' TASAF SACCOS \n \n Issued Loans from {{$startName}} to {{$endName}} of {{$year}} ',
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
            title:'<div style="text-align:center;  font-size:16px; padding-top:10%">TASAF SACCOS <br/><br/>  Issued Loans from {{$startName}} to {{$endName}} of {{$year}} <br/><br/></div>',
           
            
              }

             
]
    });
} );
      

    </script>
      @endsection