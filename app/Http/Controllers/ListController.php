<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Campuse;
use App\Source;
use App\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListController extends Controller
{
    public function index()
    {
        return view('frontend.static.index');
    }

    public function faq()
    {
        return view('frontend.static.faq');
    }

    public function site()
    {
        return view('frontend.static.site');
    }


    public function citys()
    {
        $viewData = 
        [
            'table' => City::getAll(), 
            'counts' => City::allCounter(),
        ];

        return view('frontend.cityslist', $viewData);
    }


    public function campuses()
    {
        $viewData = 
        [
            'table' => Campuse::getAll(), 
            'counts' => Campuse::allCounter(),
        ];

        return view('frontend.campuseslist', $viewData);
    }


    public function city($id)
    {
        return view('frontend.onecitylist', City::getListByCode($id));
    }

    public function campuse($id)
    {
        return view('frontend.onecampuselist', Campuse::getListByCode($id));
    }

    public function order($id)
    {
        return view('frontend.onesourcelist', Source::getListByCode($id));
    }



}
