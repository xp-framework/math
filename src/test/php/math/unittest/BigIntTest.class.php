<?php namespace math\unittest;

use lang\IllegalArgumentException;
use math\{BigFloat, BigInt};
use test\Assert;
use test\{Expect, Test};

class BigIntTest {

  #[Test]
  public function intFromFloat() {
    Assert::equals(new BigInt(2), new BigInt(new BigFloat(2.0)));
  }

  #[Test]
  public function lotsOfZeroesFractionCut() {
    Assert::equals(new BigInt(4), (new BigInt('4.00000000000000000')));
  }

  #[Test]
  public function dotOneFraction() {
    Assert::equals(new BigInt(4), (new BigInt('4.1')));
  }

  #[Test]
  public function dotNineFraction() {
    Assert::equals(new BigInt(4), (new BigInt('4.9')));
  }

  #[Test]
  public function castableToString() {
    Assert::equals('6100', (string)new BigInt(6100));
  }

  #[Test]
  public function castableToStringNegative() {
    Assert::equals('-6100', (string)new BigInt(-6100));
  }

  #[Test]
  public function intValue() {
    Assert::equals(6100, (new BigInt(6100))->intValue());
  }

  #[Test]
  public function intValueNegative() {
    Assert::equals(-6100, (new BigInt(-6100))->intValue());
  }

  #[Test]
  public function byteValue() {
    Assert::equals(16, (new BigInt(16))->byteValue());
  }

  #[Test]
  public function byteValueLarge() {
    Assert::equals(222, (new BigInt(2546003422))->byteValue());
  }

  #[Test]
  public function doubleValue() {
    Assert::equals(6100.0, (new BigInt(6100))->doubleValue());
  }

  #[Test]
  public function doubleValueNegative() {
    Assert::equals(-6100.0, (new BigInt(-6100))->doubleValue());
  }

  #[Test]
  public function addition() {
    Assert::equals(new BigInt(2), (new BigInt(1))->add(new BigInt(1)));
  }

  #[Test]
  public function additionOneNegative() {
    Assert::equals(new BigInt(0), (new BigInt(-1))->add(new BigInt(1)));
  }

  #[Test]
  public function additionBothNegative() {
    Assert::equals(new BigInt(-2), (new BigInt(-1))->add(new BigInt(-1)));
  }
 
  #[Test]
  public function additionLarge() {
    $a= new BigInt('3648686172031547129462783484965308369824430041997653001183827180347');
    $b= new BigInt('1067825251034421530837885294271156039110655362253362224471523');
    $r= new BigInt('3648687239856798163884314322850602640980469152653015254546051651870');
    Assert::equals($r, $a->add($b));
  }

  #[Test]
  public function additionWithPrimitive() {
    Assert::equals(new BigInt(6100), (new BigInt(1))->add(6099));
  }

  #[Test]
  public function subtraction() {
    Assert::equals(new BigInt(0), (new BigInt(1))->subtract(new BigInt(1)));
  }

  #[Test]
  public function subtractionOneNegative() {
    Assert::equals(new BigInt(-2), (new BigInt(-1))->subtract(new BigInt(1)));
  }

  #[Test]
  public function subtractionBothNegative() {
    Assert::equals(new BigInt(0), (new BigInt(-1))->subtract(new BigInt(-1)));
  }

  #[Test]
  public function subtractionLarge() {
    $a= new BigInt('3648687239856798163884314322850602640980469152653015254546051651870');
    $b= new BigInt('1067825251034421530837885294271156039110655362253362224471523');
    $r= new BigInt('3648686172031547129462783484965308369824430041997653001183827180347');
    Assert::equals($r, $a->subtract($b));
  }

  #[Test]
  public function subtractionWithPrimitive() {
    Assert::equals(new BigInt(-6100), (new BigInt(-1))->subtract(6099));
  }

  #[Test]
  public function multiplication() {
    Assert::equals(new BigInt(1), (new BigInt(1))->multiply(new BigInt(1)));
  }

