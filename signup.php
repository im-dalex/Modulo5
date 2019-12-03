<?php
    require("shared/database.php");

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "insert into users (name, email, password) values (:name, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if($stmt->execute()){
            $message = 'Sucessfully created';
        } else {
            $message = 'Fail';

        }
    }

    include("shared/header.php"); 

?>

    <main class="container text-center p-4">

        <?php if (!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <h1>Registro</h1>
        <span> o <a href="login.php">Login</a></span>

        <div class="container mt-2" style="width: 500px;">
            <form action="signup.php" method="post" >
                    <div class="form-group">
                        <input type="text" name="name" class="form-control p-3" placeholder="Type your Name">
                    </div>
                <div class="form-group">
                        <input type="text" 
                        name="email" class="form-control p-3" placeholder="Enter your Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control p-3" placeholder="Enter your Password">
                    </div>
                
                    <input type="submit" class="btn btn-primary btn-block" value="Send">
            </form>
        </div>
    </main>

<?php include("shared/footer.php"); ?>
