<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Quadro_membros extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'quadro_membros';

    protected $fillable = ['id_quadro','id_membro','id_owner'];


    public static function ListarQuadros($id)
    {
        return DB::table('quadro_membros')->select('quadro_membros.id_quadro','quadro_membros.id_membro','quadro_membros.id_owner','projectos.id',
                                                   'projectos.user_id','projectos.titulo')
                                         ->join('projectos','projectos.id','=', 'quadro_membros.id_quadro')
                                         ->whereNUll('quadro_membros.deleted_at')
                                         ->where('quadro_membros.id_membro',$id)
                                         ->get();
    }
}
