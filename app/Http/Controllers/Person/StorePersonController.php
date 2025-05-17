<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\Person\StoreRequest;
use App\Models\Person;

class StorePersonController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $person = Person::create($data);
        return response()->json($person, 201);

    }
}
