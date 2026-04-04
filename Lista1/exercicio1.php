<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário 1</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Formulário 1</h3>

    <form class="row g-3">

        <!-- First Name -->
        <div class="col-md-4">
            <label class="form-label">First name</label>
            <input type="text" class="form-control" placeholder="Mark">
        </div>

        <!-- Last Name -->
        <div class="col-md-4">
            <label class="form-label">Last name</label>
            <input type="text" class="form-control" placeholder="Otto">
        </div>

        <!-- Username -->
        <div class="col-md-4">
            <label class="form-label">Username</label>
            <div class="input-group">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" placeholder="Username">
            </div>
        </div>

        <!-- City -->
        <div class="col-md-6">
            <label class="form-label">City</label>
            <input type="text" class="form-control" placeholder="City">
        </div>

        <!-- State -->
        <div class="col-md-3">
            <label class="form-label">State</label>
            <input type="text" class="form-control" placeholder="State">
        </div>

        <!-- Zip -->
        <div class="col-md-3">
            <label class="form-label">Zip</label>
            <input type="text" class="form-control" placeholder="Zip">
        </div>

        <!-- Checkbox -->
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">
                    Agree to terms and conditions
                </label>
            </div>
        </div>

        <!-- Botão -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">
                Submit form
            </button>
        </div>

    </form>
</div>

</body>
</html>