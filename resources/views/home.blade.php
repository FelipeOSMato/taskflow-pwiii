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
                <a href="/" class="active">Dashboard</a>
                <a href="/inserir-tarefa">Nova tarefa</a>
                <a href="/usuario">Usuários</a>
                <a href="/inserir-usuario">Novo usuário</a>
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
                    <a href="/usuario" class="btn-secondary">Usuários</a>
                </div>
            </section>

            <section class="agenda-cards">
                <div class="agenda-card">
                    <span>Total de tarefas</span>
                    <strong>{{ count($tarefas) }}</strong>
                </div>

                <div class="agenda-card">
                    <span>Tarefas pendentes</span>
                    <strong>{{ $tarefas->where('status', 'Pendente')->count() + $tarefas->where('status', 'pendente')->count() }}</strong>
                </div>

                <div class="agenda-card">
                    <span>Tarefas concluídas</span>
                    <strong>{{ $tarefas->where('status', 'Concluída')->count() + $tarefas->where('status', 'concluida')->count() }}</strong>
                </div>
            </section>

            <section class="agenda-panel">
                <div class="panel-top">
                    <div>
                        <h3>Minhas tarefas</h3>
                        <p>Veja todas as tarefas já criadas.</p>
                    </div>

                    <a href="/inserir-tarefa" class="btn-primary small-btn">Adicionar tarefa</a>
                </div>

                <div class="table-wrapper">
                    <table class="agenda-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Projeto</th>
                                <th>Usuário</th>
                                <th>Status</th>
                                <th>Prazo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tarefas as $t)
                                <tr>
                                    <td>#{{ $t->id }}</td>
                                    <td>{{ $t->titulo }}</td>
                                    <td>{{ $t->projeto_nome }}</td>
                                    <td>{{ $t->usuario_nome }}</td>
                                    <td>
                                        <span class="status-badge {{ strtolower($t->status) == 'pendente' ? 'status-pendente' : 'status-concluida' }}">
                                            {{ $t->status }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($t->data_fim)->format('d/m/Y') }}</td>
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