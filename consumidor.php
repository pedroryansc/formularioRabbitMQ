<?php

require_once __DIR__."/vendor/autoload.php";
use PhpAmqpLib\Connection\AMQPStreamConnection;

$conexao = new AMQPStreamConnection("localhost", 5672, "guest", "guest");
$canal = $conexao->channel();

$canal->queue_declare("fila", false, false, false, false);

echo "[*] Esperando por mensagens. Para cancelar, pressione CTRL + C \n";

$callback = function($msg){
    echo "[x] Mensagem '".$msg->getBody()."' recebida \n";

    $objetoJson = json_decode($msg->getBody());
    echo $objetoJson->nome;
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