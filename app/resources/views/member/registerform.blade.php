
     @extends('layouts.master')

        @section('title', '| Member Registration')

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
      
      <form method="post" action="{{url('/saveregister')}}" enctype="multipart/form-data">

          {{csrf_field()}}


     <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-12" style="text-align:center;">
              
              <div class="form-group" >
                  <h4><strong>Registration form</strong></h4>
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
              <h3 class="box-title">Personal Info</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                  <label for="">First Name</label>
                  <input type="text" class="form-control"  name="firstname"  placeholder="First Name" value="{{old('firstname')}}" >
                   <small class="text-danger">{{ $errors->first('firstname')}}</small>
              </div>
              <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                  <label for="">Last Name</label>
                  <input type="text" class="form-control"  name="lastname" placeholder="Last Name" value="{{old('lastname')}}">
                   <small class="text-danger">{{ $errors->first('lastname')}}</small>
              </div>
            <!-- </div> -->
            </div>
            <!-- /.col -->

             <div class="col-md-6">
                 <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Middle Name</label>
                  <input type="text" class="form-control"   placeholder="Middle Name" name="middlename" value="{{old('middlename')}}" >
                   <small class="text-danger">{{ $errors->first('middlename')}}</small>
              </div>

              <div class="form-group{{ $errors->has('b_date') ? ' has-error' : '' }}">
                  <label for="">Birth Date</label>
                  <input type="text"  id="b_date" class="form-control dp1 span2"  name="b_date"  value="{{old('b_date')}}" placeholder="yyyy-mm-dd" autocomplete="off">

                    <small class="text-danger">{{ $errors->first('b_date')}}</small>  
              </div> 
             </div>
             <div class="col-md-6">
              <div class="form-group{{ $errors->has('reg_no') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Reg No#</label>
                  <input type="text" class="form-control" placeholder="Registration Number" name="reg_no" value="{{$reg}} "   readonly="true" >
                   <small class="text-danger">{{ $errors->first('reg_no')}}</small>
              </div>

                <div class="form-group{{$errors->has('img') ? ' has-error' : '' }}">

                <label for="">Image Attachment(colored)</label>
               <input name="img" type="file"     value="{{old('img')}}" />
                <small class="text-danger">{{ $errors->first('img') }}</small> 
              </div>

          </div>
          <!-- /.row -->

            <div class="col-md-6">

                     <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                 <label>Gender</label>
                 <br>
                <label for="male">Male</label>
            <input type="radio" name="gender" id="male" value="Male"  {{(old('gender')=='Male') ? 'checked' :''}}>
            <label for="female">Female</label>
            <input type="radio" name="gender" id="female" value="Female" {{(old('gender')=='Female') ? 'checked' :''}}><br>
             <small class="text-danger">{{ $errors->first('gender')}}</small>
              </div>
             </div>
        </div>
            <!-- /.box-body -->
          </div>

        </div>
     <!--terms row-->
     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Particulars</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email"  placeholder="Enter email" value="{{old('email')}}" >
                  <small class="text-danger">{{ $errors->first('email')}}</small>
              </div> 
               <div class="form-group{{ $errors->has('box') ? ' has-error' : '' }}">
                  <label for="">Box No</label>
                  <input type="text" class="form-control"  name="box"  placeholder="Enter Box" value="{{old('box')}}" >
                   <small class="text-danger">{{ $errors->first('box')}}</small>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="">Phone No</label>
                  <input type="number" min=0 class="form-control" name="phone" placeholder="Phone Number" value="{{old('phone')}}">
                  <small class="text-danger">{{ $errors->first('phone')}}</small>
              </div>
            <!-- /.col -->
            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                  <label for="">Street Name</label>
                  <input type="text" class="form-control" name="street" placeholder="Street Name" value="{{old('street')}}">
                   <small class="text-danger">{{ $errors->first('street')}}</small>
              </div>
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
            <div class="row">
                <div class="col-md-6">
            <div class="form-group{{ $errors->has('house') ? ' has-error' : '' }}">
                  <label for="">House No</label>
                  <input type="text" class="form-control"  name="house"  placeholder="House Number" value="{{old('house')}}" >
                   <small class="text-danger">{{ $errors->first('house')}}</small>
              </div>   
            </div>

            </div>
          </div>

      </div>

        <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Relashioships</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                 <label>Marital Status</label>
                 <br>
                <label for="single">Single</label>
  <input type="radio" name="status"  onclick="mstatus();" id="single" value="Single" {{(old('status')=='Single') ? 'checked' :''}}>
  <label for="married">Married</label>
  <input type="radio" name="status"  onclick="mstatus();" id="married" value="Married" {{(old('status')=='Married') ? 'checked' :''}}><br>
              </div>
              <div id="couple" class="form-group" style="visibility:hidden">
                  <label for="">Couple Name</label>
                  <input type="text" class="form-control"   name="couple" placeholder="Couple Name" value="{{old('couple')}}">
              </div> 
              
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <div class="form-group{{ $errors->has('kin_name') ? ' has-error' : '' }}">
                  <label for="">Next of Kin Name</label>
                  <input type="text" class="form-control" name="kin_name" placeholder="Next Kin Name" value="{{old('kin_name')}}">
                   <small class="text-danger">{{ $errors->first('kin_name')}}</small>
              </div>
            <!-- /.col -->
            <div class="form-group{{ $errors->has('kin_relashioship') ? ' has-error' : '' }}">
                  <label for="">Next of Kin Relashioship</label>
                  <input type="text" class="form-control" name="kin_relashioship" placeholder="Next Kin Relashioship" value="{{old('kin_relashioship')}}">
                  <small class="text-danger">{{ $errors->first('kin_relashioship')}}</small>
              </div>
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
  
          </div>

      </div>


       <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Employment Details</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
           <div class="form-group{{ $errors->has('employment_number') ? ' has-error' : '' }}">
                  <label for="">Employment Number</label>
                  <input type="text" class="form-control" name="employment_number" placeholder="Employment Number" value="{{old('employment_number')}}">
                   <small class="text-danger">{{ $errors->first('employment_number')}}</small>
              </div>

               <div class="form-group{{ $errors->has('employment_date') ? ' has-error' : '' }}">
                  <label for="">Employment Date</label>
                  <input type="text"   id="b_date" class="form-control dp1 span2"  name="employment_date" placeholder="Employment Date" value="{{old('employment_date')}}">
                   <small class="text-danger">{{ $errors->first('employment_date')}}</small>
              </div>
              
            </div>
            <!-- /.col -->
          <div class="col-md-6">
          
              <div class="form-group{{ $errors->has('employment_region') ? ' has-error' : '' }}">
                  <label for="">Employment Region</label>
                  <input type="text" class="form-control" name="employment_region" placeholder="Employment Region" value="{{old('employment_region')}}">
                   <small class="text-danger">{{ $errors->first('employment_region')}}</small>
              </div>

              <div class="form-group{{ $errors->has('employment_area') ? ' has-error' : '' }}">
                  <label for="">Employment Area</label>
                  <input type="text" class="form-control" name="employment_area" placeholder="Employment Area" value="{{old('employment_area')}}">
                   <small class="text-danger">{{ $errors->first('employment_area')}}</small>
              </div>
              
            </div>
            </div>
            
          <!-- /.row -->

             <div class="row">
            <div class="col-md-6">
           <div class="form-group{{ $errors->has('employment_type') ? ' has-error' : '' }}">
                  <label for="">Employment Type</label>
                  <select class="form-control select2" name="employment_type">
                    <option value="permanent" id="permanent">Permanent</option>
                    <option value="contract" id="contract">Contract</option>
                  </select>
                  <small class="text-danger">{{ $errors->first('employment_depertment')}}</small>
              </div>

              

               <div class="form-group{{ $errors->has('employment_depertment') ? ' has-error' : '' }}">
                  <label for="">Employment Department</label>
                  <input type="text" class="form-control" name="employment_depertment" placeholder="Employment Department" value="{{old('employment_depertment')}}">
                   <small class="text-danger">{{ $errors->first('employment_depertment')}}</small>
              </div>
              
            </div>
            <!-- /.col -->
          <div class="col-md-6">
          
               <div class="form-group{{ $errors->has('employment_duration') ? ' has-error' : '' }}">
                  <label for="">Employment Duration</label>
                  <input type="text" class="form-control"   id="employment_duration" name="employment_duration" placeholder="Employment Duration" value="{{old('employment_duration')}}">
                   <small class="text-danger">{{ $errors->first('employment_duration')}}</small>
              </div>

              <div class="form-group{{ $errors->has('employment_position') ? ' has-error' : '' }}">
                  <label for="">Employment Position</label>
                  <input type="text" class="form-control" name="employment_position" placeholder="Employment Position" value="{{old('employment_position')}}">
                   <small class="text-danger">{{ $errors->first('employment_position')}}</small>
              </div>
           
            </div>
            </div>

             <div class="row">
            <div class="col-md-6">
           <div class="form-group{{ $errors->has('salary_ranking') ? ' has-error' : '' }}">
                  <label for="">Salary Ranking</label>
                  <select class="form-control select2"  name="salary_ranking">
                    <option value="1A">Level 1 A</option>
                    <option value="1B">Level 1 B</option>
                    <option value="2A">Level 2 A</option>
                    <option value="2B">Level 2 B</option>
                  </select>
              </div>

              

            </div>

            <div class="col-md-6">
               <div class="form-group{{ $errors->has('salary_amount') ? ' has-error' : '' }}">
                  <label for="">Salary Amount</label>
                  <input type="text" class="form-control" name="salary_amount" placeholder="Salary Amount" value="{{old('salary_amount')}}">
                   <small class="text-danger">{{ $errors->first('salary_amount')}}</small>
              </div>
          </div>
        </div>


        </div>
      </div>

         
            <!-- /.box-body -->


           



       <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Bank Info</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
           <div class="form-group{{ $errors->has('bank') ? ' has-error' : '' }}">
                  <label for="">Bank Name</label>
                  <input type="text" class="form-control" name="bank" placeholder="Bank Name" value="{{old('bank')}}">
                   <small class="text-danger">{{ $errors->first('bank')}}</small>
              </div>
              
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}">
                  <label for="">Account No</label>
                  <input type="text" class="form-control" name="account" placeholder="Account No" value="{{old('account')}}">
                  <small class="text-danger">{{ $errors->first('account')}}</small>
              </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
  
          </div>

      </div>



          <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Savings & Shares Info</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
           <div class="form-group{{ $errors->has('saving') ? ' has-error' : '' }}">
                  <label for="">Monthly Savings</label>
                  <input type="number" class="form-control" name="saving" placeholder="Amount saving" value="{{old('saving')}}">
                   <small class="text-danger">{{ $errors->first('saving')}}</small>
              </div>
              
            </div>
            <!-- /.col -->
          <div class="col-md-6">
           <div class="form-group{{ $errors->has('saving') ? ' has-error' : '' }}">
                  <label for="">Shares Amount</label>
                  <input type="number" class="form-control" name="share" placeholder="Amount share" value="{{old('share')}}">
                   <small class="text-danger">{{ $errors->first('share')}}</small>
              </div>
              
            </div>
            
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
  
          </div>


      </div>

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
       @section('js')
      <script type="text/javascript">
        
  $(document).ready(function(){
  $('.dp1').fdatepicker({
    initialDate: '1995-02-06',
    format: 'yyyy-mm-dd',
    disableDblClickSelection: true,
    leftArrow:'<<',
    rightArrow:'>>',
    closeIcon:'X',
    closeButton: true
  });
});  


         function mstatus(){
                         
              if (document.getElementById('married').checked) {
        document.getElementById('couple').style.visibility = 'visible';
    }else{document.getElementById('couple').style.visibility = 'hidden';

           }
        }

           function employmenttype(){

                
          if (document.getElementById('contract').selected) {
        document.getElementById('employment_duration').style.visibility = 'visible';
    }else{document.getElementById('employment_duration').style.visibility = 'hidden';

           }

           }



        

      </script>

      @endsection



