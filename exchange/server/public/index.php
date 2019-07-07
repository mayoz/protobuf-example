<?php

require __DIR__.'/../vendor/autoload.php';

$method = ltrim(rawurldecode($_SERVER['REQUEST_URI']), '/');

switch ($method) {
  case 'symbols':
    $request = new Exchange\SymbolRequest();

    $request->mergeFromString(file_get_contents('php://input'));

    $reply = (new App\Exchange())->symbols($request);

    echo $reply->serializeToString();
    break;
  case 'latests':
    $request = new Exchange\LatestRequest();

    $request->mergeFromString(file_get_contents('php://input'));

    $reply = (new App\Exchange())->latests($request);

    echo $reply->serializeToString();
    break;
  case 'convert':
    $request = new Exchange\ConvertRequest();

    $request->mergeFromString(file_get_contents('php://input'));

    $reply = (new App\Exchange())->convert($request);

    echo $reply->serializeToString();
    break;
  default:
    http_response_code(404);
}
