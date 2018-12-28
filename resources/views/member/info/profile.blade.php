@extends('member.member_template')
@section('memberinfo')

 @section('title', '|Profile')

 
  
<div class="col-md-12">

     <style type="text/css">
          h5{
           color:#70a2ef; 
           font-size:14px;
          }


       </style>
  
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Update Info</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body">
          <div class="row">
            <!-- /.col -->

            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
               <form action="{{route('picture_update',$member->member_id)}}" method="post" enctype="multipart/form-data">

           <div class="form-group{{$errors->has('file') ? ' has-error' : '' }}">

                   {{ csrf_field() }}

                <label for="file">Profile picture</label>
               <input name="file" type="file"  />
                <small class="text-danger">{{ $errors->first('file') }}</small> 
              </div>

              <div class="form-group col-md-6">
                  <label for=""></label>
                  <input type="submit"  value="Upload"   name="submit"  class="form-control btn btn-success">
              </div>
            </form>
        
            <!-- </div> -->
            </div>
            <!-- /.col -->

             <div class="col-md-6">
                
                  <label for="exampleInputEmail1">Password:</label>
         
                 <button class="btn btn-info" onclick="showAjaxModal('{{route('password_modal',$member->member_id)}}')">change password</button>
                
              </div>

             </div>
            
        </div>
            <!-- /.box-body -->
          </div>
         
        </div>
   


 
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
                
              <h4 style="color:blue">ACCOUNT INFO</h4>
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

 
      @include('modal.popup_lib')
    
     
      @endsection
