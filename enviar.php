<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}else{
    $dia = $_POST['dia'];
    $anotacao = $_POST['anotacao'];
    
    $sql = "INSERT INTO anotacoes (dia, anotacao) 
                VALUES ('$dia', '$anotacao')";
    
        $resultado = $conexao->query($sql);
                    
        $conexao -> close();
        header('Location: index.php', true, 301);
}
    ?>