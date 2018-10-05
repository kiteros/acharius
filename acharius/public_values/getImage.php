<?php

$data = base64_decode($_POST['image']);
$id = $_POST['id'];

echo $_POST['image'];
file_put_contents('../account/img/miniature/' .  $id . '.png', $data);

 ?>
