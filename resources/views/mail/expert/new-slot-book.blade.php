<x-mail::message>
<h5>Hi` {{$body['slot']['expert']['name'] ?? 'Expert'}},</h5>
<p>I just wanted to drop you a quick note to let you know that you have received a new booking #{{$body['slot']['booking_id']}}.</p>
<p>Customer is {{$body['slot']['user_name'] ?? $body['slot']['user']['name']}} & booking date and slot is {{dateformat($body['slot']['booking_date'])}} at {{timeformat($body['slot']['booking_start_time'])}}</p>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
