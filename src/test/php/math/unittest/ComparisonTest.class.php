<?php namespace math\unittest;

use math\{BigFloat, BigInt};
use test\{Assert, Test, Values};

class ComparisonTest {

  /** @return iterable */
  private function integers() {
    yield [1, 1, 0];
    yield [1, 0, 1];
    yield [1, 2, -1];
    yield [1, 1.5, -1];
    yield [1, -1.5, 1];
    yield [1, PHP_INT_MIN, 1];
    yield [1, PHP_INT_MAX, -1];
    yield [1, '1', 0];
    yield [1, '18446744073709551616', -1];
    yield ['18446744073709551616', '18446744073709551616', 0];
  }

  /** @return iterable */
  private function floats() {
    yield [1.0, 1.0, 0];
    yield [1.0, 0.0, 1];
    yield [1.0, 2.0, -1];
    yield [1.0, 1.5, -1];
    yield [1.0, '12699025049277956096.22', -1];
    yield ['12699025049277956096.22', '12699025049277956096.22', 0];
  }

  #[Test, Values(from: 'integers')]
  public function compare_bigint($a, $b, $expected) {
    Assert::equals($expected, (new BigInt($a))->compare($b));
  }

  #[Test]
  public function compare_bigint_to_float_using_zero_precision() {
    Assert::equals(0, (new BigInt(1))->compare(1.5, 0));
  }

  #[Test, Values(from: 'floats')]
  public function compare_bigfloat($a, $b, $expected) {
    Assert::equals($expected, (new BigFloat($a))->compare($b));
  }

  #[Test, Values([[0, 0], [1, 0], [2, 0], [3, -1]])]
  public function compare_bigfloat_with_precision($precision, $expected) {
    Assert::equals($expected, (new BigFloat(1.444))->compare(1.445, $precision));
  }

  #[Test, Values(from: 'integers')]
  public function equals_bigint($a, $b, $expected) {
    Assert::equals(0 === $expected, (new BigInt($a))->equals($b));
  }

  #[Test, Values(from: 'floats')]
  public function equals_bigfloat($a, $b, $expected) {
    Assert::equals(0 === $expected, (new BigFloat($a))->equals($b));
  }
}