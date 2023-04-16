<?php namespace math\unittest;

use lang\IllegalArgumentException;
use math\{BigFloat, BigInt};
use test\Assert;
use test\{Expect, Test, TestCase, Values};

class BigIntAndFloatTest {

  /** @return iterable */
  private function divisions() {
    yield [new BigInt(1), new BigFloat(2.0)];
    yield [new BigFloat(1.0), new BigFloat(2.0)];
    yield [new BigFloat(1.0), new BigInt(2)];
  }

  
  #[Test]
  public function addFloatToInt() {
    Assert::equals(new BigFloat(2.9), (new BigInt(1))->add(new BigFloat(1.9)));
  }

  #[Test]
  public function addFloatToInt0() {
    Assert::equals(new BigInt(2), (new BigInt(1))->add0(new BigFloat(1.9)));
  }

  #[Test]
  public function subtractFloatFromInt() {
    Assert::equals(new BigFloat(0.1), (new BigInt(2))->subtract(new BigFloat(1.9)));
  }

  #[Test]
  public function subtractFloatFromInt0() {
    Assert::equals(new BigInt(0), (new BigInt(2))->subtract0(new BigFloat(1.9)));
  }

  #[Test]
  public function multiplyIntWithFloat() {
    Assert::equals(new BigFloat(3.8), (new BigInt(2))->multiply(new BigFloat(1.9)));
  }

  #[Test]
  public function multiplyIntWithFloat0() {
    Assert::equals(new BigInt(3), (new BigInt(2))->multiply0(new BigFloat(1.9)));
  }

  #[Test]
  public function divideIntByFloat() {
    Assert::equals(new BigFloat(4.0), (new BigInt(2))->divide(new BigFloat(0.5)));
  }

  #[Test]
  public function divideIntByFloat0() {
    Assert::equals(new BigInt(4), (new BigInt(2))->divide0(new BigFloat(0.5)));
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
    Assert::equals(new BigFloat(0.5), (new BigInt(2))->power(new BigFloat(-1)));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function powerOneHalf() {
    (new BigInt(2))->power(new BigFloat(0.5));
  }

  #[Test, Values(from: 'divisions')]
  public function precision_does_not_cut_off($a, $b) {
    Assert::equals(0.5, $a->divide($b)->doubleValue());
  }
}