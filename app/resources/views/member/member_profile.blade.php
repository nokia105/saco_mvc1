 @extends('loans.template')
      @section('memberworkspace')
          @section('title', '| Profile')       

     <div class="box col-md-9 box-primary">
      <div class="container">
       
        <div class="row classic-list-view">
          <div class="col-md-9">
               <ul class="job-category-list">
           <div class="profile_photo center">
            <div class="row">
              <div class="col-md-5 col-offset-5">
                 <h1>{{strtoupper($member->first_name)}} {{strtoupper($member->middle_name)}} {{strtoupper($member->last_name)}}</h1>
              </div>
            </div>

          </div>
            <hr>
            <div class="profile_info">

               <h5>PERSONAL PARTICULARS</h5>
               <ul class="row">

                <li class="col-sm-6">
                  <label><strong>First Name : </strong ><span>{{$member->first_name}}</span></label>
                </li>
                 <li class="col-sm-6">
                  <label><strong>Middle Name :</strong> <span>{{$member->middle_name}}</span></label>
                </li>
                <li class="col-sm-6">
                  <label><strong>Last Name :</strong> <span>{{$member->last_name}}</span></label>
                </li>
                 <li class="col-sm-6">
                  <label><strong>Birth Date :</strong> <span>{{Carbon\carbon::parse($member->birth_date)->format('d/m/Y')}}</span></label>
                </li>
                 <li class="col-sm-6">
                  <label><strong>Member Since : </strong><span> {{Carbon\carbon::parse($member->joining_date)->format('d/m/Y')}}</span></label>
                </li>
                 <li class="col-sm-6">
                  <label><strong>Gender : </strong> <span>{{$member->gender}}</span></label>
                </li>
                <li class="col-sm-6">
                  <label><strong>Email : </strong> <span>{{$member->email}}</span></label>
                </li>
                <li class="col-sm-12">
                  <label><strong><h5>RELASHIONSHIPS</h5></strong></label>
                </li>
                
                <li class="col-sm-6">
                  @if($member->marital_status!=='')
                  <label><strong>Maritial Status: </strong> <span>{{strtoupper($member->marital_status)}}</span></label>
                  @else
                    <label><strong>Maritial Status: </strong><span>NONE</span></label>
                    @endif
                </li>
               
                <li class="col-sm-6">
                     @if($member->couple_names!=='')
                  <label><strong>Spouse Name: </strong> <span>{{$member->couple_names}}</span></label>
                    @else
                    <label><strong>Spouse Name: </strong>NONE</label>
                    @endif
                </li>
              
                <li class="col-sm-6">
                  <label><strong>Nekt kin Name: </strong> <span>{{$member->nextkin_name}}</span></label>
                </li>
               
                <li class="col-sm-6">
                  <label><strong>Nekt kin Relashioship:</strong> <span>{{$member->nextkin_relationship}}</span></label>
                </li>
                  
                    <li class="col-sm-12">
                  <label><strong><h5>ACOUNT INFO</h5></strong></label>
                </li>
                
                <li class="col-sm-6">
                  @if($member->bank_name!=='')
                  <label><strong>Bank Name: </strong> <span>{{strtoupper($member->bank_name)}}</span></label>
                  @else
                    <label><strong>Bank Name: </strong>NONE</label>
                    @endif
                </li>
               
                <li class="col-sm-6">
                     @if($member->account_number!=='')
                  <label><strong>Acc #: </strong> <span>{{$member->account_number}}</span></label>
                    @else
                    <label><strong>Acc #: </strong><span>NONE</span></label>
                    @endif
                </li>

                 <li class="col-sm-12">
                  <label><strong><h5>RESIDENCE</h5></strong></label>
                </li>
                
                <li class="col-sm-6">
                  @if($member->street_name!=='')
                  <label><strong>Street Name: </strong> <span>{{strtoupper($member->street_name)}}</span></label>
                  @else
                    <label><strong>Street Name: </strong><span>NONE</span></label>
                    @endif
                </li>
               
                <li class="col-sm-6">
                     @if($member->house_no!=='')
                  <label><strong>House #: </strong> <span>{{$member->house_no}}</span></label>
                    @else
                    <label><strong>House #: </strong><span>NONE</span></label>
                    @endif
                </li>
              
                <li class="col-sm-6">
                   @if($member->box_number!=='')
                  <label><strong>Box #: </strong><span> {{$member->box_number}}</span></label>
                  @else
                  <label><strong>Box #: </strong><span>NONE</span></label>
                  @endif
                </li>
           
              
               </ul>
                
            </div>
         </ul>
        </div>
      </div>
    </div>

     
      @endsection

      @section('css')
      
         <style type="text/css">
           .profile_photo h1{
    color:#42c8f4;
    font-weight:bold;
    font-size:25px;

}

 .profile_info{
  display:block;
  font-family: 'Rokkitt', serif;
 }
  .profile_info .col-sm-6 {
     padding-left:30px; 
     padding-bottom:20px;   
  }
   .profile_info .col-sm-12{
     
      padding-bottom:20px;
      padding-top:20px;

   }
   .profile_info ul  li{
     list-style: none;
     font-size:15px;
   }

.profile_info h5{
   font-size:18px;
   color:#41a0f4;
   font-weight:bold;
   background-color:#efefef;
   position:relative; 
   z-index:1;
   padding:10px;
   font-family: 'Rokkitt', serif;
}

 .profile_info  .col-sm-12 label strong h5{
      padding-right:400px;
 }
 .profile_info ul label span{
        color:#af41f4;
       font-family: 'Rokkitt', serif;
        font-size:18px; 
 }
     /* vietnamese */
@font-face {
  font-family: 'Rokkitt';
  font-style: normal;
  font-weight:100;
  src: local('Rokkitt Regular'), local('Rokkitt-Regular'), url(https://fonts.gstatic.com/s/rokkitt/v12/qFdE35qfgYFjGy5hkEmCdubL.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Rokkitt';
  font-style: normal;
  font-weight:100;
  src: local('Rokkitt Regular'), local('Rokkitt-Regular'), url(https://fonts.gstatic.com/s/rokkitt/v12/qFdE35qfgYFjGy5hkEiCdubL.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Rokkitt';
  font-style: normal;
  font-weight:100;
  src: local('Rokkitt Regular'), local('Rokkitt-Regular'), url(https://fonts.gstatic.com/s/rokkitt/v12/qFdE35qfgYFjGy5hkEaCdg.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

         </style>
      @endsection


   