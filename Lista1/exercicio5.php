<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Formulário 5</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h4>Formulário 5</h4>
  <h5>Billing address</h5>

  <form>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label>First name</label>
        <input type="text" class="form-control">
      </div>

      <div class="col-md-6 mb-3">
        <label>Last name</label>
        <input type="text" class="form-control">
      </div>
    </div>

    <div class="mb-3">
      <label>Username</label>
      <div class="input-group">
        <span class="input-group-text">@</span>
        <input type="text" class="form-control">
      </div>
    </div>

    <div class="mb-3">
      <label>Email <span class="text-muted">(Optional)</span></label>
      <input type="email" class="form-control" placeholder="you@example.com">
    </div>

    <div class="mb-3">
      <label>Address</label>
      <input type="text" class="form-control" placeholder="1234 Main St">
    </div>

    <div class="mb-3">
      <label>Address 2 <span class="text-muted">(Optional)</span></label>
      <input type="text" class="form-control" placeholder="Apartment or suite">
    </div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <label>Country</label>
        <select class="form-select">
          <option>Choose...</option>
          <option>Brasil</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label>State</label>
        <select class="form-select">
          <option>Choose...</option>
          <option>SP</option>
          <option>RJ</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label>Zip</label>
        <input type="text" class="form-control">
      </div>
    </div>

    
  </form>
</div>

</body>
</html>