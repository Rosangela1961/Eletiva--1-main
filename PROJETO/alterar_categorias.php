<?php
    require_once('cabelho.php');
    require_once('conexao.php');
    $mensagem = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                require_once('conexao.php');
                $nome = $_POST['nome'];
                
                try{
                    $stmt = $pdo->prepare('INSERT INTO categoria (nome) VALUES (?);');
                    if($stmt->execute([$nome])){
                        echo "<p>Cadastro realizado!</p>";

                      }  else {
                        $mensagem "<p>Erro ao cadastrar! Tente novamente</p>";
                    }
                } catch(Exception $e){

                  echo "Erro: ".$e->getMessage();
        $stmt = $pdo->prepare("SELECT * from categoria WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch()

    }catch (Excepction $e){
        echo "Erro: ".$e->getMessage();
    }
?>



<h1>Alterar Categoria</h1>
    <form method="post" action="alterar_categoria.php?id=<?=  $resultado['id'] ?>">
        <div class="mb-3">
              <label for="descricao" class="form-label">Informe a descrição</label>
              <input valur="<?=  $resultado['nome'] ?>"type="text" id="descricao" name="descricao" class="form-control" required="">
              
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </form> 
    <?php
            
                
        echo $mensagem
            
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
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                require_once('conexao.php');
                $nome = $_POST['descricao'];
                $id = $_GET['id'];
                
                try{
                    $sql = "UPDATE categoria SET nome = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    if($stmt->execute([$nome, $id])){
                        echo "<p>Alteração realizada!</p>";

                      }  else {
                        echo "<p>Erro ao alterar! Tente novamente</p>";
                    }
                } catch(Exception $e){

                  echo "Erro: ".$e->getMessage();
                }
        }
            
    ?>
   
<?php
          
    require_once('rodape.php');
?>    