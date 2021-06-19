<?php
        
        $conexao = mysqli_connect("*******", "*******", "*********", "*********");
        mysqli_set_charset($conexao, "utf8");

    if (mysqli_connect_errno()) {
        echo "A conexão com o MySql falhou: " . mysqli_connect_error();
        exit();
    }

?>


