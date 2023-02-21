@extends('layouts.app')
@section('content')
@if (session('alert'))
<div class="alert alert-primary"  >
   {{session('alert')}}

</div>
@endif
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardInformationheader">
       <div class="">
        <div class="form-inline">
         <h4>Add status for User <span style="font-weight: bold; color:rgb(15, 15, 119)">{{$appointment->user->name}}</span>:</h4>
       </div>

    </div></div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{route('add.status.post',$appointment->id)}}" novalidate>
            @csrf
             <div class="form-row">
               <div class="col-md-12 mb-3">
                 <label for="validationCustom01">Status:</label>
                 <textarea type="text" name="status" class="form-control" id="validationCustom01" placeholder="status" value="" required></textarea>
                 <div class="valid-feedback">
                   Looks good!
                 </div>
               </div></div>
               <button class="btn btn-primary" type="submit">Submit</button>
            </form>



    </div>
   </div>
</div>
@endsection



