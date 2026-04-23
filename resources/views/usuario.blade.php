<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários | Minha Agenda</title>
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
                <a href="/">Dashboard</a>
                <a href="/inserir-tarefa">Nova tarefa</a>
                <a href="/usuario" class="active">Usuários</a>
                <a href="/inserir-usuario">Novo usuário</a>
            </nav>
        </aside>

        <main class="agenda-main">
            <section class="hero-box">
                <div>
                    <h2>Usuários</h2>
                    <p>Visualize os usuários cadastrados no sistema.</p>
                </div>

                <div class="top-actions">
                    <a href="/inserir-usuario" class="btn-primary">Novo usuário</a>
                    <a href="/" class="btn-secondary">Voltar</a>
                </div>
            </section>

            <section class="agenda-cards">
                <div class="agenda-card">
                    <span>Total de usuários</span>
                    <strong>{{ count($usuario) }}</strong>
                </div>

                <div class="agenda-card">
                    <span>Status</span>
                    <strong>Ativo</strong>
                </div>

                <div class="agenda-card">
                    <span>Painel</span>
                    <strong>Online</strong>
                </div>
            </section>

            <section class="agenda-panel">
                <div class="panel-top">
                    <div>
                        <h3>Lista de usuários</h3>
                        <p>Gerencie os cadastros existentes.</p>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="agenda-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuario as $u)
                                <tr>
                                    <td>#{{ $u->id }}</td>
                                    <td>{{ $u->nome }}</td>
                                    <td>{{ $u->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum usuário cadastrado ainda.</td>
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