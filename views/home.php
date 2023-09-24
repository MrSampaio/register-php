<?php
// importanto conexão do banco de dados e validação de cpf
include('../database/connectDB.php');
include('../scripts/cpfValidation.php');

// iniciando nova sessão
session_start();

// verificação de página reestrita
if(!isset($_SESSION['logged'])){
    header("Location: login.php");
}

// procura de dados do usuário e implementação de retorno em variável
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM cad WHERE idcad = '$user_id'";
$return = mysqli_query($mysqli, $sql);
$dados = mysqli_fetch_array($return);

$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'password-confirm' => '',
    'age' => '',
    'cpf' => '',
    'phone' => '',
];

if(isset($_POST['save-button'])){

    $name = $mysqli->real_escape_string($_POST['nome']);
    $name = preg_replace('/[^A-Za-zÀ-ÖØ-öø-ÿ]/u', ' ', $name); // remove caracteres numéricos

    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['pswd']);
    $pswdConfirm = $mysqli->real_escape_string($_POST['pswd-confirm']);
    $adress = $mysqli->real_escape_string($_POST['adress']);

    $bairro = $mysqli->real_escape_string($_POST['bairro']);
    $bairro = preg_replace('/[^A-Za-zÀ-ÖØ-öø-ÿ]/u', ' ', $bairro); 

    $city = $mysqli->real_escape_string($_POST['city']);
    $city = preg_replace('/[^A-Za-zÀ-ÖØ-öø-ÿ]/u', ' ', $city); 

    $state = $mysqli->real_escape_string($_POST['state']);
    $state = preg_replace('/[^A-Za-zÀ-ÖØ-öø-ÿ]/u', ' ', $state); 
    
    $phone = $mysqli->real_escape_string($_POST['tel']);
    $phone = preg_replace('/[^0-9]/', '', $phone); // remove caracteres NÃO numéricos

    $cpf = $mysqli->real_escape_string($_POST['CPF']);

    $age = $mysqli->real_escape_string($_POST['age']);
    $age = preg_replace('/[^0-9]/', '', $age);

    $signo = $mysqli->real_escape_string($_POST['signo']);

    if(strlen($name) <= 2){
        $errors['name'] = 'Insira um nome válido';

    } if(strlen($password) <= 2){
        $errors['password'] = 'Insira uma senha válida';

    } if(strlen($email) <= 12){
        $errors['email'] = 'Insira um email válido';
    }
    if($pswdConfirm != $password){
        $errors['password-confirm'] = 'As senhas não coincidem';

    } if(preg_match('/(\d)\1{10}/', $phone)) { // verifica se todos os dígitos são iguais
        $errors['phone'] = 'Insira um telefone válido';

    } if(!cpfValidation($cpf)){
        $errors['cpf'] = 'Insira um CPF válido';
    }
    if($age >= 1 && $age <= 5 || $age >= 100){
        $errors['age'] = 'Insira uma idade válida';

    } else{
        
        $emailSelect = "SELECT email FROM cad WHERE email = '$email'"; // consulta de email no banco de dados
        $emailReturn = mysqli_query($mysqli, $emailSelect);

        if(mysqli_num_rows($emailReturn) == 0 || $dados['email'] == $email){ // verificação de retorno para teste de existência de email
            $password = base64_encode($password); // encriptografando senha

            //inserindo/atualizando dados no banco de dados
            $updateHome = mysqli_query($mysqli, "UPDATE cad SET email = '$email', senha = '$password', nome = '$name', endereco = '$adress', bairro = '$bairro', cidade = '$city', 
            estado = '$state', telefone = '$phone', cpf = '$cpf', idade = '$age', signo = '$signo' WHERE idcad = '$user_id'");
            
            if(!$updateHome){
                die('Erro ao atualizar informações no banco de dados: ' . $mysqli->error);
            } else{
                header('Location: home.php');
            }
        
        } else{
            $errors['email'] = 'Email já cadastrado';
        }

    }
    
}


