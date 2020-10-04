<?php namespace math\unittest;

use lang\IllegalArgumentException;
use math\{BigFloat, BigInt};
use unittest\{Expect, Test};

class BigIntTest extends \unittest\TestCase {

  #[Test]
  public function intFromFloat() {
    $this->assertEquals(new BigInt(2), new BigInt(new BigFloat(2.0)));
  }

  #[Test]
  public function lotsOfZeroesFractionCut() {
    $this->assertEquals(new BigInt(4), (new BigInt('4.00000000000000000')));
  }

  #[Test]
  public function dotOneFraction() {
    $this->assertEquals(new BigInt(4), (new BigInt('4.1')));
  }

  #[Test]
  public function dotNineFraction() {
    $this->assertEquals(new BigInt(4), (new BigInt('4.9')));
  }

  #[Test]
  public function castableToString() {
    $this->assertEquals('6100', (string)new BigInt(6100));
  }

  #[Test]
  public function castableToStringNegative() {
    $this->assertEquals('-6100', (string)new BigInt(-6100));
  }

  #[Test]
  public function intValue() {
    $this->assertEquals(6100, (new BigInt(6100))->intValue());
  }

  #[Test]
  public function intValueNegative() {
    $this->assertEquals(-6100, (new BigInt(-6100))->intValue());
  }

  #[Test]
  public function byteValue() {
    $this->assertEquals(16, (new BigInt(16))->byteValue());
  }

  #[Test]
  public function byteValueLarge() {
    $this->assertEquals(222, (new BigInt(2546003422))->byteValue());
  }

  #[Test]
  public function doubleValue() {
    $this->assertEquals(6100.0, (new BigInt(6100))->doubleValue());
  }

  #[Test]
  public function doubleValueNegative() {
    $this->assertEquals(-6100.0, (new BigInt(-6100))->doubleValue());
  }

  #[Test]
  public function addition() {
    $this->assertEquals(new BigInt(2), (new BigInt(1))->add(new BigInt(1)));
  }

  #[Test]
  public function additionOneNegative() {
    $this->assertEquals(new BigInt(0), (new BigInt(-1))->add(new BigInt(1)));
  }

