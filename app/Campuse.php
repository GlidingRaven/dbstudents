<?php

namespace App;

use App\Source;
use App\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Campuse extends Model
{
    public $primaryKey = 'code_UZ';    

    public static function getAll()
    {
       return self::all()->sortByDesc('count_students');
    }

    public static function allCounter()
    {
         return ['ofCampuses' => self::count(), 'ofStudents' => self::all()->sum('count_students')];
    }

    public static function getByParentCode($id)
    {
         return self::where('city_code', '=', $id)->get()->sortByDesc('count_students');
    }

    public static function getOneByCode($id)
    {
         return self::where('code_UZ', '=', $id)->firstOrFail();
    }

    public static function getListByCode($id)
    {
         $generalInfo = self::getOneByCode($id);
         $table = Source::getByParentCode($generalInfo['code_UZ']);
         
         $cityInfo = City::getOneByCode($generalInfo['city_code']);

         $counts = 
         [
              'ofSources' => $table->count(), 
              'ofStudents' => $table->sum('count_students'), 
         ];

         return ['generalInfo' => $generalInfo, 'table' => $table, 'counts' => $counts, 'cityInfo' => $cityInfo];
    }

    public static function addOne($post, $cnt)
    {
         return self::insert(
         [
              'city_code' => $post['city_code'], 
              'full_name_UZ' => $post['full_name_uz'], 
              'abb_name_UZ' => $post['abb_name_uz'], 
              'code_UZ' => $cnt, 
              'count_students' => 0, 
              'count_sources' => 0, 
              'url_site' => $post['url_site']
         ]);


    }








}
