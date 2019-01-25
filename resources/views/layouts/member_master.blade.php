<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SACCOS | Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="{{ asset('fonts/Rokkitt.css') }}" rel="stylesheet">
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
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

           
            @yield('css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('profile',Auth::guard('member')->user()->member_id)}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>SAC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>TASAF </b>SACCOS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <button type="button" class="navbar-toggle collapsed white" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only white">Toggle navigation</span>
        <span class="icon-bar white"></span>
        <span class="icon-bar white"></span>
        <span class="icon-bar white"></span>
      </button>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->

        
          <!-- User Account: style can be found in dropdown.less -->
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
              <!-- Menu Footer-->
              <li class="user-footer">
               
                   @hasanyrole('Admin|Loan Officer|Accoutant|Cashier|Chair')
               
                 

                 <div class="pull-left">
                  <a href="{{route('home')}}" class="btn btn-default btn-flat">System</a>
                </div>
                  @else

                   <div class="pull-left">
                  <a href="{{route('profile',Auth::guard('member')->user()->member_id)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                  
                 @endhasanyrole
                  <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
<!--   <aside class="main-sidebar">
  sidebar: style can be found in sidebar.less
  <section class="sidebar">
   
    search form
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
  
 </aside> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      @yield('member')
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; {{ date('Y') }}  SACCOS</a>.</strong> 
  </footer>


  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
 


    
</body>

<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
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
<!-- datepicker -->
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script type="text/javascript" src="{{asset('js/foundation-datepicker.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

   
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
    </script>
       <script type="text/javascript" language="javascript" src="{{asset('Editor/js/dataTables.editor.min.js')}}">
    </script>
    <script type="text/javascript" language="javascript" src="{{asset('Editor/examples/resources/syntax/shCore.js')}}">
    </script>
    <script type="text/javascript" language="javascript" src="{{asset('Editor/examples/resources/demo.js')}}">
    </script>
    <script type="text/javascript" language="javascript" src="{{asset('Editor/examples/resources/editor-demo.js')}}">
    </script>
      <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.0/js/dataTables.buttons.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js">
    </script>


     <script src="{{ asset('js/custom_script.js') }}"></script> 
    <script src="{{ asset('js/savings_script.js') }}"></script>
    <script src="{{ asset('js/shares_script.js') }}"></script>
    <script src="{{ asset('js/newloan_script.js') }}"></script>
    <script src="{{ asset('js/loancategory_script.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
    $('#example1').DataTable();
} );
      $('.datepicker').datepicker();
    </script>

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
      var endDate = new Date(2016,1,25);
      $('#dp4').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() > endDate.valueOf()){
            $('#alert').show().find('strong').text('The start date can not be greater then the end date');
          } else {
            $('#alert').hide();
            startDate = new Date(ev.date);
            $('#startDate').text($('#dp4').data('date'));
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
            $('#endDate').text($('#dp5').data('date'));
          }
          $('#dp5').datepicker('hide');
        });
    });
  </script>
    
    @yield('js')

</html>
