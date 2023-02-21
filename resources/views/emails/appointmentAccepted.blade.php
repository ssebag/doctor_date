@component('mail::message')
# Hello {{$name}}
We have accepted your appointment request with Dr.
<span style="color:rgb(49, 11, 83);font-weight:bolder">{{$doctor}}</span>
 on <span style="color:rgb(49, 11, 83);font-weight: bolder">{{$day}}</span>
  at  <span style="color:rgb(49, 11, 83);font-weight: bolder">{{$hour}}</span>

 please do not be late<br>
get well soon<br>
Thanks,<br>
<span style="color:rgb(49, 11, 83);font-weight: bolder">DR.{{$doctor}}</span>
@endcomponent
