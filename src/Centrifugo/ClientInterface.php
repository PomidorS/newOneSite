<?php

namespace Centrifugo;

/**
 * Interface ClientInterface
 * @package Centrifugo
 */
interface ClientInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function sendRequest(Request $request): Response;

    /**
     * @param BatchRequest $request
     *
     * @return BatchResponse
     */
    public function sendBatchRequest(BatchRequest $request);
}
