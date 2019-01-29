 @extends('layouts.master')
 @section('title','Cash Flow')

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
        <form method="post" action="{{route('find_capital_change')}}">
            {{csrf_field()}}
        
         <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title"><starong>Change In Capital</starong></h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="form-group  col-md-5">
               <label for="">Select Year</label>
               <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                      <select class="form-control select2 "  id="" name="year" required>
                        <option value="">-----Year------</option>

                          @for ($i = 0; $i < 8; $i++)
                        <option value="{{2018+$i}}">{{2018+$i}}</option>
                          @endfor
                           
                      </select>
                   
                     <small class="text-danger">{{ $errors->first('year') }}</small>
              </div>
               </div>
              
            </div>

             <div class="row">
           <div class="col-md-2">
              
              <div class="form-group">
                 
                  <input type="submit"  value="Find" class="form-control btn btn-info pull-left" >
              </div>
            </div>
        </div>
      </div>
    </div>
   
      
       </form>


      @endsection

     