 @extends('layouts.master')
       @section('title', '|Refunded Shares')
      @section('content')
       

      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
               <div class="box-header">
                   
                       
                 <h3 class="box-title">
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
                    
                      <td class="pull-right"> {{number_format($savings->sum('amount'),2)}}</td>
                      
                  </tr>
                
              </tbody>
              
             </table>
            <!-- /.box-header -->
                                            <div class="col-md-6 col-md-offset-5">
                                          <h4 class="box-title">Refunded Savings</h4>
                                     </div>
                                        <div class="col-md-6 col-md-offset-3">
         
           <a  href="{{ url()->previous() }}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>
                 <div class="box-body">
              <table id="refund_saving" class="table table-bordered table-striped">
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

       @section('js')
            <script type="text/javascript">
      $(document).ready(function() {
          
            
    $('#refund_saving').DataTable({
      dom: 'Bfrtip',
buttons: [
       
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
             {extend: 'pdfHtml5',
              title:'  Refunded Savings Year: {{$year}} ',
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
            title:' Refunded Savings Year: {{$year}}',
           
            
              }

             
]
    });
} );
      

    </script>
      @endsection