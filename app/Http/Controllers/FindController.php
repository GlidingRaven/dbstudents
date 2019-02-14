<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Campuse;
use App\Source;
use App\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindController extends Controller
{

    public function finder(Request $request)
    {
        $ci = 0;

        foreach (['name', 'surname', 'patronymic', 'city', 'vuz', 'specialization', 'from', 'to'] as $value)
        {
             if ( strlen($request[$value]) >= 2) { $ci++; }
        }

        if ($ci == 0) { echo "Ничего не введено"; exit;}



        $searchrules = [];

        $request['city_name'] = $request['city'];

        $request['abb_name_UZ'] = $request['vuz'];


        foreach (['name', 'surname', 'patronymic', 'city_name', 'abb_name_UZ', 'specialization'] as $value)
        {
             if ( strlen($request[$value]) >= 2) 
             {
                  array_push($searchrules, [ $value, '=', $request[$value] ]);
             }
        }

        if ($request['from']) 
        { 
             array_push($searchrules, [ 'sum', '>=', $request['from'] ]); 
        }

        if ($request['to']) 
        { 
             array_push($searchrules, [ 'sum', '<=', $request['to'] ]); 
        }


        //var_dump( $searchrules );

        $done = Student::where($searchrules)->get();
        $cnt = $done->count();
        $fulldata = ['table' => $done, 'cnt' => $cnt];
        return view('frontend._searchlist', $fulldata);

    }



}
