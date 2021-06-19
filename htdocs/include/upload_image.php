<?php
    $formatosPermitidos = array('png','jpeg', 'jpg', 'gif','jfif');
    $qtdArquivos = count($_FILES['imagem']['name']);
    $contador = 0;

    while($contador < $qtdArquivos):

        $extensao = pathinfo($_FILES['imagem']['name'][$contador],PATHINFO_EXTENSION);
        
        if(in_array($extensao, $formatosPermitidos)):
            $pasta = "../images/";
            $temp = $_FILES['imagem']['tmp_name'][$contador];
            $imagem = uniqid().".$extensao";

            move_uploaded_file($temp, $pasta.$imagem);
        endif;
        $contador++;
    endwhile;
?>