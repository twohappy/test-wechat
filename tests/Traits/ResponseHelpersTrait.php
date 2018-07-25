<?php namespace Tests\Traits;

use Psr\Http\Message\ResponseInterface;

trait ResponseHelpersTrait {
  function getBody(ResponseInterface $response)
  {
    return $response->getbody();
  }

  function getContents(ResponseInterface $response)
  {
    return $this->parseJson($response->getbody()->getContents());
  }

  function getStatusCode(ResponseInterface $response)
  {
    return $response->getStatusCode();
  }

  function getReasonPhrase(ResponseInterface $response)
  {
    return $response->getReasonPhrase();
  }

  function parseJson($string)
  {
    return json_decode($string, true);
  }
}
