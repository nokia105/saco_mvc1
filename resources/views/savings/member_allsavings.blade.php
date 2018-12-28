 @extends('loans.template')

    @section('title', '|Savings ')
      @section('memberworkspace')


        <div class="row">
       <div class="col-xs-12">



          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Savings</h3>

            </div>

             

             <table class="table" id="example5">
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
                  <th>Code</th>
                  <th>Date</th>
                  
          
                    
                </tr>
                </thead>
                <tbody>

                	 
                    @foreach( $allmembersavings as $saving)

                   
                 <tr> 
                <td>{{number_format($saving->amount,2)}}</td>
                <td>{{$saving->saving_code}}</td>
                <td>{{ \Carbon\Carbon::parse($saving->saving_date)->format('d/m/Y')}}</td>
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
        

             $('#example5').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      "order": [[2, "asc" ]],
      'info'        : true,
      'autoWidth'   : false
    });      
            });


      </script>


     @endsection