{{-- @component('mail::message')
# Hi {{ $leave->user->name }},

Your **{{ ucfirst($leave->leave_type) }}** leave request has been **{{ strtoupper($leave->status) }}**.

@component('mail::panel')
**From:** {{ \Carbon\Carbon::parse($leave->from_date)->format('d M, Y') }}  
**To:** {{ \Carbon\Carbon::parse($leave->to_date)->format('d M, Y') }}  
**Reason:** {{ $leave->reason }}
@endcomponent

@isset($leave->remarks)
**Manager's remarks:**  
> {{ $leave->remarks }}
@endisset

@component('mail::button', ['url' => route('userdashboard')])
View your dashboard
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent --}}
