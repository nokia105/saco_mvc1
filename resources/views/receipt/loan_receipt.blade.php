
  <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SACCOS | Dashboard</title>
 

</head>

<hr style="width:100%; color:green;font-weight: 300px; margin-top: -4px;" />
<div class="container">


   <div class="loaninfo">
    <div class="col-md-12 text-center" style="text-align: center;">
      <h2>TASAF SACCOS</h2><br>
      <img src="{{asset('images/logo/saccos.jpg')}}" alt="logo" /><br/>
     
      <u><h4>LOAN RECEIPT</h4></u>

      
    </div>


      <div class="col-md-6">
         
           <label>Principle: <strong>{{number_format(round($principle,2))}}</strong> </label>
           
                    <br>
                    <br>
         
          <label>Rate: <strong>{{$interest}} %</strong></label>
        
                
             
      </div>


       <div class="col-md-6">

         
                <label>Start Date: <strong>@php echo $date0=Carbon\carbon::parse(date('Y-m-d', strtotime((0).' month', strtotime($firstpayment))))->format('d/m/Y');  @endphp</strong></label>
             
                          <br>
                          <br>
      
                <label>Loan Duration: <strong>{{$period}} Month(s)</strong></label>
              
      
    </div>
   </div>
	
      
   <div id="table">

	<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col"> SN</th>
       <th scope="col">Date</th>
      <!-- <th scope="col" align="right"> Beginning Balance</th>  -->
      <th scope="col" align="right">Monthly Payment</th>
      <th scope="col" align="right">Monthly Principle</th>
       <th scope="col" align="right">Monthly Interest</th>
       <th  align="right">Loan Balance</th>
      
    </tr>
  </thead>
  <tbody>
    @php  $balance=$principle; @endphp
  	 @for($i=0; $i<$period; $i++)
    <tr>
      @php
        $startpayment=$firstpayment;
                         $d=$i+1;
                         $y1=date('Y',strtotime($startpayment));
                         $m1=date('m',strtotime($startpayment));
                         $d1=date('d',strtotime($startpayment));
                         if ($d1 >28) 
                         {
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

                          //ending balance
                        $balance=$balance-round(($principle/$period),2);
                        

                          @endphp

    	
      <td>{{$i+1}}</td>
      <td>{{$date}}</td>
      <!-- <td align="right">@php echo round($balance,2); @endphp</td> -->
      <td align="right">@php echo number_format(round(($monthlyrepayment),2),2); @endphp</td>
      <td align="right">@php echo number_format(round(($principle/$period),2),2); @endphp</td>
       <td align="right">@php echo number_format(round(($montlyinterest),2),2); @endphp</td>
       <td align="right">@php echo number_format(round(($balance),2),2); @endphp</td>
 
    </tr>
     @endfor
    
  </tbody>
</table>
</div>
<h4 style="width:100%;">Printed By : <lable>@php echo strtoupper(Auth()->user()->first_name.'   '.Auth()->user()->last_name) @endphp</lable><br/>
      Printed Date : <lable>@php echo date('d/m/Y H:i:s'); @endphp</lable>

    </h4>
</div>

    

  <style type="text/css">

 

       html {
  font-family: sans-serif;
  -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
}
body {
  margin: 0;
}

h4,label
 {
  font-family: inherit;
  font-weight:300;
  line-height: 1.1;
  color: inherit;
  font-size:18px;
}

strong{
	font-weight:500;
	font-size:18px;
	font-family:'Rokkitt';  
}





    @font-face {
  font-family: 'Rokkitt';
  font-style: normal;
  font-weight: 400;
  src: local('Rokkitt Regular'), local('Rokkitt-Regular'), url(https://fonts.gstatic.com/s/rokkitt/v12/qFdE35qfgYFjGy5hkEmCdubL.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Rokkitt';
  font-style: normal;
  font-weight: 400;
  src: local('Rokkitt Regular'), local('Rokkitt-Regular'), url(https://fonts.gstatic.com/s/rokkitt/v12/qFdE35qfgYFjGy5hkEiCdubL.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Rokkitt';
  font-style: normal;
  font-weight: 400;
  src: local('Rokkitt Regular'), local('Rokkitt-Regular'), url(https://fonts.gstatic.com/s/rokkitt/v12/qFdE35qfgYFjGy5hkEaCdg.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
  	
  	 label,h4, th, td{
            font-family: 'Rokkitt', serif;
          }
    
table {
  border-spacing: 0;
  border-collapse: collapse;
}
td,
th {
  padding: 0;
}
/*! Source: https://github.com/h5bp/html5-boilerplate/blob/master/src/css/main.css */
@media print {
  *,
  *:before,
  *:after {
    color: #000 !important;
    text-shadow: none !important;
    background: transparent !important;
    -webkit-box-shadow: none !important;
            box-shadow: none !important;
  }
  
 
  thead {
    display: table-header-group;
  }

  .table {
    border-collapse: collapse !important;
  }
  .table td,
  .table th {
    background-color: #fff !important;
  }
  .table-bordered th,
  .table-bordered td {
    border: 1px solid #ddd !important;
  }
}

    .company{
      padding-top:15px;
      padding-bottom:15px;
    }
 

  #table{
    padding-top:60px;
  }

 

    


 .col-md-6{
    float: left;
    width:50%;
  }

        table {
  background-color: transparent;
}
caption {
  padding-top: 8px;
  padding-bottom: 8px;
  color: #777;
  text-align: left;
}
th {
  text-align: left;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #ddd;
}
.table .table {
  background-color: #fff;
}
.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 5px;
}
.table-bordered {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > thead > tr > td {
  border-bottom-width: 2px;
}
.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}
.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}
table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}
table td[class*="col-"],
table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none;
}
.table > thead > tr > td.active,
.table > tbody > tr > td.active,
.table > tfoot > tr > td.active,
.table > thead > tr > th.active,
.table > tbody > tr > th.active,
.table > tfoot > tr > th.active,
.table > thead > tr.active > td,
.table > tbody > tr.active > td,
.table > tfoot > tr.active > td,
.table > thead > tr.active > th,
.table > tbody > tr.active > th,
.table > tfoot > tr.active > th {
  background-color: #f5f5f5;
}
.table-hover > tbody > tr > td.active:hover,
.table-hover > tbody > tr > th.active:hover,
.table-hover > tbody > tr.active:hover > td,
.table-hover > tbody > tr:hover > .active,
.table-hover > tbody > tr.active:hover > th {
  background-color: #e8e8e8;
}
.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
  background-color: #dff0d8;
}
.table-hover > tbody > tr > td.success:hover,
.table-hover > tbody > tr > th.success:hover,
.table-hover > tbody > tr.success:hover > td,
.table-hover > tbody > tr:hover > .success,
.table-hover > tbody > tr.success:hover > th {
  background-color: #d0e9c6;
}
.table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #d9edf7;
}
.table-hover > tbody > tr > td.info:hover,
.table-hover > tbody > tr > th.info:hover,
.table-hover > tbody > tr.info:hover > td,
.table-hover > tbody > tr:hover > .info,
.table-hover > tbody > tr.info:hover > th {
  background-color: #c4e3f3;
}
.table > thead > tr > td.warning,
.table > tbody > tr > td.warning,
.table > tfoot > tr > td.warning,
.table > thead > tr > th.warning,
.table > tbody > tr > th.warning,
.table > tfoot > tr > th.warning,
.table > thead > tr.warning > td,
.table > tbody > tr.warning > td,
.table > tfoot > tr.warning > td,
.table > thead > tr.warning > th,
.table > tbody > tr.warning > th,
.table > tfoot > tr.warning > th {
  background-color: #fcf8e3;
}
.table-hover > tbody > tr > td.warning:hover,
.table-hover > tbody > tr > th.warning:hover,
.table-hover > tbody > tr.warning:hover > td,
.table-hover > tbody > tr:hover > .warning,
.table-hover > tbody > tr.warning:hover > th {
  background-color: #faf2cc;
}
.table > thead > tr > td.danger,
.table > tbody > tr > td.danger,
.table > tfoot > tr > td.danger,
.table > thead > tr > th.danger,
.table > tbody > tr > th.danger,
.table > tfoot > tr > th.danger,
.table > thead > tr.danger > td,
.table > tbody > tr.danger > td,
.table > tfoot > tr.danger > td,
.table > thead > tr.danger > th,
.table > tbody > tr.danger > th,
.table > tfoot > tr.danger > th {
  background-color: #f2dede;
}
.table-hover > tbody > tr > td.danger:hover,
.table-hover > tbody > tr > th.danger:hover,
.table-hover > tbody > tr.danger:hover > td,
.table-hover > tbody > tr:hover > .danger,
.table-hover > tbody > tr.danger:hover > th {
  background-color: #ebcccc;
}
.table-responsive {
  min-height: .01%;
  overflow-x: auto;
}






  </style>

</html>


 
    


   