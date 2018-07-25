<?php namespace Tests\Traits;

use PHPUnit\Framework\Assert as PHPUnit;

trait JsonAssertionsTrait {

  /**
   * Assert that the response has a given JSON structure.
   *
   * @param  array|null $structure
   * @param  array|null $responseData
   * @return $this
   */
  public function assertJsonStructure(array $structure = null, $responseData = null)
  {
    foreach ($structure as $key => $value) {
      if (is_array($value) && $key === '*') {
        PHPUnit::assertInternalType('array', $responseData);

        foreach ($responseData as $responseDataItem) {
          $this->assertJsonStructure($structure['*'], $responseDataItem);
        }
      } elseif (is_array($value)) {
        PHPUnit::assertArrayHasKey($key, $responseData);

        $this->assertJsonStructure($structure[$key], $responseData[$key]);
      } else {
        PHPUnit::assertArrayHasKey($value, $responseData);
      }
    }

    return $this;
  }

}