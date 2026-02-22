<?php
    
    $errore_duplicato = false;
    $messaggio_errore = "";

    if(isset($_POST['registration']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
        
        require_once "dbaccess.php"; 
        
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        //validazione email
        $regexp_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($regexp_email, $email)) {
            $messaggio_errore = "Formato email non valido.";
        }

        //validazione password (5-15 caratteri, lettere, numeri, $ o @)
        $regexp_pwd = "/^[A-Za-z0-9$@]{5,15}$/";
        if (!preg_match($regexp_pwd, $password)) {
            $messaggio_errore = "La password deve essere tra 5 e 15 caratteri (solo lettere, numeri, $ o @).";
        }

        if(empty($messaggio_errore)) {
            //controllo se email o username esistono già
            $query_check = "SELECT id FROM utenti WHERE email = ? OR username = ?";
            $stmt = mysqli_prepare($connection, $query_check);
            mysqli_stmt_bind_param($stmt, 'ss', $email, $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0){
                $errore_duplicato = true;
                $messaggio_errore = "Email o Username già in uso.";
            } else {
                //nuovo inserimento 
                $query_ins = "INSERT INTO utenti (username, email, password) VALUES (?, ?, ?)";
                $stmt_ins = mysqli_prepare($connection, $query_ins);
                $hash = password_hash($password, PASSWORD_BCRYPT);
                
                mysqli_stmt_bind_param($stmt_ins, 'sss', $username, $email, $hash);
                
                if(mysqli_stmt_execute($stmt_ins)){
                    //andato a buon fine il reg: reindirizza al login
                    header("Location: login.php?msg=registrato");
                    exit();
                } else {
                    $messaggio_errore = "Errore durante la registrazione.";
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
?>

<!DOCTYPE html>
<html lang='it'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Atleta - SprintAnalyzer</title> 
    <link rel="icon" href="../images/sprintanalyzer.ico" type="image/ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    
    <?php 
    $p = "../"; 
    include "navbar.php"; 
    ?>
    
    <div id="left">
        <form class="loginform" action="registrazione.php" method="post">
            <h1>SprintAnalyzer</h1>
            <h2>Registrazione Atleta</h2>

            <div class="registration-row">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Es: bolt95" required>
            </div>

            <div class="registration-row">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="usainbolt@gmail.com" required>
            </div>

            <div class="registration-row">
                <label for="password">Password: <small>(5-15 caratteri, lettere, numeri, $ o @)</small> </label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>

            <?php if(!empty($messaggio_errore)): ?>
                <div class="alert error">
                    <p><?php echo htmlspecialchars($messaggio_errore, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            <?php endif; ?>

            <input id="registration-btn" type="submit" value="Registrati" name="registration">
            
            <p id="already-account">Hai già un account? 
                <a id="sign-in" href="login.php">Accedi qui.</a>
            </p>
        </form>
    </div>

</body>
</html>