 @extends('layouts.master')

      @section('content')

 @section('title', '| Interest Expected')
      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              
                       
                 <h3 class="box-title">From:  <strong>{{\Carbon\carbon::parse($startDate)->format('d/m/Y')}}</strong> <br> <br>To : <strong>{{\Carbon\carbon::parse($endDate)->format('d/m/Y')}}</strong></h3>         
            </div>
            <!-- /.box-header -->
                                  <div class="col-md-6 col-md-offset-5">
                                          <h3 class="box-title">Loan Report</h3>
                                     </div>

                                <div class="col-md-6 col-md-offset-3">
          <a ><button class="btn btn-default col-xs-3 print" style="margin-right: 5px;"><i style="color:red" class="fa fa-print" aria-hidden="true"></i> Print</button></a>
           <a  href="{{ url()->previous() }}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>
            <div class="box-body">
              <table id="expected" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Month</th>
                  <th>No Loans</th>
                  <th>Principle</th>
                  <th>Interest</th>
                 
                </tr>
                </thead>
                <tbody>
                   @foreach($loans as $loan)
                <tr>
                  <td>{{\DateTime::createFromFormat('!m',$loan->monthnumber)->format('F')}}</td>
                  <td>{{$loan->no_loans}}</td>
                   <td>{{number_format($loan->principlesum,2)}}</td>
                   <td>{{number_format($loan->interestsum,2)}}</td>
                  
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
        

            $(document).ready(function(){

   $(function () {
   
    $('#expected').DataTable({

      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
    });
  });
            



            });

      </script>


     @endsection