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
                <a href="/">Tarefas</a>
                <a href="/usuario">Usuários</a>
                <a href="/projeto" class="active">Projetos</a>
            </nav>
        </aside>

        <main class="agenda-main">
            <section class="hero-box">
                <div>
                    <h2>Usuários</h2>
                    <p>Visualize os usuários cadastrados no sistema.</p>
                </div>

                <div class="top-actions">
                    <a href="/inserir-projeto" class="btn-primary">Novo Projeto</a>
                </div>
            </section>

            <section class="agenda-cards">
                <div class="agenda-card">
                    <span>Total de Projetos</span>
                    <strong>{{$projetoCount}}</strong>
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
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Nome do Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projeto as $p)
                                <tr>
                                    <td>{{ $p->nome }}</td>
                                    <td>{{ $p->descricao }}</td>
                                    <td>{{ $p->usuario_nome}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum projeto criado ainda.</td>
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