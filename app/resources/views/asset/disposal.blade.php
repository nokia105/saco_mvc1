@extends('layouts.master')
   @section('content')
    
     @section('title', '| Disposal & Depreciation')

  
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

        <div class="container-fluid"> 
       
      <form method="post" action="{{route('post_disposal')}}">
            {{csrf_field()}}
           
           
         <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Disposal</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">

            <div class="form-group  col-md-5">
               <label for="">Asset Name</label>
               <div class="form-group{{ $errors->has('asset') ? ' has-error' : '' }}">
                      <select class="form-control select2 " name="asset" required>
                        <option value="">-----select asset------</option>
                         @foreach($assets as  $asset)
                         <option value="{{$asset->id}}">{{$asset->name}}</option> 
                         @endforeach    
                      </select>
                     <small class="text-danger">{{ $errors->first('asset') }}</small>
              </div>
               </div>

                   <div class="form-group  col-md-5">  
             <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                  <label for="">Amount</label>
                  <input type="number" class="form-control"   name="amount" value="{{old('amount')}}"  >
                   <small class="text-danger">{{ $errors->first('amount') }}</small>
              </div>
          
            </div>
              
            </div>

            <div class="row">

             
            <div class="form-group  col-md-5">
   
             <div class="form-group{{ $errors->has('narration') ? ' has-error' : '' }}">
           <label for="reason">Narration:</label>
            <textarea class="form-control" rows="3"  name="narration" value="{{old('narration')}}"  required="true"  autocomplete="off"></textarea>
         <small class="text-danger">{{ $errors->first('narration') }}</small>
        </div>
            </div>


              <div class="form-group  col-md-5">
              <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                  <label for="">Date</label>
                  <input type="text"  class="form-control dp1 span2"  name="date"  value="{{old('date')}}" placeholder="yyyy-mm-dd" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('date') }}</small>
              </div>
          
            </div>
          </div>
          

        <div class="row">
           <div class="col-md-2">
              
              <div class="form-group">
                   <button   value="Post"  class="form-control btn btn-info pull-left"
                   data-toggle="confirm" 
                   data-title="Warning!" 
                   data-message="The posted amount cannot be edited!. Do you want to post this ? "
                   data-type="info">
                   Post

                   </button>
            </div>
        </div>
            <!-- /.box-body -->
      </div>
    </div>
   
     <!--/end submit -->

          <!-- /.box -->
       
      
       </form>
       </div> 

       
   @endsection

   @section('js')

   <script type="text/javascript">
     
        $(function(){
  $('.dp1').fdatepicker({
   // initialDate: '2018-02-06',
    format: 'yyyy-mm-dd',
    disableDblClickSelection: true,
    leftArrow:'<<',
    rightArrow:'>>',
    closeIcon:'X',
    closeButton: true
  });
}); 
   </script>

   @endsection
