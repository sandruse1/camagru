<?php
require_once 'create_db.php';
$src = $_POST['sr'];
$activ = "DELETE FROM `gallery` WHERE img_src = '../gallery/$src'";
$result = $pdo->prepare($activ);
$result->execute();
unlink("../gallery/$src");