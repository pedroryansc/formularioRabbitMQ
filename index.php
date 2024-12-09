<?php
    $titulo = "Formulário de Filme com RabbitMQ";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <form action="produtor.php" method="post">
        <p>
            Nome: <input type="text" name="nome">
            <br><br>
            Data de lançamento: <input type="date" name="dataLancamento">
            <br><br>
            <button type="submit">Enviar</button>
        </p>
    </form>
</body>
</html>