  #[Test]
  public function multiplicationOneNegative() {
    Assert::equals(new BigInt(-1), (new BigInt(-1))->multiply(new BigInt(1)));
  }

  #[Test]
  public function multiplicationBothNegative() {
    Assert::equals(new BigInt(1), (new BigInt(-1))->multiply(new BigInt(-1)));
  }

  #[Test]
  public function multiplicationLarge() {
    $a= new BigInt('36486872398567981638843143228254546051651870');
    $b= new BigInt('50602640980469152653015');
    $r= new BigInt('1846332104484924953979619544386780054125593365543499568033685888050');
    Assert::equals($r, $a->multiply($b));
  }

  #[Test]
  public function multiplicationWithPrimitive() {
    Assert::equals(new BigInt(6100), (new BigInt(-1))->multiply(-6100));
  }

  #[Test]
  public function division() {
    Assert::equals(new BigInt(2), (new BigInt(4))->divide(new BigInt(2)));
  }

  #[Test]
  public function divisionOneNegative() {
    Assert::equals(new BigInt(-2), (new BigInt(-4))->divide(new BigInt(2)));
  }

  #[Test]
  public function divisionBothNegative() {
    Assert::equals(new BigInt(2), (new BigInt(-4))->divide(new BigInt(-2)));
  }

  #[Test]
  public function divisionLarge() {
    $a= new BigInt('1846332104484924953979619544386780054125593365543499568033685888050');
    $b= new BigInt('36486872398567981638843143228254546051651870');
    $r= new BigInt('50602640980469152653015');
    Assert::equals($r, $a->divide($b));
  }

  #[Test]
  public function integerDivision1() {
    Assert::equals(new BigInt(0), (new BigInt(1))->divide(new BigInt(2)));
  }

  #[Test]
  public function integerDivision2() {
    Assert::equals(new BigInt(2), (new BigInt(8))->divide(new BigInt(3)));
  }

  #[Test]
  public function integerDivision3() {
    Assert::equals(new BigInt(-2), (new BigInt(-8))->divide(new BigInt(3)));
  }

