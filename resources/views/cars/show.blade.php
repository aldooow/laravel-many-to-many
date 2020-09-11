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

<h3>Owner details</h3>
<p>
  <b>{{ $car->user->name}}</b>
</p>
<p>
  For contacts: <br>
  <i>{{ $car->user->email}}</i>
</p>
<a href="{{ route('cars.index')}}">go back</a>
