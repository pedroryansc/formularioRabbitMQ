<?php

require_once __DIR__."/vendor/autoload.php";
use PhpAmqpLib\Connection\AMQPStreamConnection;

$conexao = new AMQPStreamConnection("localhost", 5672, "guest", "guest");
$canal = $conexao->channel();

$canal->queue_declare("fila", false, false, false, false);

echo "[*] Esperando por dados. Para cancelar, pressione CTRL + C \n";

$callback = function($dados){
    echo "[x] Dados recebidos \n";

    $dadosJson = json_decode($dados->getBody());

    echo "Nome: ".$dadosJson->nome."\nData de Lançamento: ".date_format(date_create($dadosJson->dataLancamento), "d/m/Y")."\n";
};

$canal->basic_consume("fila", "", false, true, false, false, $callback);

try{
    $canal->consume();
} catch(\Throwable $exception){
    echo $exception->getMessage();
}

$canal->close();
$conexao->close();

?>