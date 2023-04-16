<?php namespace math\unittest;

use lang\IllegalArgumentException;
use math\{BigFloat, BigInt};
use test\Assert;
use test\{Expect, Test};

class BigFloatTest {

  #[Test]
  public function floatFromInt() {
    Assert::equals(new BigFloat(2.0), new BigFloat(new BigInt(2)));
  }
  
  #[Test]
  public function castableToString() {
    Assert::equals('6100', (string)new BigFloat(6100.0));
  }

  #[Test]
  public function castableToStringNegative() {
    Assert::equals('-6100', (string)new BigFloat(-6100.0));
  }

  #[Test]
  public function castableToStringHalf() {
    Assert::equals('0.5', (string)new BigFloat(0.5));
  }

  #[Test]
  public function intValue() {
    Assert::equals(6100, (new BigFloat(6100.0))->intValue());
  }

  #[Test]
  public function intValueNegative() {
    Assert::equals(-6100, (new BigFloat(-6100.0))->intValue());
  }

  #[Test]
  public function doubleValue() {
    Assert::equals(6100.0, (new BigFloat(6100.0))->doubleValue());
  }

  #[Test]
  public function doubleValueNegative() {
    Assert::equals(-6100.0, (new BigFloat(-6100.0))->doubleValue());
  }

  #[Test]
  public function addition() {
    Assert::equals(new BigFloat(2.0), (new BigFloat(1.0))->add(new BigFloat(1.0)));
  }

  #[Test]
  public function additionOneNegative() {
    Assert::equals(new BigFloat(0.0), (new BigFloat(-1.0))->add(new BigFloat(1.0)));
  }

  #[Test]
  public function additionBothNegative() {
    Assert::equals(new BigFloat(-2), (new BigFloat(-1.0))->add(new BigFloat(-1.0)));
  }
 
  #[Test]
  public function additionLarge() {
    $a= new BigFloat('3648686172031547129462783484965308369824430041997653001183827180347.1');
    $b= new BigFloat('1067825251034421530837885294271156039110655362253362224471523.9');
    $r= new BigFloat('3648687239856798163884314322850602640980469152653015254546051651871');
    Assert::equals($r, $a->add($b));
  }

  #[Test]
  public function additionWithPrimitive() {
    Assert::equals(new BigFloat(6100.0), (new BigFloat(1.0))->add(6099.0));
  }

  #[Test]
  public function subtraction() {
    Assert::equals(new BigFloat(0.0), (new BigFloat(1.0))->subtract(new BigFloat(1.0)));
  }

  #[Test]
  public function subtractionOneNegative() {
    Assert::equals(new BigFloat(-2.0), (new BigFloat(-1.0))->subtract(new BigFloat(1.0)));
  }

  #[Test]
  public function subtractionBothNegative() {
    Assert::equals(new BigFloat(0.0), (new BigFloat(-1.0))->subtract(new BigFloat(-1.0)));
  }

  #[Test]
  public function subtractionLarge() {
    $a= new BigFloat('3648687239856798163884314322850602640980469152653015254546051651871');
    $b= new BigFloat('1067825251034421530837885294271156039110655362253362224471523.9');
    $r= new BigFloat('3648686172031547129462783484965308369824430041997653001183827180347.1');
    Assert::equals($r, $a->subtract($b));
  }

  #[Test]
  public function subtractionWithPrimitive() {
    Assert::equals(new BigFloat(-6100.0), (new BigFloat(-1.0))->subtract(6099.0));
  }

  #[Test]
  public function multiplication() {
    Assert::equals(new BigFloat(1.0), (new BigFloat(1.0))->multiply(new BigFloat(1.0)));
  }

  #[Test]
  public function multiplicationOneNegative() {
    Assert::equals(new BigFloat(-1.0), (new BigFloat(-1.0))->multiply(new BigFloat(1.0)));
  }

  #[Test]
  public function multiplicationBothNegative() {
    Assert::equals(new BigFloat(1.0), (new BigFloat(-1.0))->multiply(new BigFloat(-1.0)));
  }

  #[Test]
  public function multiplicationLarge() {
    $a= new BigFloat('36486872398567981638843143228254546051651870.2');
    $b= new BigFloat('50602640980469152653015.1');
    $r= new BigFloat('1846332104484924953979623193074019910923757259978350589582121583840.02');
    Assert::equals($r, $a->multiply($b));
  }

  #[Test]
  public function multiplicationWithPrimitive() {
    Assert::equals(new BigFloat(6100.0), (new BigFloat(-1.0))->multiply(-6100.0));
  }

  #[Test]
  public function division() {
    Assert::equals(new BigFloat(2.0), (new BigFloat(4.0))->divide(new BigFloat(2.0)));
  }

  #[Test]
  public function divisionOneNegative() {
    Assert::equals(new BigFloat(-2.0), (new BigFloat(-4.0))->divide(new BigFloat(2.0)));
  }

  #[Test]
  public function divisionBothNegative() {
    Assert::equals(new BigFloat(2.0), (new BigFloat(-4.0))->divide(new BigFloat(-2.0)));
  }

