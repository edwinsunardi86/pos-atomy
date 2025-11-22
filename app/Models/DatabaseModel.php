<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DatabaseModel extends Model
{
    use HasFactory;

    static function getData($table,$arr_where=null,$arr_where_not=null,$arr_select=null,$rawSelect=null){
        $query = DB::table($table);
        if($arr_where){
                $query->where($arr_where);
        }
        
        if($arr_where_not){
            $query = $query->whereNot(function($query) use($arr_where_not) {
                $query->where($arr_where_not);
            });
        }
        if($arr_select){
            $query = $query->select($arr_select);
        }

        if($rawSelect){
            $query = $query->select(DB::Raw($rawSelect));
        }
        return $query;
    }

    static function insertData($table,$post){
        return DB::table($table)->insert($post);
    }

    static function getMaxIdHeader($table){
        $query = DB::table($table)
        ->select(DB::Raw("MAX(id_header) AS id_header"));
        return $query->first();
    }

    static function updateData($table,$post,$field_name,$id){
        $query = DB::table($table)->where($field_name,$id)->update($post);
        return $query;
    }

    static function deleteData($table,$field_name,$id){
        $query = DB::table($table)->where($field_name,$id)->delete();
        return $query;
    }
}
