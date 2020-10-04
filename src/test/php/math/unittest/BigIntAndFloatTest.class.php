<?php namespace math\unittest;

use lang\IllegalArgumentException;
use math\{BigFloat, BigInt};
use unittest\{Expect, Test, TestCase, Values};

class BigIntAndFloatTest extends TestCase {

  /** @return iterable */
  private function divisions() {
    yield [new BigInt(1), new BigFloat(2.0)];
    yield [new BigFloat(1.0), new BigFloat(2.0)];
    yield [new BigFloat(1.0), new BigInt(2)];
  }

  
  #[Test]
  public function addFloatToInt() {
    $this->assertEquals(new BigFloat(2.9), (new BigInt(1))->add(new BigFloat(1.9)));
  }

  #[Test]
  public function addFloatToInt0() {
    $this->assertEquals(new BigInt(2), (new BigInt(1))->add0(new BigFloat(1.9)));
  }

  #[Test]
  public function subtractFloatFromInt() {
    $this->assertEquals(new BigFloat(0.1), (new BigInt(2))->subtract(new BigFloat(1.9)));
  }

  #[Test]
  public function subtractFloatFromInt0() {
    $this->assertEquals(new BigInt(0), (new BigInt(2))->subtract0(new BigFloat(1.9)));
  }

  #[Test]
  public function multiplyIntWithFloat() {
    $this->assertEquals(new BigFloat(3.8), (new BigInt(2))->multiply(new BigFloat(1.9)));
  }

  #[Test]
  public function multiplyIntWithFloat0() {
    $this->assertEquals(new BigInt(3), (new BigInt(2))->multiply0(new BigFloat(1.9)));
  }

  #[Test]
  public function divideIntByFloat() {
    $this->assertEquals(new BigFloat(4.0), (new BigInt(2))->divide(new BigFloat(0.5)));
  }

  #[Test]
  public function divideIntByFloat0() {
    $this->assertEquals(new BigInt(4), (new BigInt(2))->divide0(new BigFloat(0.5)));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function divideIntByFloatZero() {
    (new BigInt(2))->divide(new BigFloat(0.0));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function divideIntByFloatZero0() {
    (new BigInt(2))->divide0(new BigFloat(0.0));
  }

  #[Test]
  public function powerNegativeOne() {
    $this->assertEquals(new BigFloat(0.5), (new BigInt(2))->power(new BigFloat(-1)));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function powerOneHalf() {
    (new BigInt(2))->power(new BigFloat(0.5));
  }

  #[Test, Values('divisions')]
  public function precision_does_not_cut_off($a, $b) {
    $this->assertEquals(0.5, $a->divide($b)->doubleValue());
  }
}