<?php

namespace App;

use App\City;
use App\Campuse;
use App\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Source extends Model
{
    public $primaryKey = 'code_source';    


    public static function allCounter()
    {
         return ['ofSources' => self::count(), 'ofStudents' => self::all()->sum('count_students')];
    }

    public static function getByParentCode($id)
    {
         return self::where('code_UZ', '=', $id)->get();
    }

    public static function getOneByCode($id)
    {
         return self::where('code_source', '=', $id)->firstOrFail();
    }

    public static function getListByCode($id)
    {
         $generalInfo = self::getOneByCode($id);
         $table = Student::getByParentCode($id);
         $campuseInfo = Campuse::getOneByCode($generalInfo['code_UZ']);
         $cityInfo = City::getOneByCode($campuseInfo['city_code']);

         $count = $table->count();

         return ['generalInfo' => $generalInfo, 'table' => $table, 'count' => $count, 'cityInfo' => $cityInfo, 'campuseInfo' => $campuseInfo];
    }

}
