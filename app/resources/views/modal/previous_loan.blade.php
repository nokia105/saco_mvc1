<div class="container">

    <style type="text/css">
        
        .previous_box{

            width:63%;
        }
    </style>


      

    <div class="row">

                <form method="POST" action="{{route('post_previous_loan',$id)}}">

                    <input type="hidden" name="paidmonths" value="{{$paidmonths}}" readonly="true">
                    <input type="hidden" name="issued_date" value="{{$issued_date}}" readonly="true">
                     <input type="hidden" name="pcategory" value="{{$pcategory}}" readonly="true">
                      <input type="hidden" name="duration" value="{{$duration}}" readonly="true">
                      @php
                               $rate=number_format(($interest*100)/($principle*$duration),2);
                      @endphp
                      <input type="hidden" name="percentage_interest" value="{{$rate}}" readonly="true">
                        <input type="hidden" name="principle" value="{{$principle}}" readonly="true">
                        <input  class="form-control" type="hidden" name="monthamount"  value="{{round((($principle/$duration)+($interest/$duration)),2)}}">
                        <input class="form-control" type="hidden"  value="{{round($interest/$duration,2)}}" name="monthinterest" readonly="true">
                    {{csrf_field()}}


        
            <div class="previous_box">

               
          
            <div class="box-header" style="text-align:center">
              <h3 class="box-title" ><strong>Previous Loan</strong></h3>
            </div>
            <!-- /.box-header -->

             <div class="center" style=" padding-bottom:5px;">
             <h4>Amount Requested:<strong style="padding-left:5px;">{{number_format($principle,2)}}</strong></h4>
                </div>


            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                   <th>Total Amount</th>
                   <th>Interest</th>
                   <th>Amount Left</th>
                 
                </tr>
                </thead>
                <tbody>


                        

                      @for($i=0; $i<$duration; $i++)
                         @php $d=$i+1;
                         $y1=date('Y',strtotime($startpayment));
                         $m1=date('m',strtotime($startpayment));
                         $d1=date('d',strtotime($startpayment));
                         if ($d1 >28) {
                          $date_rest=$y1.'-'.$m1.'-28';
                            $date0=Carbon\carbon::parse(date('Y-m-d', strtotime(($i).' month', strtotime($date_rest))))->format('Y-m-d'); 
                            $day=date('d',strtotime($date0));
                             $m=date('m',strtotime($date0));
                             $y=date('Y',strtotime($date0));
                             if (($y1==$y) &&($m1==$m)) $date=$startpayment;
                             else $date=date("Y-m-t", strtotime($date0));
                             }
                             else {
                             $date0=Carbon\carbon::parse(date('Y-m-d', strtotime(($i).' month', strtotime($startpayment))))->format('Y-m-d');
                             $day=date('d',strtotime($date0));
                             $m=date('m',strtotime($date0));
                             $y=date('Y',strtotime($date0));
                             if (($y1==$y) &&($m1==$m)) $date=$startpayment;
                             else $date=date("Y-m-t", strtotime($date0));
                           }
                         
                        
                            @endphp
                        
                  
                    <tr>
                       <td style="width:21%"><input  class="form-control"  value="{{$date}}"><input type="hidden" name="startpayment[]" value="{{$date}}"></td> 


                      <td><input  class="form-control" type="float"  id="t_amount" value="{{number_format((($principle/$duration)+($interest/$duration)),2)}}">
                        <input  class="form-control" type="hidden" name="amount[]" id="t_amount" value="{{round((($principle/$duration)+($interest/$duration)),2)}}"></td>


                      <td><input class="form-control" type="float"  value="{{number_format($interest/$duration,2)}}"readonly="true">
                        <input class="form-control" type="hidden"  value="{{round($interest/$duration,2)}}" name="interest[]" readonly="true"></td>

                       <td><input class="form-control"  id="aleft" value={{number_format($principle-(($principle/$duration)*$d),2)}} name="aleft[]" readonly="true"></td>   
                    </tr>
                    @endfor
                      
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>



            <div class="form-row col-md-6">
                <div class="form-group col-md-6 pull-right">
                <button class="btn btn-info col-md-offset-4 col-md-4 pull-right" style="margin-top: 20px;">Post</button>
              </div>
            </div>
      </form>

    </div> 


      

</div>

