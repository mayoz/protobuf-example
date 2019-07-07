<?php

namespace App;

use Exchange\ExchangeInterface;

class Exchange implements ExchangeInterface
{
    /**
     * Method <code>symbols</code>
     *
     * @param \Exchange\SymbolRequest $request
     * @return \Exchange\SymbolResponse
     */
    public function symbols(\Exchange\SymbolRequest $request)
    {
        // mock data
        $mocks = [
            'EUR',
            'TRY',
            'USD',
        ];

        $expects = [];

        foreach ($request->getSymbols() as $symbol) {
            $expects[] = $symbol;
        }

        $symbols = array_filter($mocks, function (string $symbol) use ($expects) {
            return empty($expects) || in_array($symbol, $expects);
        });

        $reply = new \Exchange\SymbolResponse;

        $reply->setSymbols($symbols);

        return $reply;
    }

    /**
     * Method <code>latests</code>
     *
     * @param \Exchange\LatestRequest $request
     * @return \Exchange\LatestResponse
     */
    public function latests(\Exchange\LatestRequest $request)
    {
        // mock data
        $mocks = [
            'EUR' => 0.89,
            'TRY' => 5.63,
        ];

        $reply = new \Exchange\LatestResponse;

        $reply->setBase($request->getBase());
        $reply->setTimestamp(strtotime('now'));
        $reply->setData($mocks);

        return $reply;
    }

    /**
     * Method <code>convert</code>
     *
     * @param \Exchange\ConvertRequest $request
     * @return \Exchange\ConvertResponse
     */
    public function convert(\Exchange\ConvertRequest $request)
    {
        // mock data
        $mock = 5.63;

        $reply = new \Exchange\ConvertResponse;

        $reply->setFrom($request->getFrom());
        $reply->setTo($request->getTo());
        $reply->setValue($request->getQuantity() * $mock);
        $reply->setTimestamp(strtotime('now'));

        return $reply;
    }
}
