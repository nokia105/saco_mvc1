 @extends('layouts.master')

   @section('outreceipttemplate')



     <div class="container-fluid">
     	 <div class="row">
     	    <div class="printheading">

              <div class="print " >
              	 <button class="btn btn-info" onclick="printdiv('#div')">Print</button>
              </div>

               <div class="new-payment" >
              	<button class="btn btn-info"><a href="{{URL::previous()}}" style="color:#fff">New Payment</a></button>
              </div>

     	    </div>
     	     @yield('receiptcontent')	
     	 </div>
     	
     </div>

       @section('css')

         <style type="text/css">
         	 .printheading{

         	 	 width:67%;
         	 	 background-color:#fff; 
         	 	 height:70px;
         	 }

         	  .print{
                
                  float:left;
                  padding-top:25px;
                  padding-left:70%;

         	  }
               .new-payment{

               	 padding-left:79%;
                 padding-top:25px;
               }


         </style>

        @endsection

   @endsection



       @section('js')

    <script type="text/javascript">
      
        function printdiv(div){
                           
                             var restorepage=document.body.innerHTML;
                             var printContent=document.getElementById('div').innerHTML;
                             document.body.innerHTML=printContent;
                             window.print();
                             document.body.innerHTML=restorepage;

        }

    </script>
   @endsection

   