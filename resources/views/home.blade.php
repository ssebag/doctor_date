@extends('layouts.app')
@section('content')
<div class="carouselll">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://theconsultant1.com/wp-content/uploads/2019/08/%D8%AF%D8%B1%D8%A7%D8%B3%D8%A9-%D8%AC%D8%AF%D9%88%D9%89-%D9%85%D8%AC%D9%85%D8%B9-%D8%B7%D8%A8%D9%8A.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://mybayutcdn.bayut.com/mybayut/wp-content/uploads/sharjah-medical-centers-1-AR25022021-1024x640.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://img.ahlmasrnews.com/728x485/2020/01/907033-1579003057-.jpg" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://admin.andalusiaegypt.com/storage/posts/April2022/98f9220fb50ab5433e19168485001a8609f1bedb.png" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://cdn.altibbi.com/cdn/cache/1000x500/image/2020/12/09/f7f3fa0c631adc19e9881b4a6014cb9d.png.webp" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://mybayutcdn.bayut.com/mybayut/wp-content/uploads/Med-Centers-in-ADAR24062021-3-1024x640.jpg" alt="Third slide">
          </div>

          <div class="carousel-item">
            <img class="d-block w-100" src="https://ascc.om/wp-content/uploads/2019/01/dental.jpg" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://s3-eu-west-1.amazonaws.com/static.jbcgroup.com/amd/pictures/fbeb759e590af53377005625d9e58b1c.jpg" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://ar.tunisienumerique.com/wp-content/uploads/2019/06/medecin_40_1.jpg" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://afdal1.com/wp-content/uploads/2020/06/%D8%AF%D8%B1%D8%A7%D8%B3%D8%A9-%D8%AC%D8%AF%D9%88%D9%89-%D9%85%D8%B4%D8%B1%D9%88%D8%B9-%D9%85%D8%B1%D9%83%D8%B2-%D8%AA%D8%AC%D9%85%D9%8A%D9%84.jpg" alt="Third slide">
          </div>
        </div>
      </div>
</div>
<div class="container-fluid about-us">
<p class="">
    We are a medical center,
    in or center we have many department sush as teeth tretmant, skin tretment ......., it content a lot of doctors from many areas.
    We help people to get information about our department and

</p>
</div>
<div class="container-fluid main_div my-4 mx-3 ">
  @foreach ($departments as $department )
  <div class="card border-primary mb-3" style="max-width: 18rem; height:20rem">
    <img class="card-img-top" src="{{asset('img/'.$department->url)}}" alt="Card image cap" style="height:15rem">
    <div class="card-body">
    <p class="card-text card-text1"><a href="{{route('department.doctors',$department->name)}}" class="home_link">{{$department->name}}</a></p>
    </div>
  </div>
  @endforeach

</div>
@endsection
