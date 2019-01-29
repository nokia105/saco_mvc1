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

<div class="row">

       <div class="col-md-8 col-md-offset-1">

          <div class="box">
            <div class="box-header" style="text-align: center;">
              <h3 class="box-title"><strong>Statment of Cash Flow</strong></h3>
                         <br>
                         <br>
                         <h3 class="box-title"><strong>TASAF SACCOS</strong></h3>
                          <br>
                         <br>
              
               <!--   For the 12 month period Ending December 31, 2003  -->
                                           
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table col-md-12">
                <thead>
                <tr  style="border:3px;" class="total">
                  <th style="">ACCOUNT</th>
                  <th style>31.12.{{$year}} TZS</th>
                  <th style="" class="pull-right">31.12.{{$preyear}} TZS</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                  <td><strong>Ziada Ya Mwaka</strong></td> 
                  <td></td>
                    <td> &nbsp;</td>
                  </tr>

         

               <tbody>
                <!-- <tr>
                  <td></td>
                  <td class="pull-right"></td>  
                </tr>
                
                
                 <tr class="no-border">
                  <td><strong>Other Income</strong></td>
                  <td></td>
                  <td class="pull-right"></td>  
                </tr>
                
                               <tr>
                  <td></td>
                
                   <td></td>
                  <td class="pull-right"></td>  
                </tr>
                           
                             
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                   
                  </tr>
                 <tr style="" class="total">
                  <td><strong style="color:blue">Total Income</strong></td>
                  <td></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>  
                </tr>
                
                <tr >
                  <td ><strong>EXPENSES</strong></td>
                  <td></td>
                   <td></td>
                </tr>
                <tr>
                  <td><strong>Operatinal Expenses</strong></td>
                  <td></td>
                  <td></td>
                </tr>
                
                
                <tr>
                  <td></td>
                  <td></td>
                  <td class="pull-right"></td>
                </tr>
                          
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td><strong>Busness Expenses</strong></td>
                  <td></td>
                  <td></td>
                </tr>
                
                          
                <tr>
                  <td></td>
                  <td></td>
                  <td class="pull-right"></td>
                </tr>
                              
                 <tr>
                   <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td><strong>Other Expenses</strong></td>
                  <td></td>
                  <td></td>
                </tr>
                               
                  
                <tr>
                  <td></td>
                  <td></td>
                  <td class="pull-right"></td>
                </tr>
                          
                 <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td><strong style="color:blue" >Total Expense</strong></td>
                  <td></td>
                  <td class="pull-right" ><strong></strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                
                 <tr>
                  <td ><strong>Net income before Tax</strong></td>
                  <td></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                 <tr>
                  <td ><strong>Tax</strong></td>
                  <td></td>
                  <td class="pull-right"></td>  
                </tr>
                 <tr>
                  <td><strong style="color:blue;">Total Net Icome</strong></td>
                  <td></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                         
                
                      <tr>
                  <td ><strong>Net income before Tax</strong></td>
                  <td></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                 <tr>
                  <td ><strong>Tax</strong></td>
                  <td></td>
                  <td class="pull-right"></td>  
                </tr>
                 <tr>
                  <td><strong style="color:blue;">Total Net Icome</strong></td>
                  <td></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr> -->
           
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

     