
      @extends('loans.template')
      @section('memberworkspace')

       @section('title', '| Collaterals')
<div class="row">
     <input type="hidden" value="{{$id=request()->route('id')}}" name=""> 
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Colleraterals</span></h3>
        </div>
        <div class="box-body">
            <table id="collateral" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:20%;">Collateral Name</th>
                        <th>Collateral Type</th>
                        <th>Collateral Value</th>
                        <th>Collateral Evalution Date</th>
                    </tr>
                </thead>
                <tbody>
                  
                  <tfoot></tfoot>
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
             
               //colaterall

    $(document).ready(function() {






    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "{{route('collat',$id)}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#collateral",
        fields: [ {
                label: "collateral name:",
                name: "collaterals.colateral_name"
            }, {
                label: "collateral Type:",
                name: "collaterals.colateral_type"
            }, {
                label: "collateral Value:",
                name: "collaterals.colateral_value"
            }, 

             
            {
                label: "Collateral evalution date:",
                name: "collaterals.colateralevalution_date",
                type:"datetime"
            }

           
          
        ]
    } );
 

    $('#collateral').dataTable( {
   
     
  
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('collat',$id)}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "collaterals.colateral_name" },   
            { data: "collaterals.colateral_type" },
             { data: "collaterals.colateral_value" },
            { data: "collaterals.colateralevalution_date",

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
        ],

    } );

} );


         $(document).ready(function() {
  @role('Cashier','member')
  $('.buttons-create,.buttons-edit,.buttons-remove').show();

  @else
     $('.buttons-create,.buttons-edit,.buttons-remove').hide();
    @endrole

});
 


         </script>

      @endsection



    
