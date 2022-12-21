<x-mail::message>
<h5>Hi`,</h5>
<p>I just wanted to drop you a quick note to let you know that we have received a new booking #{{$body['slot']['booking_id']}} on {{dateformat($body['slot']['booking_date'])}} at {{timeformat($body['slot']['booking_start_time'])}}.</p>
<p>{{$body['slot']['user']['name'] ?? $body['slot']['user_name']}} has booked {{$body['slot']['expert']['name'] ?? 'Expert'}} in <b>INR {{$body['slot']['paid_amount']}}</b> and this slot is from {{timeformat($body['slot']['booking_start_time'])}} to {{timeformat($body['slot']['booking_end_time'])}}.</p>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
