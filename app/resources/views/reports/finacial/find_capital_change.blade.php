 @extends('layouts.master')

      @section('content')
         @section('title', '|Change In Capital')
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

       <div class="col-md-12 ">

          <div class="box">
            <div class="box-header" style="text-align: center;">
              <h3 class="box-title"><strong>Change In Capital</strong></h3>
                         <br>
                         <br>
                         <h3 class="box-title"><strong>TASAF SACCOS</strong></h3>
                          <br>
                         <br>
                                           
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                      <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Maelezo</th>
                  <th>A. ya Lazima</th>
                  <th>A. ya Kukombolea mafungu</th>
                  <th>A. ya elimu</th>
                  <th>Kinga ya Madeni Mabaya</th>
                  <th>Limbikizo la Mtaji</th>
                </tr>
                  <tr >
                   <th></th>
                   <th>TZS</th>
                  <th>TZS</th>
                  <th>TZS</th>
                   <th>TZS</th>
                   <th>TZS</th>
                   
                </tr>

                 <tr >
                   <th></th>
                   <th>20%</th>
                   <th>15%</th>
                   <th>15%</th>
                   <th>10%</th>
                   <th></th>
                 </tr>
                </thead>
                <tbody> 
                     <tr style="color:black; font-weight:bold; ">
                    <td >Salio Anzia 01.01.{{$preyear}}</td>
                    <td></td>
                    <td></td>
                     <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                 <tr>
                    <td>Ziada ya Mwaka</td>
                    <td style="color:black; font-weight:bold;">@php  echo number_format($preaklaz=((20/100)*$preprofitaftertax),2) @endphp</td>
                    <td style="color:black; font-weight:bold;">@php  echo number_format($preaklmaf=((15/100)*$preprofitaftertax),2) @endphp</td>
                     <td style="color:black; font-weight:bold;">@php  echo number_format($preakelimu=((15/100)*$preprofitaftertax),2) @endphp</td>
                    <td style="color:black; font-weight:bold; ">@php  echo number_format($premmabya=((10/100)*$preprofitaftertax),2) @endphp</td>
                    <td style="color:black; font-weight:bold; "></td>
                  </tr>
                  <tr>
                    <td>Ongezeko la Matengo</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                     <td style="color:black; font-weight:bold; ">0.00</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                  </tr>
                   <tr style="color:black; font-weight:bold; ">
                    <td>Salio Ishia 31.12.{{$preyear}}</td>
                    <td>@php @endphp</td>
                    <td>@php  @endphp</td>
                     <td>@php  @endphp</td>
                    <td>@php  @endphp</td>
                    <td>@php  @endphp</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>

                    <tr style="color:black; font-weight:bold;">
                    <td>Salio Anzia 01.01.{{$year}}</td>
                    <td>@php    @endphp</td>
                    <td></td>
                     <td></td>
                    <td></td>
                    <td></td>
                  </tr>

                    <tr>
                    <td>Ziada ya Mwaka</td>
                    <td style="color:black; font-weight:bold;">@php  echo number_format($aklaz=((20/100)*$profitaftertax),2) @endphp</td>
                    <td style="color:black; font-weight:bold;">@php  echo number_format($aklmaf=((15/100)*$profitaftertax),2) @endphp</td>
                     <td style="color:black; font-weight:bold;">@php  echo number_format($akelimu=((15/100)*$profitaftertax),2) @endphp</td>
                    <td style="color:black; font-weight:bold; ">@php  echo number_format($mmabya=((10/100)*$profitaftertax),2) @endphp</td>
                    <td style="color:black; font-weight:bold; "></td>
                  </tr>
                  <tr>
                    <td>Ongezeko la Matengo</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                     <td style="color:black; font-weight:bold; ">0.00</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                    <td style="color:black; font-weight:bold; ">0.00</td>
                  </tr>
                   <tr style="color:black; font-weight:bold; ">
                    <td>Salio Ishia 31.12.{{$year}}</td>
                    <td></td>
                    <td></td>
                     <td></td>
                    <td></td>
                    <td></td>
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
      <style type="text/css">
        .total{

        }
      </style>

      @endsection



     