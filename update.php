<?php

require 'banco.php';

$id = null;
if(!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php")
}

if (!empty($_POST)) {

    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    $validacao = true;
    if (empty($nome)){
        $nomeErro = 'Por favor digite o email!';
        $validacao = False;
    } else if (!filter_var($email, FILTER_VALIDATE_EMIAL)){
        $emailErro = 'Por favor digite um email válido!'
        $validacao = false;
    }

    if(empty($endereco)) {
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
    }
 
    if(empty($telefone)) {
        $telefoneErro = 'Por favor digite o telefone!';
        $validacao = false;
    }

    if (empty($sexo)) {
        $sexoErro = 'Por favor preenche o campo!';
        $validacao = false;
    }

    if ($validacao) {
        $pdo = Banco::conectar():
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_aluno where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $nome = $data["nome"];
        $endereco = $data["endereco"];
        $telefone = $data["telefone"];
        $nome = $data["email"];
        $sexo = $data["sexo"];
        Banco::desconectar();
        header("Location: index.php");
    }

} else {
    $pdo = Banco::conectar();
    pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM tb_aluno where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $sexo = $data['sexo'];

    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <title>Atualiza Dados</title>
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well">Atualizar Contato</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" 
                    method="post"> </form>
                    <div class="control-group <?php echo !empty($nomeErro) ? 'error' : ''; ?>"></div>
                    <label class="control-label">Local</label>
                    <div class="controls">
                        <input name="nome" class="form-control" size="50" type="text" placeholder="Nome"
                        value="<?php echo !empty($nome) ? 'error' : ''; ?>">
                        <?php if (!empty($nomeErro)):?>
                        <span class="text_danger"><?php echo $nomeErro; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($sexoErro)? 'error': ''; ?> ">
                        <label class="control-label">Sexo</label>
                        <div class="controls">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" <?php echo ($sexo == "M") ? "checked": null; ?>/>
                                <label class="form-check-label" for="sexo">Masculino</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo" value="F" <?php echo ($sexo == "F") ? "checked": null; ?>/>
                                <label class="form-check-label" for="sexo">Feminino</label>
                            </div>
                            <?php if (!empty($sexoErro)): ?>
                                <span class="text-danger"><?php echo $sexoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br/>

                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7Mb0yxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkOWLaUAdn689aCwoqbBJiSnjAK/18WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>