  #[Test]
  public function divisionLarge() {
    $a= new BigFloat('1846332104484924953979619544386780054125593365543499568033685888050.0');
    $b= new BigFloat('36486872398567981638843143228254546051651870.0');
    $r= new BigFloat('50602640980469152653015.0');
    Assert::equals($r, $a->divide($b));
  }

  #[Test]
  public function divisionWithPrimitive() {
    Assert::equals(new BigFloat(6100.0), (new BigFloat(37210000.0))->divide(6100.0));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function divisionByZero() {
    (new BigFloat(5.0))->divide(new BigFloat(0.0));
  }

  #[Test]
  public function power() {
    Assert::equals(new BigFloat(16.0), (new BigFloat(2.0))->power(new BigFloat(4.0)));
  }

  #[Test]
  public function powerNegativeOne() {
    Assert::equals(new BigFloat('0.5'), (new BigFloat(2.0))->power(new BigFloat(-1.0)));
  }

  #[Test]
  public function powerOfZero() {
    Assert::equals(new BigFloat(0.0), (new BigFloat(0.0))->power(new BigFloat(2.0)));
  }

  #[Test]
  public function powerOfZeroZero() {
    Assert::equals(new BigFloat(1.0), (new BigFloat(0.0))->power(new BigFloat(0.0)));
  }

  #[Test]
  public function powerOfZeroNegative() {
    Assert::equals(new BigFloat(0.0), (new BigFloat(0.0))->power(new BigFloat(-2)));
  }

  #[Test]
  public function powerOfNegativeNumberEven() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(-2.0))->power(new BigFloat(2.0)));
  }

  #[Test]
  public function powerOfNegativeNumberOdd() {
    Assert::equals(new BigFloat(-8.0), (new BigFloat(-2.0))->power(new BigFloat(3.0)));
  }

  #[Test]
  public function powerOne() {
    Assert::equals(new BigFloat(2.0), (new BigFloat(2.0))->power(new BigFloat(1.0)));
  }

  #[Test]
  public function powerZero() {
    Assert::equals(new BigFloat(1.0), (new BigFloat(2.0))->power(new BigFloat(0.0)));
  }

  #[Test]
  public function powerWithPrimitive() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(2.0))->power(2.0));
  }

  #[Test]
  public function ceil() {
    Assert::equals(new BigFloat(5.0), (new BigFloat(4.5))->ceil());
  }

  #[Test]
  public function ceilInt() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(4.0))->ceil());
  }

  #[Test]
  public function ceilClose() {
    Assert::equals(new BigFloat(10.0), (new BigFloat(9.999))->ceil());
  }

  #[Test]
  public function ceilNegative() {
    Assert::equals(new BigFloat(-4.0), (new BigFloat(-4.5))->ceil());
  }

  #[Test]
  public function floor() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(4.5))->floor());
  }

  #[Test]
  public function floorInt() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(4.0))->floor());
  }

  #[Test]
  public function floorClose() {
    Assert::equals(new BigFloat(9.0), (new BigFloat(9.999))->floor());
  }

  #[Test]
  public function floorNegative() {
    Assert::equals(new BigFloat(-5.0), (new BigFloat(-4.5))->floor());
  }

  #[Test]
  public function roundWhole() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(4.0))->round());
  }

  #[Test]
  public function round() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(4.4))->round());
  }

  #[Test]
  public function roundNegative() {
    Assert::equals(new BigFloat(-4.0), (new BigFloat(-4.4))->round());
  }

  #[Test]
  public function roundHalf() {
    Assert::equals(new BigFloat(5.0), (new BigFloat(4.5))->round());
  }

  #[Test]
  public function roundNegativeHalf() {
    Assert::equals(new BigFloat(-5.0), (new BigFloat(-4.5))->round());
  }

  #[Test]
  public function roundAlmostHalf() {
    Assert::equals(new BigFloat(4.0), (new BigFloat(4.499999))->round());
  }

  #[Test]
  public function roundNegativeAlmostHalf() {
    Assert::equals(new BigFloat(-4.0), (new BigFloat(-4.499999))->round());
  }

  #[Test]
  public function roundEuroToDeutscheMarkExchangeRateToTwoDigits() {
    Assert::equals(new BigFloat(1.96), (new BigFloat(1.95583))->round(2));
  }

  #[Test]
  public function roundSample1() {
    Assert::equals(new BigFloat(323.35), (new BigFloat(323.346))->round(2));
  }

  #[Test]
  public function roundSample2() {
    Assert::equals(new BigFloat(323.01), (new BigFloat(323.006))->round(2));
  }

  #[Test]
  public function ceilLotsOfZeros() {
    Assert::equals(new BigFloat(4.0), (new BigFloat('4.00000000000000000'))->ceil());
  }

  #[Test]
  public function floorLotsOfZeros() {
    Assert::equals(new BigFloat(4.0), (new BigFloat('4.00000000000000000'))->floor());
  }

  #[Test]
  public function roundLotsOfZeros() {
    Assert::equals(new BigFloat(4.0), (new BigFloat('4.00000000000000000'))->round());
  }

  #[Test]
  public function positive_string_representation() {
    Assert::equals('math.BigFloat(4)', (new BigFloat(4.0))->toString());
  }

  #[Test]
  public function negative_string_representation() {
    Assert::equals('math.BigFloat(-4)', (new BigFloat(-4.0))->toString());
  }
}