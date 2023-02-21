<form action="{{route('photo.show')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="photo" id="photo" type="file">
    <button type="submit">submit</button>
</form>
