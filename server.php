<?php

require './vendor/autoload.php';

$server = new Hoa\Websocket\Server(
    new Hoa\Socket\Server('tcp://127.0.0.1:8889')
);

$server->on('open', function( Hoa\Core\Event\Bucket $bucket ) {

  echo "connection opened";
});

$server->on('message', function ( Hoa\Core\Event\Bucket $bucket ) {

    $data = $bucket->getData();

    echo 'message: ', $data['message'], "\n";
    $bucket->getSource()->send($data['message']);

    return;
});

$server->run();