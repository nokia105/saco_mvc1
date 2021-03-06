<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="{{ asset('fonts/Rokkitt.css') }}" rel="stylesheet">
       <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Editor/css/editor.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Editor/examples/resources/syntax/shCore.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="Editor/examples/resources/demo.css"> -->
    <style type="text/css" class="init">
  </style>
   
  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <!-- DataTables -->
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

 
  <link rel="stylesheet" type="text/css" href="{{asset('css/datepicker.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->

  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom_saccoss.css ') }}">
  
            @yield('css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .sidebar-menu>li.header {color:#FFF !important;}
    .ui-datepicker{ z-index:1151 !important; }
    
  </style>
</head>
<body class="hold-transition skin-blue  sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>TASAF </b>SACCOS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          </li>
       


             
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
               @role('Loan Officer','member')
              <span class="label label-warning">{{$reviewed}}</span>
               @endrole
               @role('Cashier','member')
              <span class="label label-warning">{{$drafted+$submitted+$approved+$approved_vouchers}}</span>
               @endrole

                @role('Chair','member')
              <span class="label label-warning">{{$assessed+$pending_vouchers+$provisioned}}</span>
               @endrole

                 @role('Accountant','member')
              <span class="label label-warning">{{$submitted+$approved+$approved_vouchers}}</span>
               @endrole
            </a>
            <ul class="dropdown-menu">
              @role('Loan Officer','member')
              <li class="header">You have {{$reviewed}} notifications</li>
              @endrole
               @role('Cashier','member')
              <li class="header">You have {{$drafted+$submitted+$approved+$approved_vouchers}} notifications</li>
              @endrole
               @role('Chair','member')
              <li class="header">You have {{$assessed+$pending_vouchers+$provisioned}} notifications</li>
              @endrole

               @role('Accountant','member')
              <li class="header">You have {{$submitted+$approved+$approved_vouchers}} notifications</li>
              @endrole
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @role('Loan Officer','member')
                  <li>
                    <a href="{{url('/processed_loans')}}">
                      <i class="fa fa-users text-aqua"></i>{{$reviewed}} Reviewed Loan(s)
                    </a>
                  </li>
                    @endrole

                     @role('Cashier','member')
                  <li>
                    <a href="{{url('/drafted_loans')}}">
                      <i class="fa fa-users text-aqua"></i> {{$drafted}} Drafted Loans
                    </a>
                  </li>

                  <li>
                    <a href="{{url('/newloans_received')}}">
                      <i class="fa fa-users text-aqua"></i> {{$submitted}} Submitted Loans
                    </a>
                  </li>

                   <li>
                    <a href="{{url('/approved_loans')}}">
                      <i class="fa fa-users text-aqua"></i> {{$approved}} Approved Loans
                    </a>
                  </li>

                   <li>
                    <a href="{{url('/ready_vouchers')}}">
                      <i class="fa fa-users text-aqua"></i> {{$approved_vouchers}} Approved Vouchers
                    </a>
                  </li>
                    @endrole

                    @role('Chair','member')
                  <li>
                    <a href="{{url('/processed_loans')}}">
                      <i class="fa fa-users text-aqua"></i> {{$assessed}} Assessed Loan(s)
                    </a>
                  </li>

                  <li>
                    <a href="{{url('/unpaid_vouchers')}}">
                      <i class="fa fa-users text-aqua"></i> {{$pending_vouchers}} Pending Voucher(s)
                    </a>
                  </li>
                   <li>
                    <a href="{{route('provisioned_loans')}}">
                      <i class="fa fa-users text-aqua"></i> {{$provisioned}} Provisioned Loan(s)
                    </a>
                  </li>
                  @endrole

                  @role('Accountant','member')

                  <li>
                    <a href="{{url('/newloans_received')}}">
                      <i class="fa fa-users text-aqua"></i> {{$submitted}} Submitted Loans
                    </a>
                  </li>

                   <li>
                    <a href="{{url('/approved_loans')}}">
                      <i class="fa fa-users text-aqua"></i> {{$approved}} Approved Loans
                    </a>
                  </li>

                   <li>
                    <a href="{{url('/ready_vouchers')}}">
                      <i class="fa fa-users text-aqua"></i> {{$approved_vouchers}} Approved Vouchers
                    </a>
                  </li>
                    @endrole
                 
                </ul>
              </li>
            </ul>
          </li>

          

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('uploads/profileimages/'.Auth::guard('member')->user()->member_image.'') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::guard('member')->user()->last_name}} @hasrole('Admin|Loan Officer|Accoutant|Cashier|Chair') - @php $useroles=Auth::guard('member')->user()->getRoleNames();   @endphp
                   
                    @php
                 foreach($useroles as $userole){
                   echo $userole;
                 }
                   @endphp
               @endrole</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
            
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
              
                  
                
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->

              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('profile',Auth::guard('member')->user()->member_id)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      @include('layouts.sidenav')
 </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

     
      @yield('dashboard')
      @yield('content')

       @yield('cover')

       @yield('loans')

       @yield('outreceipttemplate')
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
    <strong>Copyright &copy; {{ date('Y') }}  <a href="http://www.mifumotz.com">MIFUMOTZ TECHNOLOGIES</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="check
              x" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
 


    
