@component('mail::message')

 <h2><strong>GUARANTOR REQUEST</strong><h2>
 	<br>
 <p>Dear, {{ucfirst($member->first_name)}} {{ucfirst($member->first_name)}} {{ucfirst($member->last_name)}} <br />
      Be informed that you are a guarantor to {{ucfirst($loan->member->first_name)}} {{ucfirst($loan->member->last_name)}} {{ucfirst($loan->member->last_name)}} , for the loan of {{number_format($loan->principle,2)}} Requested on {{ \Carbon\Carbon::parse($loan->requesting_date)->format('d/m/Y')}}.</p>

 Please Approve as guarantor  by clicking the button below and fill the required information.
@component('mail::button', ['url' => route('member_guarantor',$member->member_id)])
Click here
@endcomponent

  If the button doesnt work copy and paste the following link in your browser
        @php
            $link=route('member_guarantor',$member->member_id);
        @endphp
             
             Link  <a href="{{$link}}">{{$link}}</a>
             <br>
             <br>

Thanks,<br>
{{ config('app.name') }}, <br>
   {{date('d/m/Y')}}  {{date('h:i:s')}} 

@endcomponent 
