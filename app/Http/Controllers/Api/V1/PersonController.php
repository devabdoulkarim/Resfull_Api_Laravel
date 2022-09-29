<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonResourceCollection;
use App\Models\Person;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(): PersonResourceCollection
    {
        return new PersonResourceCollection(Person::paginate());
    }


    public function show(Person $person): PersonResource
    {
        /**  Comment    */
        return new PersonResource($person);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
        ]);

        $person = Person::create($request->all());
        return new PersonResource($person);
    }

    public function update(Person $person, Request $request): PersonResource
    {
        //   dd($request->all());
        $person->update($request->all());

        return new PersonResource($person);
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return response()->json();
    }
}
