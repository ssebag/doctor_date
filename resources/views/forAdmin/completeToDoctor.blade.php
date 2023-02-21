@extends('layouts.app')
@section('content')
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardAppointmentheader">
       <h1 class="tittle_form">Convert <span style="color: red">{{$user->name}}</span> to Doctor: </h1>
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{route('Complatedoctor.store',$user->id)}}" novalidate>
           @csrf
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="inputState">Department</label>
                <select id="inputState" name="department" class="form-control" required>
                    @foreach (\App\Models\Department::all() as $dep)
                         <option >{{$dep->name}}</option>
                    @endforeach

                </select>
              </div>
              <div class="form-group col-md-6 my-4">
                <div class="custom-file my-2">
                    <input type="file" name="photo" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" for="customFile">Choose photo</label>
                  </div>
                  <div class="invalid-feedback">
                    Please choose a photo.
                  </div>
              </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Details</label>
                        <textarea class="form-control" name="details" id="exampleFormControlTextarea1" rows="3" required></textarea>
                       <div class="invalid-feedback">
                    Please provide a valid details.
                  </div></div>

                </div>
            </div>

              <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom05">Phone2</label>
                    <input type="text" class="form-control" name="phone2" id="validationCustom05" placeholder="Phone2" >
                    <div class="invalid-feedback">
                      Please provide a valid phone.
                    </div>
                  </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="days_from">Working days From</label>
                  <select id="days_from" name="working_days_from" class="form-control" required>
                    @foreach ($days_week as $day)
                         <option >{{$day}}</option>
                    @endforeach
                     </select>
                    <label for="days_to" class="my-2">Working days To</label>
                    <select id="days_to" name="working_days_to" class="form-control " required>
                        @foreach ($days_week as $day)
                        <option >{{$day}}</option>
                       @endforeach
                    </select>
                    <div class="invalid-feedback">
                    Please provide a valid working days.
                  </div>
                </div>
                <div class="col-md-6 mb-3">

                    <label for="hours_from">Working hours From</label>
                     <select id="hours_from" name="working_hours_from" class="form-control" required>
                        @foreach ($hours as $hour)
                            <option >{{$hour}}</option>
                        @endforeach
                    </select>
                    <label for="hours_to" class="my-2">Working hours To</label>
                    <select id="hours_to" name="working_hours_to" class="form-control" required>
                        @foreach ($hours as $hour)
                        <option >{{$hour}}</option>
                    @endforeach
                    </select>
                    <div class="invalid-feedback">
                      Please provide a valid working hours.
                    </div>
                  </div>
              </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                  Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>

          <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';
            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
          </script>
    </div>
   </div>
</div>
@endsection
