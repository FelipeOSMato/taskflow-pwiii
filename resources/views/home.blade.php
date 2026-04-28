<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Agenda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                                <option value="concluidas" {{request('txfiltro') == 'concluidas' ? 'selected' : '' }}>Tarefas concluídas</option>
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
                                    <td>
                                        @if(strtolower($t->status)=='pendente')
                                            <form method="POST" action="/concluir-tarefa/{{$t->id}}">
                                                @csrf
                                                @method('PUT')
                                                <input type="submit" value="Concluir" class="btn-primary-concluir">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Nenhuma tarefa cadastrada ainda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>