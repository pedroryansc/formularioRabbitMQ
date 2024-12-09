<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
$dataLancamento = isset($_POST["dataLancamento"]) ? $_POST["dataLancamento"] : "";

$json = '{"nome":"'.$nome.'", "dataLancamento":"'.$dataLancamento.'"}';

$conexao = new AMQPStreamConnection("localhost", 5672, "guest", "guest");
$canal = $conexao->channel();

$canal->queue_declare("fila", false, false, false, false);

$dados = new AMQPMessage($json);
$canal->basic_publish($dados, "", "fila");

echo "[x] Dados enviados";

$canal->close();
$conexao->close();

header("location:index.php");

?>