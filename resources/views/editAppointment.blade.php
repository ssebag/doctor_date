@extends('layouts.app')
@section('content')
@if (session('alert'))
<div class="alert alert-primary"  >
   {{session('alert')}}

</div>
@endif
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardAppointmentheader">
        <div class="">
            <div class="form-inline">
                <div class="form-group col-md-4">
                    <p class="tittle_form">Name:</p>
                    <p class="mx-2"><i>{{$appointment->user->name}}</i></p>
                </div>
                <div class="form-group col-md-4">
                    <p class="tittle_form">Email :</p>
                    <p class="mx-1"><i>{{$appointment->user->email}}</i></p>
                </div>
                <div class="form-group col-md-4">
                    <p class="tittle_form">Phone :</p>
                    <p class="mx-1"><i>{{$appointment->user->phone}}</i></p>
                </div>
            </div>
            <div class="form-inline">
                <div class="form-group col-md-4">
                    <p class="tittle_form">City :</p>
                    <p class="mx-2"><i>{{$appointment->user->city}}</i></p>
                </div>
                <div class="form-group col-md-4">
                    <p class="tittle_form">Address :</p>
                    <p class="mx-1"><i>{{$appointment->user->address}}</i></p>
                </div>

            </div>
           </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('appointment.update',$appointment->id)}}">
          @csrf
          @method('PUT')

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gridCheck" value="recheck" name="category[]" required>
                            <label class="form-check-label" for="gridCheck">
                                recheck
                            </label>
                            <br>
                            <input class="form-check-input" type="radio" id="gridCheck2" value="check" name="category[]"  required>
                            <label class="form-check-label" for="gridCheck2">
                                check
                            </label>
                            </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="days_to" class="tittle_form">Choose Day:</label>
                       <input type="date" value="{{$appointment->day}}" name="day" class="form-control " required>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="datetimeLocal" class="tittle_form">Choose Hours:</label>
                           {{--  <input class="form-control" type="time" name="begin_hour" id="datetimeLocal" >
 --}}
                        <select id="days_to"  name="begin_hour" class="form-control " required>
                            <option>{{$appointment->begin_hour}}</option>
                            @foreach ($hours as $hour)
                            <option >{{$hour}}</option>
                        @endforeach
                        </select>
                            </div>
                    </div>
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
    </div>
   </div>
</div>
@endsection



