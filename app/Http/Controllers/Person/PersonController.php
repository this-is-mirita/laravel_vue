<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;

class PersonController extends Controller
{

    public function __invoke()
    {
        $persons = 1;
//            [
//            [
//                'id' => 1,
//                'name' => 'John',
//                'age' => 18,
//                'job' => 'teacher',
//            ],
//            [
//                'id' => 2,
//                'name' => 'Vika',
//                'age' => 22,
//                'job' => 'teacher',
//            ],
//            [
//                'id' => 3,
//                'name' => 'Sasha',
//                'age' => 30,
//                'job' => 'teacher',
//            ],
//            [
//                'id' => 4,
//                'name' => 'Olya',
//                'age' => 23,
//                'job' => 'teacher',
//            ],
//            [
//                'id' => 5,
//                'name' => 'Dima',
//                'age' => 22,
//                'job' => 'teacher',
//            ],
//        ];

        return $persons;
    }
}
