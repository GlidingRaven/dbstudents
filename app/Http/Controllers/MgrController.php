<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Request;
use App\City;
use App\Campuse;
use App\Source;
use App\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MgrController extends Controller
{
    public function index()
    {
        return view('frontend.static.admin');
    }

    public function newcity(Request $request)
    {
        $post = Request::post();

        $cnt = City::all()->count() + 1;
        
        if ( City::addOne($post,$cnt) == true ) 
        {
             return 'Успешно добавлено';
        }

    }


    public function newcampuse(Request $request)
    {
        $post = Request::post();

        $cnt = Campuse::all()->count() + 1;

        if ( Campuse::addOne($post, $cnt) == true ) 
        {
             return 'Успешно добавлено';
        }

    }


    public function newregex(Request $request)
    {
        $post = Request::post();

        $reg = $post['regexper'];

        if (strlen($reg)==0){ echo("Не заполнено");exit(); }
	if (strlen($reg)>512){ echo("Слишком большой");exit(); }

        $regex = "/".$reg ."/u";

	$db = DB::table('data')->where('id', 1)->update(['data' => $regex]);

        echo "200";

    }


    public function newsource(Request $request)
    {
        $post = Request::post();

        $regex = DB::table('data')->where('id', '=', 1)->get();
        $regex = $regex[0]->data;


        echo "Добавлено";

    }







}
