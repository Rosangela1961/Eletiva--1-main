<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Universitária</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
    }

    .sidebar {
      height: 100vh;
      background-color: #0d6efd;
      color: white;
      padding: 20px;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .sidebar a:hover {
      background-color: rgba(255,255,255,0.2);
    }

    .content {
      padding: 30px;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <!-- Menu lateral -->
    <div class="col-md-3 col-lg-2 sidebar">
      <h2>Biblioteca</h2>

      <a href="#">Dashboard</a>
      <a href="#">Livros</a>
      <a href="#">Alunos</a>
      <a href="#">Empréstimos</a>
      <a href="#">Relatórios</a>
      <a href="#">Sair</a>
    </div>

    <!-- Conteúdo -->
    <div class="col-md-9 col-lg-10 content">

      <h1 class="mb-4">Cadastro de Livros</h1>

      <div class="card p-4">
        <form>

          <div class="row mb-3">
            <div class="col-md-2">
              <label class="form-label">Código</label>
              <input type="text" class="form-control">
            </div>

            <div class="col-md-10">
              <label class="form-label">Título</label>
              <input type="text" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Editora</label>
              <input type="text" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Ano</label>
              <input type="number" class="form-control">
            </div>

            <div class="col-md-4">
              <label class="form-label">Quantidade</label>
              <input type="number" class="form-control">
            </div>

            <div class="col-md-4">
              <label class="form-label">Categoria</label>
              <input type="text" class="form-control">
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-warning">Editar</button>
            <button type="button" class="btn btn-danger">Excluir</button>
            <button type="button" class="btn btn-secondary">Buscar</button>
          </div>

        </form>
      </div>

      <!-- Tabela -->
      <div class="card p-4 mt-4">
        <h3>Livros Cadastrados</h3>

        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>Código</th>
              <th>Título</th>
              <th>Autor</th>
              <th>Categoria</th>
              <th>Quantidade</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>Banco de Dados</td>
              <td>Carlos Silva</td>
              <td>Tecnologia</td>
              <td>5</td>
            </tr>

            <tr>
              <td>2</td>
              <td>Algoritmos</td>
              <td>João Souza</td>
              <td>Programação</td>
              <td>3</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

</body>
</html>
