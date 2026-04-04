<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Formulário 2</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h4>Formulário 2</h4>

  <form>
    <div class="row mb-3">
      <div class="col-md-2">
        <label>Código</label>
        <input type="text" class="form-control" value="32">
      </div>

      <div class="col-md-5">
        <label>Nome</label>
        <input type="text" class="form-control" placeholder="Nome Completo do Cliente">
      </div>

      <div class="col-md-3">
        <label>E-mail</label>
        <input type="email" class="form-control" placeholder="cliente@dominio.com">
      </div>

      <div class="col-md-2">
        <label>CPF</label>
        <input type="text" class="form-control" placeholder="Só números">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-3">
        <label>Nº Celular</label>
        <input type="text" class="form-control">
      </div>

      <div class="col-md-3">
        <label>Nº Telefone fixo</label>
        <input type="text" class="form-control">
      </div>

      <div class="col-md-2">
        <label>CEP</label>
        <input type="text" class="form-control" placeholder="ex: 88308070">
      </div>

      <div class="col-md-3">
        <label>Logradouro</label>
        <input type="text" class="form-control" placeholder="ex: Rua 1400">
      </div>

      <div class="col-md-1">
        <label>Nº</label>
        <input type="text" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-3">
        <label>Bairro</label>
        <input type="text" class="form-control">
      </div>

      <div class="col-md-3">
        <label>Cidade</label>
        <input type="text" class="form-control">
      </div>

      <div class="col-md-2">
        <label>UF</label>
        <input type="text" class="form-control">
      </div>

      <div class="col-md-2">
        <label>Status</label>
        <select class="form-select">
          <option>Selecione</option>
          <option>Ativo</option>
          <option>Inativo</option>
        </select>
      </div>
    </div>

    <button type="reset" class="btn btn-danger">Resetar</button>
    <button type="submit" class="btn btn-success">Próximo</button>
  </form>
</div>

</body>
</html>