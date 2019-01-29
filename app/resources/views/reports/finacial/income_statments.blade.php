 @extends('layouts.master')
 @section('title','Income statement')

      @section('content')


        <div class="error" style="padding-top:50px; text-align:center;">


            @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>
                @endif
            
            @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

        <form method="post" action="{{route('duration_incomestatment')}}">
            {{csrf_field()}}
        
         <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title"><starong>Income statment</starong></h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="form-group  col-md-5">
               <label for="">Select Year</label>
               <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                      <select class="form-control select2 "  id="" name="year" required>
                        <option value="">-----Year------</option>

                          @for ($i = 0; $i < 17; $i++)
                        <option value="{{2012+$i}}">{{2012+$i}}</option>
                          @endfor
                           
                      </select>
                   
                     <small class="text-danger">{{ $errors->first('year') }}</small>
              </div>
               </div>
                <div class="form-group  col-md-5">
               <label for="">Select Period</label>
               <div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
                      <select class="form-control select2" name="period"
                      required>
                        <option value="">----Period------</option>
                         <option value="01-03">January-March</option>
                         <option value="04-06">April-June</option> 
                         <option value="07-09">July-September</option>
                         <option value="10-11">October-December</option>
                         <option value="01-06">January-June</option>
                         <option value="06-12">June-December</option>
                         <option value="01-12">January-December</option>
                              
                      </select>
                   
                     <small class="text-danger">{{ $errors->first('period') }}</small>
              </div>
               </div>
            </div>

          

            <!-- /.box-body -->

             <div class="row">
           <div class="col-md-2">
              
              <div class="form-group">
                 
                  <input type="submit"  value="Find" class="form-control btn btn-info pull-left" >
              </div>
            </div>
        </div>
      </div>
    </div>
   
     <!--/end submit -->

          <!-- /.box -->
       
      
       </form>


      @endsection

     