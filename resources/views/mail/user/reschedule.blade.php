<x-mail::message>
<h5>Hi` {{$body['booking']['user']['name']}}</h5>
<p>I just wanted to drop you a quick note to let you know that your booked schedule #{{$body['oldbooking']['booking_id']}} has been reschedule by the {{$body['schedule']}}.</p>
<p>your new reschedule booking is #{{$body['booking']['booking_id']}} on {{date('d M Y',strtotime($body['booking']['booking_date']))}} at {{substr($body['booking']['booking_time'],0,-3)}}.</p><br>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
