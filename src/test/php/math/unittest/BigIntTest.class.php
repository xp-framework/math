<?php namespace math\unittest;

use math\BigInt;
use math\BigFloat;
use lang\IllegalArgumentException;

class BigIntTest extends \unittest\TestCase {

  #[@test]
  public function intFromFloat() {
    $this->assertEquals(new BigInt(2), new BigInt(new BigFloat(2.0)));
  }

  #[@test]
  public function lotsOfZeroesFractionCut() {
    $this->assertEquals(new BigInt(4), (new BigInt('4.00000000000000000')));
  }

  #[@test]
  public function dotOneFraction() {
    $this->assertEquals(new BigInt(4), (new BigInt('4.1')));
  }

  #[@test]
  public function dotNineFraction() {
    $this->assertEquals(new BigInt(4), (new BigInt('4.9')));
  }

  #[@test]
  public function castableToString() {
    $this->assertEquals('6100', (string)new BigInt(6100));
  }

  #[@test]
  public function castableToStringNegative() {
    $this->assertEquals('-6100', (string)new BigInt(-6100));
  }

  #[@test]
  public function intValue() {
    $this->assertEquals(6100, (new BigInt(6100))->intValue());
  }

  #[@test]
  public function intValueNegative() {
    $this->assertEquals(-6100, (new BigInt(-6100))->intValue());
  }

  #[@test]
  public function byteValue() {
    $this->assertEquals(16, (new BigInt(16))->byteValue());
  }

  #[@test]
  public function byteValueLarge() {
    $this->assertEquals(222, (new BigInt(2546003422))->byteValue());
  }

  #[@test]
  public function doubleValue() {
    $this->assertEquals(6100.0, (new BigInt(6100))->doubleValue());
  }

  #[@test]
  public function doubleValueNegative() {
    $this->assertEquals(-6100.0, (new BigInt(-6100))->doubleValue());
  }

  #[@test]
  public function addition() {
    $this->assertEquals(new BigInt(2), (new BigInt(1))->add(new BigInt(1)));
  }

  #[@test]
  public function additionOneNegative() {
    $this->assertEquals(new BigInt(0), (new BigInt(-1))->add(new BigInt(1)));
  }

