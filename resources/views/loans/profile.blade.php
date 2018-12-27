 @extends('loans.template')
      @section('memberworkspace')
          @section('title', '| Profile')



           

      <div class="box col-md-12 box-primary">

        <!-- /.box-header -->
      
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                
              <h4 style="color:blue">PERSONAL PATICULAR</h4>
               <label>Reg #:  </label>
               <h5>{{$member->registration_no}}</h5>
               <label>Phone : </label>
               <h5>{{$member->phone}}</h5>
               <label>Email :</label>
               <h5> {{$member->email}}</h5>
               <label>Gender :</label>
               <h5>{{$member->gender}}</h5>
               <label>Birth Date : </label>
               <h5>{{$member->birth_date}}</h5>
               <label>Member Since :</label>
               <h5> {{$member->joining_date}}</h5>
            </div>

            <div class="col-md-6">
                
              <h4 style="color:blue">RELATIONSHIP</h4>

               <label>Maritial Status: </label>
               <h5>{{$member->marital_status}}</h5>
                 @if($member->couple_names!=='')
               <label>Spouse Name:</label>
                  <h5>{{$member->couple_names}}</h5>
               @else
               <label>Spouse Name:</label>
               <h5> None</h5>
               @endif

               <label>Nekt kin Name: </label>
                  <h5> {{$member->nextkin_name}}</h5>
               <label>Nekt kin Relashioship: </label>
               <h5>{{$member->nextkin_relationship}}</h5>
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
          <!-- /.row -->
                 <br>
            <div class="row">
            <div class="col-md-6">
                
              <h4 style="color:blue">RESIDENCE</h4>
               <label>Street Name:</label>
               <h5> {{$member->street_name}}</h5>
               <label>House #: </label>
               <h5>{{$member->house_no}}</h5>
               <label>Box #: </label>
               <h5>{{$member->box_number}}</h5>
              
            </div>

            <div class="col-md-6">
                
              <h4 style="color:blue">ACOUNT INFO</h4>
               <label>Bank Name: </label>
              <h5> {{$member->bank_name}}</h5>
               <label>Acc #:</label>
               <h5> {{$member->account_number}}</h5>
               
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
        </div>
        <!-- /.box-body -->
      </div>
     
      @endsection

      @section('css')
      
       <style type="text/css">
       	  h5{
           color:#70a2ef; 
           font-size:15px; 
       	  }


       </style>
      @endsection


   