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
       <div class="part1">
        <div class="form-inline">
            <div class="form-group col-md-4">
                <p class="tittle_form">Doctor Name:</p>
                <p class="mx-2"><i><a href="{{route('doctor.show',$doctor->user_id)}}" style="text-decoration: none">{{$doctor->name}}</a></i></p>
            </div>
            <div class="form-group col-md-8">
                <p class="tittle_form">Department :</p>
                <p class="mx-1"><i><a href="{{route('department.doctors',$doctor->depa->name)}}" style="text-decoration: none">{{$doctor->depa->name}}</a></i></p>
            </div>
        </div>
          <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle_form">Details:</p>
                <p class="mx-2"><i>{{$doctor->details}}</i></p>
            </div>
          </div>
          <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle_form">مواعيد دوامه:</p>
                <p class="mx-2"><i>{{$doctor->working_days_from}} - {{$doctor->working_days_to}} / {{$doctor->working_hours_from}} - {{$doctor->working_hours_to}}</i></p>
            </div>
          </div>
          <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle_form">Address:</p>
                <p class="mx-2"><i>{{$doctor->user->address}}</i></p>
            </div>
          </div>
       </div>
       <div class="part2">
        <img src="{{asset('img/'.$doctor->photo)}}" alt="">
       </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('appointment.take.add',$doctor->id)}}">
          @csrf
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gridCheck" name="category[]" value="recheck" required>
                            <label class="form-check-label" for="gridCheck">
                                recheck
                            </label>
                            <br>
                            <input class="form-check-input" type="radio" id="gridCheck2" name="category[]" value="check" required>
                            <label class="form-check-label" for="gridCheck2">
                                check
                            </label>
                            </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="days_to" class="tittle_form">Choose Day:</label>
                       <input type="date" name="day" class="form-control " required>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="datetimeLocal" class="tittle_form">Choose Hours:</label>
                           {{--  <input class="form-control" type="time" name="begin_hour" id="datetimeLocal" >
 --}}
                        <select id="days_to" name="begin_hour" class="form-control " required>
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



