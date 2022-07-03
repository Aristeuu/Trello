<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\projectos;
use App\Models\Lista;
use App\Models\Quadro_membros;
use Auth;
use Inertia\Inertia;
use App\Notifications\Addproject;

class ProjectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $user_id =  Auth::user()->id;
        $quadros = projectos::getAll($user_id);
        $quadros_membros = Quadro_membros::ListarQuadros($user_id);

        //dd($quadros_membros);
        return Inertia::render('Dashboard',[
            'quadros' => $quadros,
            'quadro_membros' => $quadros_membros
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',            
        ]);
        
        //dd('var_dump');
        $user_id = Auth::user()->id;
        $visibilidade = 'publico';
        $status = '1';

        $dados = ([
            'titulo' => $request->titulo,
            'user_id' => $user_id,
            'visibilidade' => $visibilidade,
            'status' => $status,
        ]);
           //dd($dados);
         $id_project = projectos::create($dados)->id;
            $lista = ([
                'titulo' => 'Por executar',
                'quadro_id' => $id_project,
            ]);

            $lista_1 = ([
                'titulo' => 'A executar',
                'quadro_id' => $id_project,
            ]);

            $lista_2 = ([
                'titulo' => 'Em Pausa',
                'quadro_id' => $id_project,
            ]);

            $lista_3 = ([
                'titulo' => 'Concluído',
                'quadro_id' => $id_project,
            ]);

            Lista::create($lista);
            Lista::create($lista_1);
            Lista::create($lista_2);
            Lista::create($lista_3);

            $user->notify(new Addproject($invoice));
         
        //return redirect('/');
        
        $quadros = projectos::getAll($user_id);

        //dd($quadros);
        return Inertia::render('Dashboard',[
            'quadros' => $quadros
        ]);
        
        


    }
    public function AdicionarMembro(Request $request)
    {
        /*$request->validate([
            'id_membro' => 'required|string|max:255',  
                      
        ]);*/
                
            
        $id_project = $request->quadro_id;
        $id_membro = $request->id_membro;
        $id_user   = Auth::user()->id;
        
            $dados = ([
                'id_quadro' => $id_project,
                'id_membro' => $id_membro,
                'id_owner'  => $id_user
            ]);

            Quadro_membros::create($dados);

        $data = projectos::getUnique($id_project);
        $boards = Lista::getLista($id_project);
        
      
        return redirect()->route('board',$id_project);
       


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = projectos::getUnique($id);
       

        $project_id = $data->id;
       
        $boards = Lista::getLista($data->id);
       
        $auth = Auth()->user()->id;
       
        $membros = User::membros($auth);

        //dd($membros);



        return Inertia::render('Board',[
            'quadro' => $data,
            'listas' => $boards,
            'quadro_id' =>$project_id,
            'membros'  => $membros,
            'user_id'  => $auth
        ]);
        //return redirect()->route('board',$id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
