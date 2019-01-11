@component('mail::message')
# Introduction

 Dear, {{ucfirst($member->first_name)}} {{ucfirst($member->first_name)}} {{ucfirst($member->last_name)}} 
      Be informed that you are a guarantor to {{ucfirst($loan->member->first_name)}} {{ucfirst($loan->member->last_name)}} {{ucfirst($loan->member->last_name)}} , for the loan of {{number_format($loan->principle,2)}} Requested on {{ \Carbon\Carbon::parse($loan->requesting_date)->format('d/m/Y')}}
  <br>

 Please Approve as guarantor  by clicking the button below and fill the required information.

@component('mail::button', ['url' => route('member_guarantor',$member->member_id)])
Click here
@endcomponent

  If the button doesnt work copy and paste the following link in your browser
             
             Link  <a href="{{route('member_guarantor',$member->member_id)}}"></a>

Thanks,<br>
{{ config('app.name') }}
  {{date('h:i:s')}} <br> {{date('d/m/Y')}}

@endcomponent 
