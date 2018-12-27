 @extends('layouts.master')

      @section('content')
       @section('title', '|Balance Sheet')
       @section('css')

           <style type="text/css">
     tr.no-border td {
      background-color:#0000;
  border: 0;
}
   </style>
       @endsection

<div class="row">

       <div class="col-md-8 col-md-offset-2">

          <div class="box">
            <div class="box-header" style="text-align: center;">
              <h3 class="box-title"><strong>Balance Sheet</strong></h3>
                         <br>
                         <br>
                         <h3 class="box-title"><strong>TASAF SACOSS</strong></h3>
                          <br>
                         <br>
                  <h3 class="box-title"> Balance sheet for ending year <strong>31 December {{$year}}.</strong></h3>
               <!--   For the 12 month period Ending December 31, 2003  -->
                      
                   
                

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <thead>
                <tr  style="border:0">
                 <th style="font-size">ACCOUNT</th>
                  <th class="pull-right">AMOUNT</th>
                </tr>
                </thead>
                <tbody>
                  <tr >
                  <td><strong>ASSETS</strong></td> 
                    <td></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                   <tr>
                    <td><strong>Fixed asset</strong></td>
                    <td></td>
                  </tr>

                     @php
                 $total_currentasset=$total_fixedasset=$total_capital=0;
               
                 @endphp

                  @foreach($fixedassets as $fixedasset)
                    @php
                   $total_fixedasset+=$fixedasset->cramount;

                    @endphp
                <tr class="no-border">
                  <td>{{$fixedasset->mainnames}}</td>
                  <td class="pull-right">{{number_format($fixedasset->cramount,2)}}</td>  
                </tr> 

                @endforeach   
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>

                   <tr>
                  <td ><strong style="color:blue">Total Fixed Asset</strong></td>
                  <td class="pull-right"><strong>{{number_format($total_fixedasset,2)}}</strong></td>  
                </tr>
                   <tr>
                    <td><strong>Current asset</strong></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                           @foreach($currentassets as  $currentasset)
                               @php
                             $total_currentasset+=$currentasset->accountsum;
                             @endphp

                  <tr class="no-border">
                  <td>{{$currentasset->mainnames}}</td>
                  <td class="pull-right">{{number_format($currentasset->accountsum,2)}}</td>  
                </tr> 
                          @endforeach
                            
                         
                      
                    <tr class="no-border">
                  <td>Bank</td>
                  <td class="pull-right">{{number_format($bankaccount,2)}}</td>  
                </tr>

                   <tr>
                     <td></td>
                     <td></td>
                   </tr>
                  <tr>
                  <td ><strong style="color:blue">Total Current Asset</strong></td>
                  <td class="pull-right"><strong>{{number_format(($total_currentasset+$bankaccount),2)}}</strong></td>  
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td ><strong style="color:blue">Total Asset</strong></td>
                  <td class="pull-right"><strong>{{number_format($totalasset=$bankaccount+$total_fixedasset+$total_currentasset,2)}}</strong></td> 
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td style=""><strong>EQUITY AND LIABILITY</strong></td>
                   <td></td>
                </tr>

                   <tr>
                    <td><strong>Capital</strong></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>

                  @foreach($capitals as $capital)

                         @php

                      $total_capital+=$capital->dramount;

                      @endphp
                <tr>
                  <td>Members {{$capital->mainnames}}</td>
                  <td class="pull-right">{{number_format($capital->dramount,2)}}</td>
                </tr>
                 @endforeach

                 <tr>
                  <td><strong style="color:blue">Total Equity And Liability</strong></td>
                  <td class="pull-right"><strong>{{number_format($total_capital,2)}}</strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>

                 <tr>
                  <td ><strong></strong></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
               
                 <tr>
                  <td><strong></strong></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
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
          


     @endsection

     