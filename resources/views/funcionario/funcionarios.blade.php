@extends('layouts.app')

@section('title', 'Listagem de Funcionários')

@section('sidebar')
@parent

@endsection

<body>
    @section('content')
    <br><br> <br><br><br>

    <form action="{{ action('App\Http\Controllers\FuncionarioController@pesquisar')}}" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <div class="form-row">
            <div class="col-4">
                <input type="text" class="form-control" placeholder="Digite o nome que deseja buscar" name="nome" id="">
            </div>
            <div class="col-8">
                <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar</button>
                    <a href="{{ url('/funcionario/cadastrar') }}" class="btn btn-success"> <i class="fas fa-plus-circle"></i> Cadastrar Funcionário</a>
            </div></div>
    </form><br>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Salário</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($funcionarios as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->nome}}</td>
            <td>{{$item->cpf}}</td>
            <td>{{$item->salario}}</td>
            <td><a href='tel:"{{$item->telefone}}"'>{{$item->telefone}}</a></td>
            <td><a href='mailto:"{{$item->email}}"'>{{$item->email}}</a></td>

            <td><a href="{{ action('App\Http\Controllers\FuncionarioController@editar',$item->id )}}" style='color:orange;' ><i class='fas fa-edit'></i>   Editar</a> </td>
            <td><a href="{{ action('App\Http\Controllers\FuncionarioController@deletar',$item->id )}}"style='color:red;'><i class='fas fa-trash'></i>   Deletar</a> </td>
 </tr>

        @endforeach

    </table>
    </div>
    @endsection