  #[@test]
  public function additionBothNegative() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-1))->add(new BigInt(-1)));
  }
 
  #[@test]
  public function additionLarge() {
    $a= new BigInt('3648686172031547129462783484965308369824430041997653001183827180347');
    $b= new BigInt('1067825251034421530837885294271156039110655362253362224471523');
    $r= new BigInt('3648687239856798163884314322850602640980469152653015254546051651870');
    $this->assertEquals($r, $a->add($b));
  }

  #[@test]
  public function additionWithPrimitive() {
    $this->assertEquals(new BigInt(6100), (new BigInt(1))->add(6099));
  }

  #[@test]
  public function subtraction() {
    $this->assertEquals(new BigInt(0), (new BigInt(1))->subtract(new BigInt(1)));
  }

  #[@test]
  public function subtractionOneNegative() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-1))->subtract(new BigInt(1)));
  }

  #[@test]
  public function subtractionBothNegative() {
    $this->assertEquals(new BigInt(0), (new BigInt(-1))->subtract(new BigInt(-1)));
  }

  #[@test]
  public function subtractionLarge() {
    $a= new BigInt('3648687239856798163884314322850602640980469152653015254546051651870');
    $b= new BigInt('1067825251034421530837885294271156039110655362253362224471523');
    $r= new BigInt('3648686172031547129462783484965308369824430041997653001183827180347');
    $this->assertEquals($r, $a->subtract($b));
  }

  #[@test]
  public function subtractionWithPrimitive() {
    $this->assertEquals(new BigInt(-6100), (new BigInt(-1))->subtract(6099));
  }

  #[@test]
  public function multiplication() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->multiply(new BigInt(1)));
  }

  #[@test]
  public function multiplicationOneNegative() {
    $this->assertEquals(new BigInt(-1), (new BigInt(-1))->multiply(new BigInt(1)));
  }

  #[@test]
  public function multiplicationBothNegative() {
    $this->assertEquals(new BigInt(1), (new BigInt(-1))->multiply(new BigInt(-1)));
  }

  #[@test]
  public function multiplicationLarge() {
    $a= new BigInt('36486872398567981638843143228254546051651870');
    $b= new BigInt('50602640980469152653015');
    $r= new BigInt('1846332104484924953979619544386780054125593365543499568033685888050');
    $this->assertEquals($r, $a->multiply($b));
  }

  #[@test]
  public function multiplicationWithPrimitive() {
    $this->assertEquals(new BigInt(6100), (new BigInt(-1))->multiply(-6100));
  }

  #[@test]
  public function division() {
    $this->assertEquals(new BigInt(2), (new BigInt(4))->divide(new BigInt(2)));
  }

  #[@test]
  public function divisionOneNegative() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-4))->divide(new BigInt(2)));
  }

  #[@test]
  public function divisionBothNegative() {
    $this->assertEquals(new BigInt(2), (new BigInt(-4))->divide(new BigInt(-2)));
  }

  #[@test]
  public function divisionLarge() {
    $a= new BigInt('1846332104484924953979619544386780054125593365543499568033685888050');
    $b= new BigInt('36486872398567981638843143228254546051651870');
    $r= new BigInt('50602640980469152653015');
    $this->assertEquals($r, $a->divide($b));
  }

  #[@test]
  public function integerDivision1() {
    $this->assertEquals(new BigInt(0), (new BigInt(1))->divide(new BigInt(2)));
  }

  #[@test]
  public function integerDivision2() {
    $this->assertEquals(new BigInt(2), (new BigInt(8))->divide(new BigInt(3)));
  }

  #[@test]
  public function integerDivision3() {
    $this->assertEquals(new BigInt(-2), (new BigInt(-8))->divide(new BigInt(3)));
  }

  #[@test]
  public function divisionWithPrimitive() {
    $this->assertEquals(new BigInt(6100), (new BigInt(37210000))->divide(6100));
  }

  #[@test, @expect(IllegalArgumentException::class)]
  public function divisionByZero() {
    (new BigInt(5))->divide(new BigInt(0));
  }

  #[@test]
  public function moduloWithoutRemainder() {
    $this->assertEquals(new BigInt(0), (new BigInt(4))->modulo(new BigInt(2)));
  }

  #[@test]
  public function moduloWithRemainder() {
    $this->assertEquals(new BigInt(1), (new BigInt(5))->modulo(new BigInt(2)));
  }

  #[@test, @expect(IllegalArgumentException::class)]
  public function moduloZero() {
    (new BigInt(5))->modulo(new BigInt(0));
  }

  #[@test]
  public function moduloWithPrimitive() {
    $this->assertEquals(new BigInt(1), (new BigInt(5))->modulo(2));
  }

  #[@test]
  public function power() {
    $this->assertEquals(new BigInt(16), (new BigInt(2))->power(new BigInt(4)));
  }

  #[@test]
  public function powerNegativeOne() {
    $this->assertEquals(new BigInt(0), (new BigInt(2))->power(new BigInt(-1)));
  }

  #[@test]
  public function powerOfZero() {
    $this->assertEquals(new BigInt(0), (new BigInt(0))->power(new BigInt(2)));
  }

  #[@test]
  public function powerOfZeroZero() {
    $this->assertEquals(new BigInt(1), (new BigInt(0))->power(new BigInt(0)));
  }

  #[@test]
  public function powerOfZeroNegative() {
    $this->assertEquals(new BigInt(0), (new BigInt(0))->power(new BigInt(-2)));
  }

  #[@test]
  public function powerOfNegativeNumberEven() {
    $this->assertEquals(new BigInt(4), (new BigInt(-2))->power(new BigInt(2)));
  }

  #[@test]
  public function powerOfNegativeNumberOdd() {
    $this->assertEquals(new BigInt(-8), (new BigInt(-2))->power(new BigInt(3)));
  }

  #[@test]
  public function powerOne() {
    $this->assertEquals(new BigInt(2), (new BigInt(2))->power(new BigInt(1)));
  }

  #[@test]
  public function powerZero() {
    $this->assertEquals(new BigInt(1), (new BigInt(2))->power(new BigInt(0)));
  }

  #[@test]
  public function powerWithPrimitive() {
    $this->assertEquals(new BigInt(4), (new BigInt(2))->power(2));
  }

  #[@test]
  public function bitwiseAnd() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->bitwiseAnd(new BigInt(1)));
  }

  #[@test]
  public function bitwiseAndZero() {
    $this->assertEquals(new BigInt(0), (new BigInt(1))->bitwiseAnd(new BigInt(0)));
  }

  #[@test]
  public function bitwiseAndDifferentSizes() {
    $this->assertEquals(new BigInt(0x0000), (new BigInt(0x0100))->bitwiseAnd(new BigInt(0x0001)));
  }

  #[@test]
  public function bitwiseAndModifierMask() {
    $mask= MODIFIER_PUBLIC | MODIFIER_PROTECTED | MODIFIER_PRIVATE;
    $this->assertEquals(
      new BigInt(MODIFIER_PUBLIC), 
      (new BigInt(MODIFIER_PUBLIC | MODIFIER_STATIC))->bitwiseAnd(new BigInt($mask))
    );
  }

  #[@test]
  public function bitwiseAndLarge() {
    $this->assertEquals(
      new BigInt('18446744073709551616'), 
      (new BigInt('18446744073709551617'))->bitwiseAnd(new BigInt('18446744073709551616'))
    );
  }

  #[@test]
  public function bitwiseOr() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->bitwiseOr(new BigInt(1)));
  }

  #[@test]
  public function bitwiseOrZero() {
    $this->assertEquals(new BigInt(1), (new BigInt(1))->bitwiseOr(new BigInt(0)));
  }

  #[@test]
  public function bitwiseOrTwo() {
    $this->assertEquals(new BigInt(3), (new BigInt(1))->bitwiseOr(new BigInt(2)));
  }

  #[@test]
  public function bitwiseOrThree() {
    $this->assertEquals(new BigInt(3), (new BigInt(1))->bitwiseOr(new BigInt(3)));
  }

  #[@test]
  public function bitwiseOrModifierMask() {
    $this->assertEquals(
      new BigInt(MODIFIER_PUBLIC | MODIFIER_STATIC), 
      (new BigInt(MODIFIER_PUBLIC))->bitwiseOr(new BigInt(MODIFIER_STATIC))
    );
  }

  #[@test]
  public function bitwiseOrLarge() {
    $this->assertEquals(
      new BigInt('18446744078004518912'), 
      (new BigInt('4294967296'))->bitwiseOr(new BigInt('18446744073709551616'))
    );
  }

  #[@test]
  public function bitwiseXorOneZero() {
    $this->assertEquals(
      new BigInt(1), 
      (new BigInt(1))->bitwiseXor(new BigInt(0))
    );
  }

  #[@test]
  public function bitwiseXorDifferenSizes() {
    $this->assertEquals(
      new BigInt(256), 
      (new BigInt(1))->bitwiseXor(new BigInt(257))
    );
  }

  #[@test]
  public function leftShift() {
    $this->assertEquals(
      new BigInt(512), 
      (new BigInt(2))->shiftLeft(new BigInt(8))
    );
  }

  #[@test]
  public function rightShift() {
    $this->assertEquals(
      new BigInt(2), 
      (new BigInt(512))->shiftRight(new BigInt(8))
    );
  }

  #[@test]
  public function positive_string_representation() {
    $this->assertEquals('math.BigInt(4)', (new BigInt(4))->toString());
  }

  #[@test]
  public function negative_string_representation() {
    $this->assertEquals('math.BigInt(-4)', (new BigInt(-4))->toString());
  }
}
