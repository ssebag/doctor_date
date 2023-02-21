@extends('layouts.app')

@section('content')
<div class="container">
 <div class="contaner-fluid">
    <h3 class="name_of_dep"><span class="iconify mx-1" data-icon="game-icons:knocked-out-stars"></span>Department <span style="color: rgb(13, 13, 83); font-weight:bold">{{$department_name}}</span>:</h3>
    <div class="doctors">
     @foreach ($doctors as $doctor)
     <div class="card" style="width: 22rem">
        <img class="card-img-top" src="{{asset('img/'.$doctor->photo)}}" alt="Card image cap" height="400rem">
        <div class="card-body">
          <h5 class="card-title">D. <a href="{{route('doctor.show',$doctor->user_id)}}" style="text-decoration: none">{{$doctor->name}}</a></h5>
          <p class="card-text" style="height: 10rem">{{$doctor->details}}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><span class="dostor_details">working days: </span> {{$doctor->working_days_from}} - {{$doctor->working_days_to}}</li>
          <li class="list-group-item"><span class="dostor_details">working hours: </span> {{$doctor->working_hours_from}} - {{$doctor->working_hours_to}}</li>
          <li class="list-group-item"><span class="dostor_details">Mobil:</span> {{$doctor->user->phone}}</li>
          <li class="list-group-item"><span class="dostor_details">Number:</span> {{$doctor->phone2}}</li>
          <li class="list-group-item"><span class="dostor_details">Address:</span> {{$doctor->user->address}} </li>
        </ul>
        <div class="card-body card-link1">
            @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                    <form method="POST" action="{{route('doctor.destroy',$doctor->id)}}" style="display: inline"  >
                        @method('Delete')
                         @csrf
                        <input type="submit" class="btn btn-primary card-link" value="Delete" id="delete"  href="#"  >
                    </form>

                @elseif (Auth::user()->name == $doctor->name)
                        <a href="{{route('doctor.show',Auth::id())}}" class=" btn btn-primary card-link ">View your Profile</a>
                @else
                <a href="{{route('appointment.take',$doctor->name)}}" class=" btn btn-primary card-link ">Press to Take Apontment</a>

                @endif
            @else
                    <a href="{{route('appointment.take',$doctor->name)}}" class=" btn btn-primary card-link ">Press to Take Apontment</a>


           @endif

        </div>
      </div>

     @endforeach

    </div>

 </div>
</div>
@endsection
