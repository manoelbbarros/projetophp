<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    
    <?php
    require 'functions.php';
    $conn = OpenCon();
    session_start();
    $showReactions = true;

    if(isset($_GET['action'])){
        $action = (string) $_GET['action'];
        if($action == 'Sair'){
            session_destroy();
            header("Location: index.php");
        }
    }
    
    if(isset($_SESSION['usuario'])){
        $user = $_SESSION['usuario'];
        
    }
    else{
        header("Location: index.php");
    }
    
    ?>
    <header>
        <div id="user">
            <img src="imagens/<?=$user['foto']?>" alt="<?=$user['foto']?>">
            <p>Bem vindo <?=$user['nome']?> <?=$user['sobrenome']?></p>
        </div>
        <form action="main.php?" method="GET">
            <ul>
                <li class="button">
                    <input type="submit" name="action" value="Sair">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </li>
            </ul>
        </form>
    </header>

    <section>
        <?php
        if(isset($_GET['action']) && (string) $_GET['action'] == 'Comentario'){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $usuario = $user['id'];
                $remetente = $_POST['remetente'];
                $reacao = $_POST['reacao'] ? (int) $_POST['reacao'] : 0;
                $pontos = $_POST['pontos'];
                $descricao = $_POST['descricao'];
                $sql = "INSERT INTO reactions (id,usuario,remetente,reacao,pontos,comentario) VALUES (NULL, '$usuario', '$remetente', '$reacao', '$pontos', '$descricao')";
                
                if ($conn->query($sql) === TRUE) {
                    header("Location: main.php");

                    print_r("Nova reação criada com sucesso!");
                    $error = "";
                } else {
                    $error = "Erro: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        elseif(isset($_GET['action']) && (string) $_GET['action'] != 'Sair'){
            $action = (string) $_GET['action'];
            if($action != 'Sair'){
                $sql = "SELECT id, nome, sobrenome, foto FROM accounts";
                $result = $conn->query($sql);
                if($action != $user['nome'].$user['sobrenome']){
                    while($pessoas = $result->fetch_assoc()){
                        if($action == $pessoas['nome'].$pessoas['sobrenome']){
                            $showReactions = false;
                            break;
                        }
                    }
                }
                
            }
        }
        if($showReactions){
            ?>
            <aside>
                <h1>Reações</h1>
                <div class="grid">
                    <?php
                        $sql = "SELECT matricula, email, nome, sobrenome, foto FROM accounts";
                        $result = $conn->query($sql);
                        
                        if($result->num_rows > 0){
                            $arrayCount = 0;
                            while($pessoas = $result->fetch_assoc()){
                                if($pessoas['matricula'] != $user['matricula'] && $pessoas['email'] != $user['email']){
                                    ?>
                                    <a href="/main.php?action=<?=$pessoas['nome'].$pessoas['sobrenome']?>">  
                                        <img src="imagens/<?=$pessoas['foto']?>" alt="<?=$pessoas['foto']?>">
                                        <p><?=$pessoas['nome']?> <?=$pessoas['sobrenome']?></p>
                                    </a>
                                <?php
                                }
                            }
                        }
                        ?>
                </div>
            </aside>
            <aside>
                <div id="rank" class="rankTable">
                    <div class="top">
                        <h1>Top Reações</h1>
                        <button onclick="Top(this.parentElement)" id="esquerda"></button>
                    </div>
                    <table>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Quantidade de Reações</th>
                        </tr>

                            <?php 
                                $sql = "SELECT remetente, COUNT(*) AS total_score FROM reactions GROUP BY remetente ORDER BY COUNT(*) DESC LIMIT 5";
                                $result = $conn->query($sql);
                                while($pessoas = $result->fetch_assoc()){
                                    $id = $pessoas['remetente'];
                                    $sql = "SELECT nome, sobrenome, foto FROM accounts WHERE id ='$id'";
                                    $pessoa = $conn->query($sql)->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="imagens/<?=$pessoa['foto']?>" alt="<?=$pessoa['foto']?>">
                                            </td>
                                            <td><?=$pessoa['nome'].' '.$pessoa['sobrenome']?></td>
                                            <td><?=$pessoas['total_score']?></td>
                                        </tr>
                                    <?php
                                }
                            
                            ?>
                    </table>
                    
                </div>
                <div id="hide" class="rankTable">
                    <div class="top">
                        <button onclick="Top(this.parentElement)" id="direita"></button>
                        <h1>Top Pontos</h1>
                    </div>
                    <table>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Quantidade de Pontos</th>
                        </tr>
                        <?php 
                                $sql = "SELECT remetente, SUM(pontos) AS total_score FROM reactions GROUP BY remetente ORDER BY SUM(pontos) DESC LIMIT 5";
                                $result = $conn->query($sql);
                                while($pessoas = $result->fetch_assoc()){
                                    $id = $pessoas['remetente'];
                                    $sql = "SELECT nome, sobrenome, foto FROM accounts WHERE id ='$id'";
                                    $pessoa = $conn->query($sql)->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="imagens/<?=$pessoa['foto']?>" alt="<?=$pessoa['foto']?>">
                                            </td>
                                            <td><?=$pessoa['nome'].' '.$pessoa['sobrenome']?></td>
                                            <td><?=$pessoas['total_score']?></td>
                                        </tr>
                                    <?php
                                }
                            
                            ?>
                    </table>
                </div>
            </aside>
        <?php
        }
        else{
            ?>
            <form action="main.php?action=Comentario" method="POST">
                <img src="imagens/<?=$pessoas['foto']?>" alt="<?=$pessoas['foto']?>">
                <p><?=$pessoas['nome']?> <?=$pessoas['sobrenome']?></p>
                <input type="text" name="remetente" value="<?=$pessoas['id']?>" style="display:none;">
                <input id="check" type="checkbox" name="reacao" value=1>
                <label for="check" class="b-c center"></label>
                <div class="pontos">
                    <label>Pontos</label>
                    <input id="pontosValue" type="number" name="pontos" required min=0 max =10 onkeyup="PontosMaxMin(this)">
                </div>
                <div class="descricao">
                    <label>Motivo do Reconhecimento</label>
                    <input type="text" name="descricao" required>
                </div>
                
                <div class="button">
                    <input type="submit" value="Submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="erro">
                    <?=isset($error) ? $error : ""; ?>
                </div>
            </form>
        <?php 
        }
        ?>
    </section>
    <script src="/js/script.js"></script>
</body>
</html>