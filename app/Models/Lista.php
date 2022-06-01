<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Lista extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = '_lista';

    protected $fillable = ['titulo','quadro_id'];

    public static function getLista($id)
    {
        return DB::table('_Lista')->select('*')->whereNull('deleted_at')->where('quadro_id',$id)->get();
        //return $table->select('*')->whereNull('deleted_at')->where('quadro_id',$id)->get();
    }


    public static function getUniqueLista($id)
    {
        return DB::table('_Lista')->select('*')->whereNull('deleted_at')->where('quadro_id',$id)->get();
        //return $table->select('*')->whereNull('deleted_at')->where('quadro_id',$id)->get();
    }
}
