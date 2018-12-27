 @extends('layouts.master')

      @section('content')
         @section('title', '| Income Statment')
       @section('css')

           <style type="text/css">
     tr.no-border td {
      background-color:#0000;
  border: 0;
}
.total td {
  
}
   </style>
       @endsection

                     @php 
                      $startNum  =$startmonth;
                    $startName = date('F', mktime(0, 0, 0, $startNum, 10));
                     @endphp

                     @php 
                      $endNum  =$endmonth;
                    $endName = date('F', mktime(0, 0, 0, $endNum, 10));
                     @endphp

<div class="row">

       <div class="col-md-8 col-md-offset-1">

          <div class="box">
            <div class="box-header" style="text-align: center;">
              <h3 class="box-title"><strong>Income Statment</strong></h3>
                         <br>
                         <br>
                         <h3 class="box-title"><strong>TASAF SACOS</strong></h3>
                          <br>
                         <br>
                 <h3 class="box-title"> Income statement Starting  at<strong> {{$startName}} </strong> Ending  <strong>{{$endName}}  {{$year}}.</strong></h3>
               <!--   For the 12 month period Ending December 31, 2003  -->
                      
                              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table col-md-12">
                <thead>
                <tr  style="border:3px;" class="total">
                  <th style="">ACCOUNT</th>
                  <th style="" class="pull-right">AMOUNT</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                  <td><strong>INCOME</strong></td> 
                    <td> &nbsp;</td>
                  </tr>

                  @php
                     
        $loanncomes_total=$otherincome_total=$operatinalexpense_total=$busnessexpense_total=$otherexpense_total=0;


                  @endphp

                   @foreach($loanncomes  as $interestincome)

                    @php
                      $loanncomes_total+=$interestincome->dramount;
                    @endphp

               <tbody>
                <tr>
                  <td>{{$interestincome->mainnames}}</td>
                  <td class="pull-right">{{number_format($interestincome->dramount,2)}}</td>  
                </tr>
                   @endforeach


                 <tr class="no-border">
                  <td><strong>Other Income</strong></td>
                  <td class="pull-right"></td>  
                </tr>
                   @foreach($otherincomes as $otherincome)

                   @php
                    $otherincome_total+=$otherincome->dramount;
                   @endphp
               <tr>
                  <td>{{$otherincome->mainnames}}</td>


                  <td class="pull-right">{{number_format($otherincome->dramount,2)}}</td>  
                </tr>
                  @endforeach
                 <tr>
                  <tr>
                    <td></td>
                    <td></td>
                   
                  </tr>
                 <tr style="" class="total">
                  <td><strong style="color:blue">Total Income</strong></td>
                  <td class="pull-right"><strong>{{number_format(($totalincome=$otherincome_total+$loanncomes_total),2)}}</strong></td>  
                </tr>

                <tr>
                  <td></td>
                  <td></td>  
                </tr>

                <tr >
                  <td ><strong>EXPENSES</strong></td>
                   <td></td>
                </tr>
                <tr>
                  <td><strong>Operatinal Expenses</strong></td>
                  <td></td>
                </tr>

                

                 @foreach($operatinalexpenses as $operatinalexpense)

                   @php
                     $operatinalexpense_total+=$operatinalexpense->dramount;
                 @endphp

                <tr>
                  <td>{{$operatinalexpense->mainnames}}</td>
                  <td class="pull-right">{{number_format($operatinalexpense->dramount,2)}}</td>
                </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td><strong>Busness Expenses</strong></td>
                  <td></td>
                </tr>

                  

                 @foreach($busnessexpenses as $busnessexpense)

                  @php
                    $busnessexpense_total+=$busnessexpense->dramount;
                  
                  @endphp
                <tr>
                  <td>{{$busnessexpense->mainnames}}</td>
                  <td class="pull-right">{{number_format($busnessexpense->dramount,2)}}</td>
                </tr>
                @endforeach
                 <tr>
                   <tr>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td><strong>Other Expenses</strong></td>
                  <td></td>
                </tr>
                 @foreach( $otherexpenses as  $otherexpense)

                         @php
                          $otherexpense_total+=$otherexpense->dramount;
                   @endphp
                  
                <tr>
                  <td>{{$otherexpense->mainnames}}</td>
                  <td class="pull-right">{{number_format($otherexpense->dramount,2)}}</td>
                </tr>
                @endforeach
                 <tr>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td><strong style="color:blue" >Total Expense</strong></td>
                  <td class="pull-right" ><strong>{{number_format($totalexpense=$operatinalexpense_total+$busnessexpense_total+$otherexpense_total,2)}}</strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>


                      @php
                          $btax=$totalincome-$totalexpense;

                      @endphp

                      @if($btax> 0)

                 <tr>
                  <td ><strong>Net income before Tax</strong></td>
                  <td class="pull-right"><strong>{{number_format($btax=$totalincome-$totalexpense,2)}}</strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                 <tr>
                  <td ><strong>Tax</strong></td>
                  <td class="pull-right">{{number_format($tax=($taxpecentage/100)*$btax)}}</td>  
                </tr>
                 <tr>
                  <td><strong style="color:blue;">Total Net Icome</strong></td>
                  <td class="pull-right"><strong>{{number_format($btax-$tax,2)}}</strong></td>  
                </tr>
                @else

                      <tr>
                  <td ><strong>Net income before Tax</strong></td>
                  <td class="pull-right"><strong>{{number_format($btax=$totalincome-$totalexpense,2)}}</strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                 <tr>
                  <td ><strong>Tax</strong></td>
                  <td class="pull-right">{{number_format($tax= 0.00)}}</td>  
                </tr>
                 <tr>
                  <td><strong style="color:blue;">Total Net Icome</strong></td>
                  <td class="pull-right"><strong>{{number_format($btax-$tax,2)}}</strong></td>  
                </tr>
                @endif
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <style type="text/css">
        .total{

        }
      </style>

      @endsection



     @section('js')
          


     @endsection

     