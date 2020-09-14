@extends('layout.app')

@section('content')

  <script src="js/app.js"></script>
  <h1>Cars list</h1>
  <div>
    <a style="display: inline-block; padding: 5px 10px; background-color: blue; color: #fff;" href="{{route('cars.create')}}">Add new car</a>
  </div>
  <br>
  <br>
  @foreach ($cars as $car)
    <div>
      <a href="{{ route('cars.show', $car)}}" ><h3 style="display: inline-block;">{{$car->manifacturer}} {{ $car->engine}}</h3></a><br>
      <a href="{{ route('cars.edit', $car) }}" style="display: inline-block; padding: 5px 10px; background-color: #2fbd2f; color: #fff; font-size: 0.9em;
      text-decoration: none;">edit</a>
      <form class="delete-car-btn" style="display: inline-block;" action="{{route('cars.destroy', $car)}}" method="post">
        @csrf
        @method('DELETE')
        <input  style="display: inline-block; border: none; padding: 6px 10px; margin-left: 10px; background:#ff3b3b; color: #fff;" type="submit" value="delete car">
      </form>
    </div>
    <br>
  @endforeach
  
@endsection
