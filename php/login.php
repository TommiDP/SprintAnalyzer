<?php
   
    session_start();
    
    $messaggio_errore = "";

    //utente già loggato, mandato direttamente all'area protetta
    if(isset($_SESSION['id_atleta'])) {
        header("Location: area_atleta.php");
        exit();
    }

    if(isset($_POST['login'])){
        require_once "dbaccess.php"; 

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT id, username, password FROM utenti WHERE email = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){
            
            if(password_verify($password, $row['password'])){
                
                $_SESSION['id_atleta'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                
                header("Location: area_atleta.php");
                exit();
            } else {
                $messaggio_errore = "Password errata.";
            }
        } else {
            $messaggio_errore = "Email non trovata.";
        }
        mysqli_stmt_close($stmt);
    }
?>

<!DOCTYPE html>
<html lang='it'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Atleta - SprintAnalyzer</title> 
    <link rel="icon" href="../images/sprintanalyzer.ico" type="image/ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    
    <?php 
    $p = "../"; 
    include "navbar.php"; 
    ?>

    <div id="left">
        <form class="loginform" action="login.php" method="post">
            <h1>SprintAnalyzer</h1>
            <h2>Accesso Atleta</h2>

            <div class="registration-row">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="esempio@mail.com" required>
            </div>

            <div class="registration-row">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>

            <?php if(!empty($messaggio_errore)): ?>
                <div class="alert error">
                    <p><?php echo htmlspecialchars($messaggio_errore, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            <?php endif; ?>

            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'registrato'): ?>
                <p>
                    Registrazione completata! Accedi ora.
                </p>
            <?php endif; ?>

            <input id="registration-btn" type="submit" value="Accedi" name="login">
            
            <p id="already-account">Non hai un account? 
                <a id="sign-in" href="registrazione.php">Registrati qui.</a>
            </p>
        </form>
    </div>
    
</body>
</html>