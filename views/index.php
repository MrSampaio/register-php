<?php
// importando conexão com banco de dados
include('../database/connectDB.php');

$errors = [
    'name' => '',
    'email' => '',
    'pswd' => '',
    'pswd-confirm' => '',
];
	
if(isset($_POST['submit'])){

    $name = $mysqli->real_escape_string($_POST['nome']);
    $name = preg_replace('/[^A-Za-zÀ-ÖØ-öø-ÿ]/u', ' ', $name); // remove caracteres numéricos

    $email = $mysqli->real_escape_string($_POST['email']);
    $pswd = $mysqli->real_escape_string($_POST['pswd']);
    $pswdConfirm = $_POST['pswd-confirm'];

    if(strlen($name) <= 2){
        $errors["name"] = 'Insira um nome válido';
    } if(strlen($email) <= 12){
        $errors['email'] = 'Insira um email válido';
    } if(strlen($pswd) <= 2){
        $errors['pswd'] = 'Insira uma senha válida';
    } if($pswdConfirm != $pswd){
        $errors['pswd-confirm'] = 'As senhas não coincidem!';
    } else{
        $select = "SELECT * FROM cad WHERE email = '$email'"; // testando se email já está cadastrado
        $return = mysqli_query($mysqli, $select);

        if(mysqli_num_rows($return) >= 1){
            $errors['email'] = 'Email já cadastrado';
        } else{
            $pswd = base64_encode($pswd); // encriptografando senha antes de inseri-la no banco de dados
            //inserção de dados no banco
            $insert = mysqli_query($mysqli, "INSERT INTO cad(email, senha, nome) VALUES('$email', '$pswd', '$name')");
            mysqli_close($mysqli); // fechando conexão com bando de dados após consulta realizada
            header("Location: login.php"); // redirecionando usuário para página de sucesso
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../public/styleIndex.css">
    <link rel="shortcut icon" href="../assets/logo.ico" type="image/ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    
</head>
<body>
    <section class="boxLeft">
        <form action="" method="post">

            <div class="title">
                <h2>Bem-vindo(a)!</h2>
                <p class="sub">Para se cadastrar, basta preencher os campos.</p>
            </div>
            
            <div class="input-box">
                <label for="nome">Nome<i>*</i></label>
                <span id="icon" class="material-icons">person</span>
                <input maxlength="100" required class="input" name='nome' id="nome" type="text" placeholder="Digite seu nome">
                <span class="error"><?php echo $errors['name']?></span>
            </div>
            
            <div class="input-box">
                <label for="email">Email<i>*</i></label>
                <span id="icon" class="material-icons">mail</span>
                <input maxlength="80" required class="input" name='email' id= 'email' type="email" placeholder="Digite seu email">
                <span class="error"><?php echo $errors['email']?></span>
            </div>
           
            <div class="input-box">
                <label for="pswd">Senha<i>*</i></label>
                <span id="icon" class="material-icons">lock</span>
                <input maxlength="80" required class="input" name='pswd' id="pswd" type="password" placeholder="Digite sua senha">
                <span id="eye-icon" class="eye material-icons">visibility_off</span>
                <span class="error"><?php echo $errors['pswd']?></span>
            </div>
            
            <div class="input-box">
                <label for="pswd-confirm">Confirme sua senha<i>*</i></label>
                <span id="icon" class="material-icons">enhanced_encryption</span>
                <input maxlength="80" required class="input" name='pswd-confirm' id='pswd-confirm pswd' type="password" placeholder="Confirme sua senha">
                <span id="eye-icon" class="eye material-icons">visibility_off</span>
                <span class="error"><?php echo $errors['pswd-confirm']?></span>
            </div>
            
            <div class="button-box">
                <button class="button" name='submit' id='submit' type="submit">Enviar</button>
                <a href="login.php"><p>Já possui cadastro? <span>Entre aqui.</span></p></a>
            </div>
           
        </form>
    </section>

    <section class="boxRight">
        <img src="../assets/sakura-04.jpg" alt="">
    </section>

    <script src="../scripts/icons.js"></script>
</body>
</html>

