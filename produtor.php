<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$conexao = new AMQPStreamConnection("localhost", 5672, "guest", "guest");
$canal = $conexao->channel();

$canal->queue_declare("fila", false, false, false, false);

$nome = "Pedro";

$json = '{"nome":"'.$nome.'"}';

$msg = new AMQPMessage($json);
$canal->basic_publish($msg, "", "fila");

echo "[x] Mensagem enviada";

$canal->close();
$conexao->close();

?>