mysqli_close($mysqli); // fechando conexão com bando de dados após consulta realizada

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Full:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="shortcut icon" href="../assets/logo.ico" type="image/ico">
    <link rel="stylesheet" href="../public/styleHome.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <section class="containerTop">
        <img src="../assets/pexels-kristina-paukshtite-701816.jpg"">
    </section>

    <section class="formBox">

        <div class="title">
            <h2>Bem-vindo(a), <?php echo $dados['nome'] ?>!</h2>
            <p class="sub">Aqui estão suas informações, adicione e altere-as o quanto quiser :)</p>
        </div>
        
        <form action="" method="POST">
            <article class="inputs">
                <div class="input-box">
                    <label for="nome">Nome completo<i>*</i></label>
                    <article class="icon-box first">
                        <span id="icon" class="material-icons">person</span>
                    </article>
                    <input maxlength="100" class='input' disabled value="<?php echo $dados['nome'] ?>" required type="text" name="nome" id="nome" placeholder="Digite seu nome completo">
                    <span class="error-box"><p class="error"><?php echo $errors['name'] ?></p></span>
                </div>
    
                <div class="input-box">
                    <label for="email">Email<i>*</i></label>
                    <article class="icon-box first">
                        <span id="icon" class="material-icons">mail</span>
                    </article>
                    <input maxlength="80" class='input' disabled value="<?php echo $dados['email'] ?>" required type="email" name="email" id="email" placeholder="Digite o email">
                    <span class="error-box"><p class="error"><?php echo $errors['email'] ?></p></span>
                </div>
    
                <div class="input-box">
                    <label for="pswd">Senha<i>*</i></label>
                    <article class="icon-box first">
                        <span id="icon" class="material-icons">lock</span>
                    </article>
                    <input maxlength="80" class='input' disabled value="<?php echo base64_decode($dados['senha'])?>" required type="password" name="pswd" id="pswd" placeholder="Digite sua senha">
                    <span class="eye material-icons" id="eye-icon">visibility_off</span>
                    <span class="error-box"><p class="error"><?php echo $errors['password'] ?></p></span>
                </div>
    
                <div class="input-box">
                    <label for="pswd-confirm">Confirme sua senha<i>*</i></label>
                    <article class="icon-box first">
                        <span id="icon" class="material-icons">enhanced_encryption</span>
                    </article>  
                    <input maxlength="80" class='input' disabled value="<?php echo base64_decode($dados['senha'])?>" type="password" name="pswd-confirm" id="pswd-confirm pswd" placeholder="Confirme sua senha">
                    <span class="eye material-icons" id="eye-icon">visibility_off</span>
                    <span class="error-box"><p class="error"><?php echo $errors['password-confirm'] ?></p></span>
                </div>
    
                <div class="input-box">
                    <label for="adress">Endereço (Rua e Nº)</label>
                    <article class="icon-box">
                        <span id="icon" class="material-icons">home</span>
                    </article>
                    <input maxlength="150" class='input' disabled value="<?php echo $dados['endereco'] ?>" id="adress" name="adress" type="text" placeholder="Digite a rua onde mora">
                </div>
    
                <div class="input-box">
                    <label value="" for="bairro">Bairro</label>
                    <article class="icon-box">
                        <span id="icon" class="material-icons">holiday_village</span>
                    </article>
                    <input maxlength="150"  class='input' disabled value="<?php echo $dados['bairro'] ?>" id="bairro" name="bairro" type="text" placeholder="Digite o bairro onde mora">
                </div>
           
                <div class="input-box">
                    <label for="city">Cidade</label>
                    <article class="icon-box">
                        <span id="icon" class="material-icons">location_city</span>
                    </article>
                    <input maxlength="100" class='input' disabled value="<?php echo $dados['cidade'] ?>" type="text" name="city" id="city" placeholder="Digite sua cidade">
                </div>
    
                <div class="input-box">
                    <label for="state">Estado</label>
                    <article class="icon-box">
                        <span id="icon" class="material-icons">flag</span>
                    </article>
                    <input maxlength="80" disabled value="<?php echo $dados['estado'] ?>" id="state" name="state" class="input" placeholder="Digite seu estado">
                </div>
    
                <div class="input-box">
                    <label for="tel">Telefone</label>
                    <article class="icon-box first">
                        <span id="icon" class="material-icons">call</span>
                    </article>
                    <input maxlength="13" class='input' disabled value="<?php echo $dados['telefone'] ?>" type="tel" name="tel" id="tel" placeholder="Digite seu telefone">
                    <span class="error-box"><p class="error"><?php echo $errors['phone'] ?></p></span>
                </div>
                
                <div class="input-box">
                    <label for="CPF">CPF</label>
                    <article class="icon-box first">
                        <span id="icon" class="material-icons">badge</span>
                    </article>
                    <input maxlength="11" class='input' disabled value="<?php echo $dados['cpf'] ?>" type="text" name="CPF" id="CPF" placeholder="Digite seu CPF">
                    <span class="error-box"><p class="error"><?php echo $errors['cpf'] ?></p></span>
                </div>
    
                <div class="input-box">
                    <label for="age">Idade</label>
                    <article class="icon-box first">
                        <span id="icon" class="material-icons">family_restroom</span>
                    </article>
                    <input maxlength="3" class='input' disabled value="<?php echo $dados['idade'] ?>" type="text" name="age" id="age" placeholder="Digite sua idade">
                    <span class="error-box"><p class="error"><?php echo $errors['age'] ?></p></span>
                </div>
    
                <div class="input-box">
                    <label for="signo">Signo</label>
                    <article class="icon-box">
                        <span id="icon" class="material-icons">calendar_month</span>
                    </article>
                    <input maxlength="20" disabled value="<?php echo $dados['signo'] ?>" name="signo" id="signo" class="input" placeholder="Digite seu signo">
                </div> 
            </article>

            <div class="button-box">
                <button class="button" id='submit-button' type="button">Alterar dados</button>
                <button class="button" hidden id="save-button" name="save-button" type="submit">Salvar Alterações</button>
                <button class="button" hidden id="reload-button" type="reset">Descartar alterações</button>
            </div>

            <div class="button-box">
                <a class="button" id='logout-button' href="../scripts/logout.php"><button type='button'>Sair</button></a>
            </div>

        </form>
    </section>

    <script src="../scripts/home.js"></script>

</body>
</html>
