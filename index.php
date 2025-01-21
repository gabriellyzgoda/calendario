<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario";

$conexao = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM anotacoes";
$resultado = $conexao->query($sql);

$anotacoes = [];
while ($row = $resultado->fetch_assoc()) {
    $anotacoes[$row['dia']] = $row['anotacao'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <title>Calendário</title>
</head>
<body>
    <div class="titulo">
        <div class="dias">
            <span>Domingo</span>
            <span>Segunda</span>
            <span>Terça</span>
            <span>Quarta</span>
            <span>Quinta</span>
            <span>Sexta</span>
            <span>Sábado</span>
        </div>
        <div class="numero" id="numero">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    
    <div class="overlay" id="overlay"></div>

    <div id="form-container">
        <button class="close-btn" id="close-form">×</button>
        <form method="POST" action="enviar.php">
            <input type="hidden" id="dia" name="dia">
            <label for="name">Faça uma anotação:</label>
            <input type="text" id="anotacao" name="anotacao" placeholder="Digite aqui">
            <button class="submit" type="submit">Enviar</button>
        </form>
    </div>

    <script>
        const anotacoes = <?php echo json_encode($anotacoes); ?>;

        let el = document.querySelector('#numero');
        
        for (let i = 1; i <= 31; i++) {
            let anotacao = '';
            if (anotacoes[i]) {
                anotacao = `<div class="anotacao">${anotacoes[i]}</div>`;
            }
            
            el.innerHTML += `
                <span>
                    ${i} 
                    <button class="show-form-btn" data-dia="${i}">+</button>
                    ${anotacao}
                </span>
            `;
        }

        const overlay = document.getElementById('overlay');
        const formContainer = document.getElementById('form-container');
        const closeFormBtn = document.getElementById('close-form');

        document.addEventListener('click', (event) => {
            if (event.target.classList.contains('show-form-btn')) {
                const dia = event.target.getAttribute('data-dia');
                document.getElementById('dia').value = dia;
                overlay.style.display = 'block';
                formContainer.style.display = 'block';
            }
        });

        closeFormBtn.addEventListener('click', () => {
            overlay.style.display = 'none';
            formContainer.style.display = 'none';
        });

        overlay.addEventListener('click', () => {
            overlay.style.display = 'none';
            formContainer.style.display = 'none';
        });
    </script>
</body>
</html>
