 @extends('layouts.master')
      @section('content')
<div class="row">
    <div class=" col-md-9 center">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title"><stong>Accounts</span></stong></h3>
        </div>
        <div class=" center-1 box-body">
            <table id="accounts" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      
                        

                        <th>Code No:</th>
                        <th style="width:50%;">Gl Name</th>
                        <th>Category</th>
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
        
   
    th {
        font-size: 12px;
    }

    .center{

        margin:0 auto;
        padding-left:80px;
    }

  .box-body{
    text-align: center;
  }
    
    </style>

      @endsection


       @section('js')


         <script type="text/javascript">
             var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "{{route('accounts')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#accounts",
        fields: [  {
                label: "Code Number",
                name: "glaccounts.code",
                
            },

            {
                label: "Account Name:",
                name: "glaccounts.name",
                
            },

            {
                label: "Category:",
                name: "glaccounts.categoryaccount_id",
                type:"select",
               
                placeholder:"Select category"
               
            }
                         
        ]
    } );
 

    $('#accounts').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('accounts')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [


             { data: "glaccounts.code" },
             { data: "glaccounts.name" },
             { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                name=data.categoryaccounts.name;
                return name
                 }
            }, 
             
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
