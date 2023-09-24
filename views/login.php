<?php
// importanto conexão do banco de dados
include('../database/connectDB.php');

//iniciando nova sessão
session_start();

//array de erros das validações
 $errors = [
        'email' => '',
        'password' => '',
    ];

// Validação após envio de formulário
if(isset($_POST['submit'])){

    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['pswd']);
    
    // testando preenchimento de inputs
    if(strlen($email) < 12){
        $errors['email'] = 'Insira um email válido'; // adicionando mensagem ao array de erros

    } if(strlen($password) <= 2){
        $errors['password'] = 'Insira uma senha válida';

    } else{
        $select = "SELECT email FROM cad WHERE email = '$email'"; //comando de procura em sql
        $return = mysqli_query($mysqli, $select); // retorno do comando de procura

        if(mysqli_num_rows($return) == 0){ // testando retorno de email
            $errors['email'] = 'O email informado não está cadastrado'; 

        } else{
            $password = base64_encode($password); // encriptografando senha para verificação no banco de dados

            $selectEmail = "SELECT email FROM cad WHERE email = '$email'"; // verificação de email
            $returnEmail = mysqli_query($mysqli, $selectEmail);

            $selectPassword = "SELECT senha FROM cad WHERE senha = '$password'"; // verificação de senha
            $returnPassword = mysqli_query($mysqli, $selectPassword);

            if(mysqli_num_rows($returnEmail) == 0){ // testando retorno de email
                $errors['email'] = 'Usuário inexistente';

            } else if(mysqli_num_rows($returnPassword) == 0){ // testando retorno de senha
                $errors['password'] = 'Senha incorreta';

            } else{ // implementação de dados em variável e entrada de sessão do usuário
                $geralSelect = "SELECT * FROM cad WHERE email = '$email' AND senha = '$password'";
                $geralReturn = mysqli_query($mysqli, $geralSelect);
                $dados = mysqli_fetch_array($geralReturn);
                $_SESSION['logged'] = true;
                $_SESSION['user_id'] = $dados['idcad'];
                mysqli_close($mysqli); // fechando conexão com bando de dados após consulta realizada
                header("Location: home.php");

            }
           
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="../assets/logo.ico" type="image/ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/bbdbe3941a.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/styleLogin.css">
</head>
<body>

    <section class="boxLeft">
        <form action="" method="post">

            <div class="title">
                <h2><i class="fa-solid fa-arrow-right-to-bracket"></i> Faça seu login</h2>
                <p class="sub">Entre com suas informações de cadastro.</p>
            </div>

            <div class="input-box">
                <label for="email">Email<i>*</i></label>
                <span id="icon" class="material-icons">markunread</span>
                <input maxlength="80" required class="input" name='email' id="email" type="text" placeholder="Digite seu email">
                <span class="error"><?php echo $errors['email']?></span>
            </div>
    
            <div class="input-box">
                <label for="password">Senha<i>*</i></label>
                <span id="icon" class="material-icons">lock_person</span>
                <input maxlength="80" required class="input" name='pswd' id="pswd" type="password" placeholder="Digite sua senha">
                <span id="eye-icon" class="eye material-icons">visibility_off</span>
                <span class="error"><?php echo $errors['password']?></span> 
            </div>

            <div class="button-box">
                <button class="button" name='submit' id='submit' type="submit">Entrar</button>
                <a href="index.php"><p>Ainda não possui conta?<span> Cadastre-se aqui.</span></p></a>
            </div>

        </form>
    </section>

    <section class="boxRight">
        <img src="../assets/pexels-marcel-kodama-2179424.jpg" alt="">
    </section>

    <script src="../scripts/loginIcons.js"></script>
</body>
</html>