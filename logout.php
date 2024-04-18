<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['id_utilisateur'])) {
    session_destroy();
    header("Location: index.php");
exit();
}else{
    ?>
    <script>
        alert("Eureur: <?php echo $conn->error; ?>");
    </script>
    <?php
}

?>
</body>
</html>