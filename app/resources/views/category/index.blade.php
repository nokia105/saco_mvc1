 @extends('layouts.master')
      @section('content')
<div class="row">
    <div class=" col-md-9 center">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title"><stong>Categories</span></stong></h3>
        </div>
        <div class=" center-1 box-body">
            <table id="category" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      
                        <th style="width:50%;">Category Name</th>
                        <th>Code No:</th>
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
        url     : "{{route('category')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#category",
        fields: [ {
                label: "Category Name:",
                name: "name",
               
            }, {
                label: "Code Number",
                name: "code",
                
            } 
                         
        ]
    } );
 

    $('#category').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('category')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [


             { data: "name" },
             { data: "code" } 
             
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
