<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Tag;
use App\User;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // metodo statico ::all() prende tutti gli elemnti della tabella
      // $cars = Car::all();

      // L'ordine della tabella inverso:
      // L'ultimo inserito sarà visualizzato come il primo della lista
      $cars = Car::orderBy('created_at', 'desc')->get();

      // dd($cars);
      return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $users = User::all();

        return view('cars.create', compact('tags', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione
        $request->validate($this->validationData());

        $requested_data = $request->all();
        // dd($requested_data);

        // Nuova istanza Car
        $new_car = new Car();
        $new_car->manifacturer = $requested_data['manifacturer'];
        $new_car->year = $requested_data['year'];
        $new_car->engine = $requested_data['engine'];
        $new_car->plate = $requested_data['plate'];
        $new_car->user_id = $requested_data['user_id'];
        $new_car->save();

        if (isset($requested_data['tags'])) {
          $new_car->tags()->sync($requested_data['tags']);
        }

        return redirect()->route('cars.show', $new_car);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
      // dd($car);
      return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        // Per leggere all'interno della pagina edit modelli
        // Tag e User (entrambi rappresentano un array),
        // li metto nelle corispettivi variabili e li inserisco nel compact
        $tags = Tag::all();
        $users = User::all();

        return view('cars.edit', compact('car', 'tags', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        // Validazione
        $request->validate($this->validationData());

        $requested_data = $request->all();
        // dd($requested_data);

        //Versione Estesa del update
        // $car->manifacturer = $requested_data['manifacturer'];
        // $car->year = $requested_data['year'];
        // $car->engine = $requested_data['engine'];
        // $car->plate = $requested_data['plate'];
        // $car->user_id = $requested_data['user_id'];

        // Update dei chekboxes
        if (isset($requested_data['tags'])) {
          $car->tags()->sync($requested_data['tags']);
        } else {
          $car->tags()->detach();
        }

        // $car->update();

        // Versione Abreviata:
        $car->update($requested_data);

        $car->save();

        return redirect()->route('cars.show', $car);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {

        /*
        Per eliminare un auto (car) che ha una realzione many-to-many con Tags
          1.distaccare tags associati all'auto (tabella pivot)
          2.procedere all'elimanzaione dell'auto stessa (car)
        */
        $car->tags()->detach();

        $car->delete();

        return redirect()->route('cars.index');
    }

    public function validationData() {
      return [
        'manifacturer' => 'required|max:255',
        'year' => 'required|integer|min:1960|max:2020',
        'engine' => 'required|max:255',
        'plate' => 'required|max:255',
        'user_id' => 'required|integer',
      ];
    }
}
