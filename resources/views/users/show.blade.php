@extends('layout.app')

@section('content')
  <h1>Owner details</h1>
  <h2>Name: {{$user->name}}</h2>
  <p>
    Contacts: {{$user->email}}
  </p>

  <h3>Cars owned by this user</h3>
    <ul>
      @foreach ($user->cars as $car)
        <li><a href="{{route('cars.show', $car)}}">{{$car->manifacturer}} </a></li>
      @endforeach
    </ul>
@endsection
