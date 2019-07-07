<?php

namespace App;

use Exchange\LatestRequest;
use Exchange\ConvertRequest;
use Exchange\SymbolRequest;
use Exchange\LatestResponse;
use Exchange\SymbolResponse;
use Exchange\ConvertResponse;
use Exchange\ExchangeInterface;
use Google\Protobuf\Internal\Message;

class Client implements ExchangeInterface
{
    public function symbols(SymbolRequest $request): SymbolResponse
    {
      $reply = new SymbolResponse();
      $reply->mergeFromString($this->makeRequest($request, 'symbols'));

      return $reply;
    }

    public function latests(LatestRequest $request): LatestResponse
    {
      $reply = new LatestResponse();
      $reply->mergeFromString($this->makeRequest($request, 'latests'));

      return $reply;
    }

    public function convert(ConvertRequest $request): ConvertResponse
    {
      $reply = new ConvertResponse();
      $reply->mergeFromString($this->makeRequest($request, 'convert'));

      return $reply;
    }

    private function makeRequest(Message $message, string $method): string
    {
      $body = $message->serializeToString();

      $ch = curl_init("http://localhost:8000/{$method}");

      curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $body,
      ]);

      $response = curl_exec($ch);

      curl_close($ch);

      return $response;
    }
}
