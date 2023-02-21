@extends('layouts.app')

@section('content')
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardAppointmentheader">
       <div class="part1">
        <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="mx-2"><i class="profile">D. {{$doctors->name}}</i></p>
            </div>
          </div>

       </div>

    </div>
    <div class="card-body profile-sec">
      <div class="part1">
        <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle-form1">Department:</p>
                @if ($doctors->depa->deleted_at != null)
                <p class="mx-2" ><i class="tittle-form2"><a href="#" style="text-decoration: none; color:red">{{$doctors->depa->name}}</a></i></p>
                @else
                <p class="mx-2" ><i class="tittle-form2"><a href="{{route('department.doctors',$doctors->depa->name)}}" style="text-decoration: none">{{$doctors->depa->name}}</a></i></p>
                @endif

            </div>
        </div>
        <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle-form1">Details:</p>
                <p class="mx-2" ><i class="tittle-form2">{{$doctors->details}}</i></p>
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle-form1">مواعيد دوامه:</p>
                <p class="mx-2" ><i class="tittle-form2">{{$doctors->working_days_from}}-{{$doctors->working_days_to}} / {{$doctors->working_hours_from}}-{{$doctors->working_hours_to}}</i></p>
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle-form1">Address:</p>
                <p class="mx-2" ><i class="tittle-form2">{{$doctors->user->address}}</i></p>
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle-form1">Phone: </p>
                <p class="mx-2" ><i class="tittle-form2">{{$doctors->user->phone}} / {{$doctors->phone2}}</i></p>
            </div>

        </div>
      </div>
        <div class="part2">
                <img src="{{asset('img/'.$doctors->photo)}}" alt="" style="height: 15rem">
                @if (Auth::check())
                        @if (Auth::user()->role == 'admin' || $doctors->user_id == Auth::id())
                        <a href="{{route('doctors.edit',$doctors->user_id)}}" class="btn btn-primary form-group col-md-8 mx-4 my-2">edit</a>
                        @else
                        <a  href="{{route('appointment.take',$doctors->name)}}" class=" btn btn-primary form-group col-md-8 mx-4 my-2 ">Press to Take Apontment</a>
                         @endif
                @else
                    <a  href="{{route('appointment.take',$doctors->name)}}" class=" btn btn-primary form-group col-md-8 mx-4 my-2 ">Press to Take Apontment</a>
                @endif



        </div>
    </div>
   </div>
</div>
@endsection
