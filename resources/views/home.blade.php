<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Agenda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="agenda-layout">
        <aside class="agenda-sidebar">
            <div class="brand-box">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo Minha Agenda">
                <div class="brand-text">
                    <h1>Minha Agenda</h1>
                    <p>Organização do dia a dia</p>
                </div>
            </div>

            <nav class="agenda-nav">
                <a href="/" class="active">Tarefas</a>
                <a href="/usuario">Usuários</a>
                <a href="/projeto">Projetos</a>
            </nav>
        </aside>

        <main class="agenda-main">
            <section class="hero-box">
                <div>
                    <h2>Dashboard da agenda</h2>
                    <p>Acompanhe suas tarefas cadastradas e organize sua rotina.</p>
                </div>

                <div class="top-actions">
                    <a href="/inserir-tarefa" class="btn-primary">Nova tarefa</a>
                </div>
            </section>

            <section class="agenda-cards">
                <div class="agenda-card">
                    <span>Total de tarefas</span>
                    <strong>{{$tarefasTotais}}</strong>
                </div>

                <div class="agenda-card">
                    <span>Tarefas pendentes</span>
                    <strong>{{$tarefasPendentes}}</strong>
                </div>

                <div class="agenda-card">
                    <span>Tarefas concluídas</span>
                    <strong>{{ $tarefasConcluidas}}</strong>
                </div>
            </section>

            <section class="agenda-panel">
                <div class="panel-top">
                    <div>
                        <h3>Minhas tarefas</h3>
                        <p>Veja todas as tarefas já criadas.</p>
                    </div>

                    <div class="form-field">
                        <form method="GET" action="/">
                            <select id="txProjeto" name="txfiltro" onchange="this.form.submit()">
                                <option value="" {{request('txfiltro') == '' ? 'selected' : '' }}>Todas as Tarefas</option>
                                <option value="concluidas" {{request('txfiltro') == 'concluidas' ? 'selected' : '' }}>Tarefas Concluídas</option>
                                <option value="pendentes" {{request('txfiltro') == 'pendentes' ? 'selected' : '' }}>Tarefas Pendentes</option>   
                            </select>
                        </form>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="agenda-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Projeto</th>
                                <th>Usuário</th>
                                <th>Status</th>
                                <th>Prazo</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tarefas as $t)
                                <tr>
                                    <td>{{ $t->titulo }}</td>
                                    <td>{{ $t->projeto_nome }}</td>
                                    <td>{{ $t->usuario_nome }}</td>
                                    <td>
                                        <span class="status-badge {{ strtolower($t->status) == 'pendente' ? 'status-pendente' : 'status-concluida' }}">
                                            {{ $t->status }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($t->data_fim)->format('d/m/Y') }}</td>
                                        @if(strtolower($t->status)=='pendente')
                                        <td>
                                            <form method="POST" action="/concluir-tarefa/{{$t->id}}">
                                                @csrf
                                                @method('PUT')
                                                <input type="submit" value="Concluir" class="btn-primary-concluir">
                                            </form>
                                        </td>               
                                        <td>
                                            <button type="button" class="btn-primary-editar"
                                            data-toggle="modal"
                                            data-target="#modalEditar{{$t->id}}">
                                                Editar
                                            </button>
                                        </td>                         
                                        @else
                                        <td>
                                            <form method="POST" action="/desfazer-tarefa/{{$t->id}}">
                                                @csrf
                                                @method('PUT')
                                                <input type="submit" value="Desfazer" class="btn-primary-desativar">
                                            </form>
                                        </td>
                                        <td>
                                            <input type="button" value="Editar" class="btn-primary-desabilitado" disabled>
                                        </td>
                                        @endif
                                    <td>
                                        <button type="button" class="btn-primary-excluir"
                                        data-toggle='modal'
                                        data-target="#modalexcluir{{$t->id}}">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                                <!--Modal do botão de editar-->
                                <div class="modal fade" id="modalEditar{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar Tarefa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/editar-tarefa/{{$t->id}}" method="post" class="agenda-form">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-field">
                                                    <label for="titulo" class="col-form-label">Titulo:</label>
                                                    <input type="text" id="txNome" name="txNome" placeholder="Digite o título da tarefa" value="{{$t->titulo}}" required class="form-control">
                                                </div>
                                                <div class="form-field">
                                                    <label for="descricao" class="col-form-label">Descrição:</label>
                                                    <textarea id="txDesc" name="txDesc" placeholder="Digite a descrição da tarefa" required class="form-control">{{$t->descricao}}</textarea>
                                                </div>
                                                <div class="form-field">
                                                    <label for="txData">Prazo</label>
                                                    <input type="date" id="txData" name="txData" required value="{{$t->data_fim}}" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn-primary">Salvar tarefa</button>
                                                </div>                                        
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!--Modal do botão de excluir-->
                                <div class="modal fade" id="modalexcluir{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmar Exclusão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Você quer mesmo excluir essa tarefa?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-secondary" data-dismiss="modal">Fechar</button>
                                        <form method="POST" action="/excluir-tarefa/{{$t->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Excluir" class="btn-primary-excluir">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="8">Nenhuma tarefa cadastrada ainda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>