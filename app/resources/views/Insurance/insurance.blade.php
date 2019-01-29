
 
     @extends('layouts.master')
      @section('content')

       @section('title', '| Security')
       
<div class="row">
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Fees</span></h3>
        </div>
        <div class="box-body">
            <table id="insurance" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      
                        <th style="width:20%;">Insurance Name</th>
                        <th>Percentage</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
 </div>
</div>
    <style type="text/css">
        
    #example{
        width:100%;
        background-color: #fff;
    }
    th {
        font-size: 12px;
    }
    </style>

      @endsection


       @section('js')


         <script type="text/javascript">
             var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "{{route('insurance')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#insurance",
        fields: [ {
                label: "Insurance Name:",
                name: "name",
               
            }, {
                label: "Insurance percentage",
                name: "percentage_insurance",
                
            }, 
            {
                label: "Date:",
                name: "insurance_date",
                type:"datetime"
            },              
        ]
    } );
 

    $('#insurance').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('insurance')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [


             { data: "name" },
             { data: "percentage_insurance" },


             { data: "insurance_date",
             "render": function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                return (month.length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear();
            }
           }  
             
        ],
        select: true,
        severSide:true,
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );
} );
 

  
         </script>

       @endsection

  

    