  #[Test]
  public function divisionWithPrimitive() {
    Assert::equals(new BigInt(6100), (new BigInt(37210000))->divide(6100));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function divisionByZero() {
    (new BigInt(5))->divide(new BigInt(0));
  }

  #[Test]
  public function moduloWithoutRemainder() {
    Assert::equals(new BigInt(0), (new BigInt(4))->modulo(new BigInt(2)));
  }

  #[Test]
  public function moduloWithRemainder() {
    Assert::equals(new BigInt(1), (new BigInt(5))->modulo(new BigInt(2)));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function moduloZero() {
    (new BigInt(5))->modulo(new BigInt(0));
  }

  #[Test]
  public function moduloWithPrimitive() {
    Assert::equals(new BigInt(1), (new BigInt(5))->modulo(2));
  }

  #[Test]
  public function power() {
    Assert::equals(new BigInt(16), (new BigInt(2))->power(new BigInt(4)));
  }

  #[Test]
  public function powerNegativeOne() {
    Assert::equals(new BigInt(0), (new BigInt(2))->power(new BigInt(-1)));
  }

  #[Test]
  public function powerOfZero() {
    Assert::equals(new BigInt(0), (new BigInt(0))->power(new BigInt(2)));
  }

  #[Test]
  public function powerOfZeroZero() {
    Assert::equals(new BigInt(1), (new BigInt(0))->power(new BigInt(0)));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function powerOfZeroNegative() {
    (new BigInt(0))->power(new BigInt(-2));
  }

  #[Test]
  public function powerOfNegativeNumberEven() {
    Assert::equals(new BigInt(4), (new BigInt(-2))->power(new BigInt(2)));
  }

  #[Test]
  public function powerOfNegativeNumberOdd() {
    Assert::equals(new BigInt(-8), (new BigInt(-2))->power(new BigInt(3)));
  }

  #[Test]
  public function powerOne() {
    Assert::equals(new BigInt(2), (new BigInt(2))->power(new BigInt(1)));
  }

  #[Test]
  public function powerZero() {
    Assert::equals(new BigInt(1), (new BigInt(2))->power(new BigInt(0)));
  }

  #[Test]
  public function powerWithPrimitive() {
    Assert::equals(new BigInt(4), (new BigInt(2))->power(2));
  }

  #[Test]
  public function bitwiseAnd() {
    Assert::equals(new BigInt(1), (new BigInt(1))->bitwiseAnd(new BigInt(1)));
  }

  #[Test]
  public function bitwiseAndZero() {
    Assert::equals(new BigInt(0), (new BigInt(1))->bitwiseAnd(new BigInt(0)));
  }

  #[Test]
  public function bitwiseAndDifferentSizes() {
    Assert::equals(new BigInt(0x0000), (new BigInt(0x0100))->bitwiseAnd(new BigInt(0x0001)));
  }

  #[Test]
  public function bitwiseAndModifierMask() {
    $mask= MODIFIER_PUBLIC | MODIFIER_PROTECTED | MODIFIER_PRIVATE;
    Assert::equals(
      new BigInt(MODIFIER_PUBLIC), 
      (new BigInt(MODIFIER_PUBLIC | MODIFIER_STATIC))->bitwiseAnd(new BigInt($mask))
    );
  }

  #[Test]
  public function bitwiseAndLarge() {
    Assert::equals(
      new BigInt('18446744073709551616'), 
      (new BigInt('18446744073709551617'))->bitwiseAnd(new BigInt('18446744073709551616'))
    );
  }

  #[Test]
  public function bitwiseOr() {
    Assert::equals(new BigInt(1), (new BigInt(1))->bitwiseOr(new BigInt(1)));
  }

  #[Test]
  public function bitwiseOrZero() {
    Assert::equals(new BigInt(1), (new BigInt(1))->bitwiseOr(new BigInt(0)));
  }

  #[Test]
  public function bitwiseOrTwo() {
    Assert::equals(new BigInt(3), (new BigInt(1))->bitwiseOr(new BigInt(2)));
  }

  #[Test]
  public function bitwiseOrThree() {
    Assert::equals(new BigInt(3), (new BigInt(1))->bitwiseOr(new BigInt(3)));
  }

  #[Test]
  public function bitwiseOrModifierMask() {
    Assert::equals(
      new BigInt(MODIFIER_PUBLIC | MODIFIER_STATIC), 
      (new BigInt(MODIFIER_PUBLIC))->bitwiseOr(new BigInt(MODIFIER_STATIC))
    );
  }

  #[Test]
  public function bitwiseOrLarge() {
    Assert::equals(
      new BigInt('18446744078004518912'), 
      (new BigInt('4294967296'))->bitwiseOr(new BigInt('18446744073709551616'))
    );
  }

  #[Test]
  public function bitwiseXorOneZero() {
    Assert::equals(
      new BigInt(1), 
      (new BigInt(1))->bitwiseXor(new BigInt(0))
    );
  }

  #[Test]
  public function bitwiseXorDifferenSizes() {
    Assert::equals(
      new BigInt(256), 
      (new BigInt(1))->bitwiseXor(new BigInt(257))
    );
  }

  #[Test]
  public function leftShift() {
    Assert::equals(
      new BigInt(512), 
      (new BigInt(2))->shiftLeft(new BigInt(8))
    );
  }

  #[Test]
  public function rightShift() {
    Assert::equals(
      new BigInt(2), 
      (new BigInt(512))->shiftRight(new BigInt(8))
    );
  }

  #[Test]
  public function positive_string_representation() {
    Assert::equals('math.BigInt(4)', (new BigInt(4))->toString());
  }

  #[Test]
  public function negative_string_representation() {
    Assert::equals('math.BigInt(-4)', (new BigInt(-4))->toString());
  }

  #[Test]
  public function bitshifting_does_not_introduce_decimals() {
    Assert::equals('256', (string)((new BigInt(1))->bitwiseXor(257)));
  }
}