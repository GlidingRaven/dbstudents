<?php

namespace App;

use App\Campuse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class City extends Model
{
    protected $table = "fatherland";

    public $primaryKey = 'city_code';  
  



    public static function getAll()
    {
         return self::all()->sortByDesc('count_students');
    }


    public static function allCounter()
    {
         return ['ofCitys' => self::count(), 'ofStudents' => self::all()->sum('count_students')];
    }

    public static function getOneByCode($id)
    {
         return self::where('city_code', '=', $id)->firstOrFail();
    }

    public static function getListByCode($id)
    {
         $generalInfo = self::getOneByCode($id);
         $table = Campuse::getByParentCode($generalInfo['city_code']);
         $counts = ['ofCampuses' => $table->count(), 'ofStudents' => $table->sum('count_students')];

         return ['generalInfo' => $generalInfo, 'table' => $table, 'counts' => $counts];
    }

    public static function addOne($post, $id)
    {
         return self::insert(['city_name' => $post['city'], 'city_code' => $id, 'count_UZ' => 0, 'count_students' => 0]);
    }


}
