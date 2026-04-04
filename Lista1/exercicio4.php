<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Formulário 4</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h4>Formulário 4</h4>
  <h5 class="text-muted mb-4">Novo Usuário</h5>

  <form>
    <div class="row mb-3">
      <div class="col-md-5">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" placeholder="Informe o nome">
      </div>

      <div class="col-md-5">
        <label class="form-label">Endereço</label>
        <input type="text" class="form-control" placeholder="Informe o endereço">
      </div>

      <div class="col-md-2">
        <label class="form-label">Nível</label>
        <select class="form-select">
          <option selected>--</option>
          <option>Admin</option>
          <option>Usuário</option>
        </select>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-5">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control">
      </div>

      <div class="col-md-5">
        <label class="form-label">Senha</label>
        <input type="password" class="form-control" placeholder="Informe a senha">
      </div>

      <div class="col-md-2">
        <label class="form-label">Status</label>
        <select class="form-select">
          <option selected>--</option>
          <option>Ativo</option>
          <option>Inativo</option>
        </select>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-10"> <label class="form-label">Email</label>
        <input type="email" class="form-control">
      </div>
    </div>

    <div class="d-flex justify-content-end gap-2 border-top pt-3">
      <button type="reset" class="btn btn-secondary">Cancelar</button>
      <button type="submit" class="btn btn-success">Enviar</button>
    </div>
  </form>
</div>

</body>
</html>