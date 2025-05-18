<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\Person\StoreRequest;
use App\Http\Requests\Person\UpdateRequest;
use App\Models\Person;

class UpdatePersonController extends Controller
{
    public function __invoke(UpdateRequest $request, Person $person)
    {
        $data = $request->validated();
        $person->update($data);
        return $data;

    }
}
