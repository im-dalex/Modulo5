<?php 

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /php-login');
    }

    require("shared/database.php");
    include("shared/header.php"); 

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('select id, email, password from users where email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        $message = '';
        
        if (count($results) > 0 ) {
            $_SESSION['user_id'] = $results['id'];
            header('Location:  /php-login');
        } else {
            $message = 'Sorry, Login Fail';
        }
    }
?>

    <main class="container text-center p-4">
        <h1>Login</h1>
        <span>o <a href="signup.php">Registrarse</a></span>

        <?php if (!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <div class="container mt-2" style="width: 500px;">
            <form action="login.php" method="post" >
                    <div class="form-group">
                        <input type="text" 
                        name="email" class="form-control p-3" placeholder="Enter your Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control p-3" placeholder="Enter your Password">
                    </div>
                    <input type="submit" class="btn btn-outline-primary btn-block" value="Enter">
            </form>
        </div>
    </main>

<?php include("shared/footer.php"); ?>

   