<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\Person\StoreRequest;
use App\Http\Requests\Person\UpdateRequest;
use App\Models\Person;

class DeletePersonController extends Controller
{
    public function __invoke(Person $person)
    {
        $person->delete();
        return response()->json(['status' => 'Пользователь удалён']);
    }
}
