<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Formulário 3</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h4>Formulário 3</h4>  
  <h4 class="text-center">Sample Form</h4>

  <form>

    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Partner Name</label>
      <div class="col-sm-3">
        <input type="text" class="form-control">
      </div>

      <label class="col-sm-3 col-form-label">Partner Email ID</label>
      <div class="col-sm-3">
        <input type="email" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Partner Legal Name</label>
      <div class="col-sm-3">
        <input type="text" class="form-control">
      </div>

      <label class="col-sm-3 col-form-label">Partner Mobile</label>
      <div class="col-sm-3">
        <input type="text" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Partner Address</label>
      <div class="col-sm-9">
        <textarea class="form-control"></textarea>
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Contract Start Date</label>
      <div class="col-sm-3">
        <input type="date" class="form-control">
      </div>

      <label class="col-sm-3 col-form-label">Contract Expiry Date</label>
      <div class="col-sm-3">
        <input type="date" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Minimum Loan Amount</label>
      <div class="col-sm-3">
        <input type="number" class="form-control">
      </div>

      <label class="col-sm-3 col-form-label">Maximum Loan Amount</label>
      <div class="col-sm-3">
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Interest Rate</label>
      <div class="col-sm-3">
        <input type="number" class="form-control">
      </div>

      <label class="col-sm-3 col-form-label">Deposit Amount</label>
      <div class="col-sm-3">
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="text-center">
      <button class="btn btn-primary">Save</button>
    </div>

  </form>
</div>

</body>
</html>