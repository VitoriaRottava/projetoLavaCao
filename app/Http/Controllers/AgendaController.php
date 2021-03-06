<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarAgenda;
use App\Models\Agenda;
use App\Models\Cachorro;
use App\Models\Dono;
use App\Models\Produto;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function listar()
    {
        $objAgenda = Agenda::all();

        return view('agenda/agendas')->with('agendas', $objAgenda);
    }

    public function cadastrar()
        {
            $donos = Dono::all();
            $produtos = Produto::all();
            $funcionarios = Funcionario::all();
            $cachorros = Cachorro::all();


            return view('agenda/agendaCadastrar', compact('donos','produtos','funcionarios', 'cachorros'));
        }

    public function editar($id)
    {
        $agenda  = Agenda::find($id);
        $donos = Dono::all();
        $produtos = Produto::all();
        $funcionarios = Funcionario::all();
        $cachorros = Cachorro::all();

        return view('agenda/agendaEditar', compact('donos', 'agenda', 'produtos', 'funcionarios', 'cachorros'));
    }

    public function deletar($id)
    {
        $agenda  = Agenda::find($id);

        if (empty($agenda)) {
            return "<h2>Erro ao consultar o id informado</h2>";
        }
        $agenda->delete();

        return redirect()->action('App\Http\Controllers\AgendaController@listar');
    }

    public function pesquisar(Request $request)
    {
        $titulo = $request->input('titulo');

        $agendas = Agenda::query()
            ->where('titulo', 'like', '%' . $titulo . '%')
            ->get();

        return view('agenda/agendas')->with('agendas', $agendas);
    }

    public function salvar(SalvarAgenda $request, $id)
    {

        if ($id == 0) {
            $agenda = new Agenda();
            $agenda->titulo = $request->input('titulo');
            $agenda->dia = $request->input('dia');
            $agenda->hora = $request->input('hora');
            $agenda->id_funcionario = $request->input('id_funcionario');
            $agenda->id_cachorro = $request->input('id_cachorro');
            $agenda->id_produto = $request->input('id_produto');
            $agenda->id_dono = $request->input('id_dono');
            $agenda->preco = $request->input('preco');
            $agenda->info = $request->input('info');

            $agenda->save();

            return redirect()->action('App\Http\Controllers\AgendaController@listar');
        } else {
            $agenda = Agenda::find($id);
            $agenda->titulo = $request->input('titulo');
            $agenda->dia = $request->input('dia');
            $agenda->hora = $request->input('hora');
            $agenda->id_funcionario = $request->input('id_funcionario');
            $agenda->id_cachorro = $request->input('id_cachorro');
            $agenda->id_produto = $request->input('id_produto');
            $agenda->id_dono = $request->input('id_dono');
            $agenda->preco = $request->input('preco');
            $agenda->info = $request->input('info');

            $agenda->save();

            return redirect()->action('App\Http\Controllers\AgendaController@listar');
        }
    }
}
