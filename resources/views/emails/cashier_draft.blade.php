@component('mail::message')

  <h2><strong>LOAN SUBMISSION</strong><h2>
  	<br>
<p>Dear, {{ucfirst($cashier->first_name)}}  {{ucfirst($cashier->last_name)}}
Be informed that {{ucfirst($loan->member->first_name)}}  {{ucfirst($loan->member->last_name)}} Requested for a loan  on {{ \Carbon\Carbon::parse($loan->requesting_date)->format('d/m/Y')}} of amount {{number_format($loan->principle,2)}} Tsh,approved by guarantor.</p>
   <br>
    <br>
    You may work on the loan by clicking the button below 

@component('mail::button', ['url' =>route('drafted_loans')])
Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }},<br> 
  {{date('d/m/Y')}}   {{date('h:i:s')}}

@endcomponent 
