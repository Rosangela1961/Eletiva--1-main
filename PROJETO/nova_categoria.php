<?php
    <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                require_once('conexao.php');
                $nome = $_POST['nome'];
                
                try{
                    $stmt = $pdo->prepare('INSERT INTO categoria (nome) VALUES (?);');
                    if($stmt->execute([$nome])){
                        echo "<p>Cadastro realizado!</p>";

                      }  else {
                        echo "<p>Erro ao cadstrar! Tente novamente</p>";
                    }
                } catch(Exception $e){

                  echo "Erro: ".$e->getMessage();
                }
        }
            
    ?>



<h1>Nova Categoria</h1>
    <form method="post">
        <div class="mb-3">
              <label for="descricao" class="form-label">Informe a descrição</label>
              <input type="text" id="descricao" name="descricao" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </form>    
<?php
    require_once('rodape.php');
       