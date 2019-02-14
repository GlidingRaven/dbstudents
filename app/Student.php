<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Student extends Model
{
    public $primaryKey = 'ID';    


    public static function allCounter()
    {
         return ['ofSources' => self::count(), 'ofStudents' => self::all()->sum('count_students')];
    }

    public static function getByParentCode($id)
    {
         $data = self::where('code_source', '=', $id)->get();
         if ($data->count() == 0) {abort(404);} else {return $data;}
    }

    public static function getOneByCode($id)
    {
         return self::where('ID', '=', $id)->firstOrFail();
    }


}
