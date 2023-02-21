@extends('layouts.app')
@section('content')
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardAppointmentheader">
       <h1 class="tittle_form">Add New Department: </h1>
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{route('department.store')}}" enctype="multipart/form-data" novalidate >
            @csrf
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationCustom01">Name</label>
                <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Name" value="" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>

            </div>

            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <div class="custom-file my-2">
                        <input type="file" name="photo" class="custom-file-input" id="customFile" required>
                        <label class="custom-file-label" for="customFile">Choose photo</label>
                      </div>
                      <div class="invalid-feedback">
                        Please choose a photo.
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
