<?php 

    session_start();
    require("shared/database.php");

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('select * from users where id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results)>0) {
            $user = $results;
        }
    }

    include("shared/header.php"); 
    
    
    
?>


    <div class="text-center">

        <?php if (!empty($user)): ?>
            <br>Welcome. <?= $user['email']?>
            <br>You are logged in
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <h1>Login o Registrarse</h1>

            <a href="login.php">Login</a> or
            <a href="signup.php">Registrarse</a>
        <?php endif; ?>
        
    </div>

<?php include("shared/footer.php"); ?>
