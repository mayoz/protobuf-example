<?php

require __DIR__ . '/vendor/autoload.php';

$service = new App\Client();

echo "Calling symbols:\n\n";

$req = (new Exchange\SymbolRequest())->setSymbols(['USD', 'TRY']);

$res = $service->symbols($req);

foreach ($res->getSymbols() as $symbol) {
	echo "{$symbol}\n";
}

echo "\n-------------------------------------------------------------------\n\n";

echo "Calling latests:\n\n";

$req = (new Exchange\LatestRequest())->setBase('USD')->setSymbols(['EUR']);

$res = $service->latests($req);

foreach ($res->getData() as $symbol => $tick) {
	echo "{$res->getBase()}/{$symbol}: {$tick}\n";
}

echo "last updated at: {$res->getTimestamp()}\n";

echo "\n-------------------------------------------------------------------\n\n";

echo "Calling convert:\n\n";

$req = (new Exchange\ConvertRequest())->setFrom('USD')->setTo('TRY')->setQuantity(40);

$res = $service->convert($req);

echo "{$req->getQuantity()} {$res->getFrom()} = {$res->getValue()} {$res->getTo()}\n";
echo "last updated at: {$res->getTimestamp()}\n";


echo "\n\n";
