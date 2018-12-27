
     @extends('layouts.master')

        @section('title', '| Member Registration Excel')

      @section('content')
      
<div class="error" style="padding-top:50px; text-align:center;">


            @if (session('error'))
                    <div class="alert alert-danger" id="flash">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>
                @endif
            
            @if (session('status'))
                    <div class="alert alert-success" id="flash">
                        {{ session('status') }}
                    </div>
                @endif
        </div>
        <div class="container-fluid">
      
      <form method="post" action="{{route('store_reg_excel')}}" enctype="multipart/form-data">

          {{csrf_field()}}


     <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-12" style="text-align:center;">
              
              <div class="form-group" >
                  <h4><strong>Registration Excel</strong></h4>
              </div>
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
       
     <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Registration</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
              <div class="form-group">
                  <label for="">Download Sample Excel</label>
               <a href="{{route('reg_excel')}}"><input  type="button"  class="btn btn-info" value="Download"></a>
       
              </div>

            <!-- </div> -->
            </div>

            <div class="col-md-6">
          
            <div class="form-group{{ $errors->has('excel') ? ' has-error' : '' }}">
                  <label for="">Attach Excel file</label>
               <input name="excel" type="file" multiple    value="{{old('excel')}}" />
                <small class="text-danger">{{ $errors->first('excel') }}</small> 
              </div>
            
            </div>
        </div>
            <!-- /.box-body -->
          </div>

        </div>
     <!--terms row-->
    

        

      <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="Save"   name="submit"  class="form-control btn btn-success pull-left">
              </div>
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

     

     <!--/end submit -->

          <!-- /.box -->
        </div>
      
       </form>
     </div>

      @endsection
       