</body>

<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--added for date restriction-->

  <!--/-->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<!-- Sparkline -->
<script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker 
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>-->
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

   
    <script type="text/javascript" language="javascript" src="{{asset('js/jquery.dataTables.min.js')}}">
    </script>
       <script type="text/javascript" language="javascript" src="{{asset('Editor/js/dataTables.editor.min.js')}}">
    </script>
    <script type="text/javascript" language="javascript" src="{{asset('Editor/examples/resources/syntax/shCore.js')}}">
    </script>
    <script type="text/javascript" language="javascript" src="{{asset('Editor/examples/resources/demo.js')}}">
    </script>
    <script type="text/javascript" language="javascript" src="{{asset('Editor/examples/resources/editor-demo.js')}}">
    </script>
     <script type="text/javascript" language="javascript" src="{{asset('js/select2.min.js')}}">

    </script>
      <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.buttons.min.js')}}">

    </script>
          <script src="{{asset('Editor/js/jszip.min.js')}}"></script>
         <script src="{{asset('Editor/js/pdfmake.min.js')}}"></script>
            <script src="{{asset('Editor/js/vfs_fonts.js')}}"></script>
           <script src="{{asset('js/buttons.print.min.js')}}"></script>
     <script src="{{asset('Editor/js/buttons.html5.min.js')}}"></script>

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js">
    </script>

   <script src="{{ asset('js/confirm/bootstrap.confirm.js') }}"></script>


   <style type="text/css">
            @page { size: auto;  margin-top:5mm;  margin-left:13mm; margin-right:13mm;}
       
          </style>
 
   
  
      <script>

    $(function(){
      window.prettyPrint && prettyPrint();

      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
         minDate: '+1D'
      });
     
      
    $( ".datepicker_curr_next" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
 
      $('#dp2').datepicker();
      $('#dp3').datepicker();

      
      
      var startDate = new Date(2016,1,20);
      var endDate = new Date();
      $('#dp4').datepicker()
        .on('changeDate', function(ev){

          if (ev.date.valueOf() > endDate.valueOf()){
            $('#alert').show().find('strong').text('The start date can not be greater then the end date');
          } else {
            $('#alert').hide();
            startDate = new Date(ev.date);
            $('#startDate').val($('#dp4').data('date'));
          }
          $('#dp4').datepicker('hide');
        });
      $('#dp5').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() < startDate.valueOf()){
            $('#alert').show().find('strong').text('The end date can not be less then the start date');
          } else {
            $('#alert').hide();
            endDate = new Date(ev.date);
            $('#endDate').val($('#dp5').data('date'));
          }
          $('#dp5').datepicker('hide');
        });
        $('.datepicker_modal').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true
 
 });



        $('#example1').DataTable({
      dom: 'Bfrtip',
buttons: [
       
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
             {extend: 'pdfHtml5',
           }
            

             
]

    });

      
    });

        function printingdiv(div) {

                          /*   const table=document.getElementsByTagName('table')[0];
                                  table.id='none'; 
                                  console.log(table.id); */ 
                             var restorepage=document.body.innerHTML;
                             var printContent=document.getElementById(div).innerHTML;
                             document.body.innerHTML=printContent;
                             window.print();
                             document.body.innerHTML=restorepage;
        }
  </script>
  <script type="text/javascript">
$(document).ready(function(){
  $('.profile-list ul li a').click(function(){
    $('li a').removeClass("active");
    $(this).addClass("active");
});
});
  $(document).ready(function(){
    
     //alert(url);
    $('.profile-list a').click(function(){
         var url      = $(this).attr("href");
       
        $(this).addClass("active");
        
    });
  });
   
</script>    
    @yield('js')
   

</html>