  #[Test]
  public function additionBothNegative() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-1))->add(new BigInt(-1)));
  }
 
  #[Test]
  public function additionLarge() {
    $a= new BigInt('3648686172031547129462783484965308369824430041997653001183827180347');
    $b= new BigInt('1067825251034421530837885294271156039110655362253362224471523');
    $r= new BigInt('3648687239856798163884314322850602640980469152653015254546051651870');
    $this->assertEquals($r, $a->add($b));
  }

  #[Test]
  public function additionWithPrimitive() {
    $this->assertEquals(new BigInt(6100), (new BigInt(1))->add(6099));
  }

  #[Test]
  public function subtraction() {
    $this->assertEquals(new BigInt(0), (new BigInt(1))->subtract(new BigInt(1)));
  }

  #[Test]
  public function subtractionOneNegative() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-1))->subtract(new BigInt(1)));
  }

  #[Test]
  public function subtractionBothNegative() {
    $this->assertEquals(new BigInt(0), (new BigInt(-1))->subtract(new BigInt(-1)));
  }

  #[Test]
  public function subtractionLarge() {
    $a= new BigInt('3648687239856798163884314322850602640980469152653015254546051651870');
    $b= new BigInt('1067825251034421530837885294271156039110655362253362224471523');
    $r= new BigInt('3648686172031547129462783484965308369824430041997653001183827180347');
    $this->assertEquals($r, $a->subtract($b));
  }

  #[Test]
  public function subtractionWithPrimitive() {
    $this->assertEquals(new BigInt(-6100), (new BigInt(-1))->subtract(6099));
  }

  #[Test]
  public function multiplication() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->multiply(new BigInt(1)));
  }

  #[Test]
  public function multiplicationOneNegative() {
    $this->assertEquals(new BigInt(-1), (new BigInt(-1))->multiply(new BigInt(1)));
  }

  #[Test]
  public function multiplicationBothNegative() {
    $this->assertEquals(new BigInt(1), (new BigInt(-1))->multiply(new BigInt(-1)));
  }

  #[Test]
  public function multiplicationLarge() {
    $a= new BigInt('36486872398567981638843143228254546051651870');
    $b= new BigInt('50602640980469152653015');
    $r= new BigInt('1846332104484924953979619544386780054125593365543499568033685888050');
    $this->assertEquals($r, $a->multiply($b));
  }

  #[Test]
  public function multiplicationWithPrimitive() {
    $this->assertEquals(new BigInt(6100), (new BigInt(-1))->multiply(-6100));
  }

  #[Test]
  public function division() {
    $this->assertEquals(new BigInt(2), (new BigInt(4))->divide(new BigInt(2)));
  }

  #[Test]
  public function divisionOneNegative() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-4))->divide(new BigInt(2)));
  }

  #[Test]
  public function divisionBothNegative() {
    $this->assertEquals(new BigInt(2), (new BigInt(-4))->divide(new BigInt(-2)));
  }

  #[Test]
  public function divisionLarge() {
    $a= new BigInt('1846332104484924953979619544386780054125593365543499568033685888050');
    $b= new BigInt('36486872398567981638843143228254546051651870');
    $r= new BigInt('50602640980469152653015');
    $this->assertEquals($r, $a->divide($b));
  }

  #[Test]
  public function integerDivision1() {
    $this->assertEquals(new BigInt(0), (new BigInt(1))->divide(new BigInt(2)));
  }

  #[Test]
  public function integerDivision2() {
    $this->assertEquals(new BigInt(2), (new BigInt(8))->divide(new BigInt(3)));
  }

  #[Test]
  public function integerDivision3() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-8))->divide(new BigInt(3)));
  }

  #[Test]
  public function divisionWithPrimitive() {
    $this->assertEquals(new BigInt(6100), (new BigInt(37210000))->divide(6100));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function divisionByZero() {
    (new BigInt(5))->divide(new BigInt(0));
  }

  #[Test]
  public function moduloWithoutRemainder() {
    $this->assertEquals(new BigInt(0), (new BigInt(4))->modulo(new BigInt(2)));
  }

  #[Test]
  public function moduloWithRemainder() {
    $this->assertEquals(new BigInt(1), (new BigInt(5))->modulo(new BigInt(2)));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function moduloZero() {
    (new BigInt(5))->modulo(new BigInt(0));
  }

  #[Test]
  public function moduloWithPrimitive() {
    $this->assertEquals(new BigInt(1), (new BigInt(5))->modulo(2));
  }

  #[Test]
  public function power() {
    $this->assertEquals(new BigInt(16), (new BigInt(2))->power(new BigInt(4)));
  }

  #[Test]
  public function powerNegativeOne() {
    $this->assertEquals(new BigInt(0), (new BigInt(2))->power(new BigInt(-1)));
  }

  #[Test]
  public function powerOfZero() {
    $this->assertEquals(new BigInt(0), (new BigInt(0))->power(new BigInt(2)));
  }

  #[Test]
  public function powerOfZeroZero() {
    $this->assertEquals(new BigInt(1), (new BigInt(0))->power(new BigInt(0)));
  }

  #[Test]
  public function powerOfZeroNegative() {
    $this->assertEquals(new BigInt(0), (new BigInt(0))->power(new BigInt(-2)));
  }

  #[Test]
  public function powerOfNegativeNumberEven() {
    $this->assertEquals(new BigInt(4), (new BigInt(-2))->power(new BigInt(2)));
  }

  #[Test]
  public function powerOfNegativeNumberOdd() {
    $this->assertEquals(new BigInt(-8), (new BigInt(-2))->power(new BigInt(3)));
  }

  #[Test]
  public function powerOne() {
    $this->assertEquals(new BigInt(2), (new BigInt(2))->power(new BigInt(1)));
  }

  #[Test]
  public function powerZero() {
    $this->assertEquals(new BigInt(1), (new BigInt(2))->power(new BigInt(0)));
  }

  #[Test]
  public function powerWithPrimitive() {
    $this->assertEquals(new BigInt(4), (new BigInt(2))->power(2));
  }

  #[Test]
  public function bitwiseAnd() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->bitwiseAnd(new BigInt(1)));
  }

  #[Test]
  public function bitwiseAndZero() {
    $this->assertEquals(new BigInt(0), (new BigInt(1))->bitwiseAnd(new BigInt(0)));
  }

  #[Test]
  public function bitwiseAndDifferentSizes() {
    $this->assertEquals(new BigInt(0x0000), (new BigInt(0x0100))->bitwiseAnd(new BigInt(0x0001)));
  }

  #[Test]
  public function bitwiseAndModifierMask() {
    $mask= MODIFIER_PUBLIC | MODIFIER_PROTECTED | MODIFIER_PRIVATE;
    $this->assertEquals(
      new BigInt(MODIFIER_PUBLIC), 
      (new BigInt(MODIFIER_PUBLIC | MODIFIER_STATIC))->bitwiseAnd(new BigInt($mask))
    );
  }

  #[Test]
  public function bitwiseAndLarge() {
    $this->assertEquals(
      new BigInt('18446744073709551616'), 
      (new BigInt('18446744073709551617'))->bitwiseAnd(new BigInt('18446744073709551616'))
    );
  }

  #[Test]
  public function bitwiseOr() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->bitwiseOr(new BigInt(1)));
  }

  #[Test]
  public function bitwiseOrZero() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->bitwiseOr(new BigInt(0)));
  }

  #[Test]
  public function bitwiseOrTwo() {
    $this->assertEquals(new BigInt(3), (new BigInt(1))->bitwiseOr(new BigInt(2)));
  }

  #[Test]
  public function bitwiseOrThree() {
    $this->assertEquals(new BigInt(3), (new BigInt(1))->bitwiseOr(new BigInt(3)));
  }

  #[Test]
  public function bitwiseOrModifierMask() {
    $this->assertEquals(
      new BigInt(MODIFIER_PUBLIC | MODIFIER_STATIC), 
      (new BigInt(MODIFIER_PUBLIC))->bitwiseOr(new BigInt(MODIFIER_STATIC))
    );
  }

  #[Test]
  public function bitwiseOrLarge() {
    $this->assertEquals(
      new BigInt('18446744078004518912'), 
      (new BigInt('4294967296'))->bitwiseOr(new BigInt('18446744073709551616'))
    );
  }

  #[Test]
  public function bitwiseXorOneZero() {
    $this->assertEquals(
      new BigInt(1), 
      (new BigInt(1))->bitwiseXor(new BigInt(0))
    );
  }

  #[Test]
  public function bitwiseXorDifferenSizes() {
    $this->assertEquals(
      new BigInt(256), 
      (new BigInt(1))->bitwiseXor(new BigInt(257))
    );
  }

  #[Test]
  public function leftShift() {
    $this->assertEquals(
      new BigInt(512), 
      (new BigInt(2))->shiftLeft(new BigInt(8))
    );
  }

  #[Test]
  public function rightShift() {
    $this->assertEquals(
      new BigInt(2), 
      (new BigInt(512))->shiftRight(new BigInt(8))
    );
  }

  #[Test]
  public function positive_string_representation() {
    $this->assertEquals('math.BigInt(4)', (new BigInt(4))->toString());
  }

  #[Test]
  public function negative_string_representation() {
    $this->assertEquals('math.BigInt(-4)', (new BigInt(-4))->toString());
  }
}