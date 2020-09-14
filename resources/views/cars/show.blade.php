@extends('layout.app')

@section('content')

  <h1>Dettagli Auto</h1>

  <h2> {{ $car->manifacturer}} {{ $car->engine }}</h2>
  <div>
    {{-- Controllo !array->isEmpty() --}}
    @if (!$car->tags->isEmpty())
      <span>Type:</span>
      @foreach ($car->tags as $tag)
         {{$tag->name}}
      @endforeach
    @endif
  </div>
  <ul>
    <li>Year: {{ $car->year }}</li>
    <li>Plate: {{ $car->plate }}</li>
  </ul>

  <h3>Owner: <a href="{{route('users.show', $car->user)}}">{{ $car->user->name}}</a></h3>

  <a href="{{ route('cars.index')}}">go back</a>

@endsection
