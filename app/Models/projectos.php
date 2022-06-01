<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class projectos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'projectos';

    protected $fillable = ['titulo','user_id','visibilidade','status','cor','imagem'];


    

    public static function getAll($id)
    {
        return DB::table('projectos')->select('*')->whereNull('deleted_at')->where('user_id',$id)->get();
    }

    public static function getUnique($id){
        return DB::table('projectos')->select('*')->whereNull('deleted_at')->where('id',$id)->first();
    }
}
