<?php namespace math;

use lang\IllegalArgumentException;

/**
 * A big float
 *
 * @see   math.BigNum
 * @test  math.unittest.ComparisonTest
 * @test  math.unittest.BigFloatTest
 * @test  math.unittest.BigIntAndFloatTest
 */
class BigFloat extends BigNum {

  /**
   * Creates a new BigFloat instance
   *
   * @param  int|float|string $in
   */
  public function __construct($in) {
    $this->num= false !== strpos($in, '.') ? rtrim(rtrim($in, '0'), '.') : (string)$in;
  }

  /**
   * +
   *
   * @param  math.BigNum|int|float|string $other
   * @return math.BigNum
   */
  public function add($other) {
    return new self(bcadd($this->num, $other instanceof self ? $other->num : $other));
  }

  /**
   * -
   *
   * @param  math.BigNum|int|float|string $other
   * @return math.BigNum
   */
  public function subtract($other) {
    return new self(bcsub($this->num, $other instanceof self ? $other->num : $other));
  }

  /**
   * *
   *
   * @param  math.BigNum|int|float|string $other
   * @return math.BigNum
   */
  public function multiply($other) {
    return new self(bcmul($this->num, $other instanceof self ? $other->num : $other));
  }

  /**
   * /
   *
   * @param  math.BigNum|int|float|string $other
   * @return math.BigNum
   */
  public function divide($other) {
    try {
      if (null === ($r= bcdiv($this->num, $other instanceof self ? $other->num : $other))) {
        $e= key(\xp::$errors[__FILE__][__LINE__- 1]);
        \xp::gc(__FILE__);
        throw new IllegalArgumentException($e);
      }
      return new self($r);
    } catch (\Error $e) {  // PHP 8.0
      throw new IllegalArgumentException($e->getMessage());
    }
  }

  /**
   * ^
   *
   * @see    http://en.wikipedia.org/wiki/Exponentiation
   * @param  math.BigNum|int|float|string $other
   * @return math.BigNum
   */
  public function power($other) {
    if (0 === bccomp($this->num, 0) && -1 === bccomp($other instanceof self ? $other->num : $other, 0)) {
      throw new IllegalArgumentException('Negative power of zero');
    }

    return new self(bcpow($this->num, $other instanceof self ? $other->num : $other));
  }

  /**
   * Returns the next lowest "integer" value by rounding down value if necessary. 
   *
   * @return self
   */
  public function ceil() {
    return new self(false === strpos($this->num, '.') 
      ? $this->num 
      : ('-' === $this->num[0] ? bcsub($this->num, 0, 0) : bcadd($this->num, 1, 0))
    );
  }

  /**
   * Returns the next highest "integer" value by rounding up value if necessary
   *
   * @return self
   */
  public function floor() {
    return new self(false === strpos($this->num, '.') 
      ? $this->num 
      : ('-' === $this->num[0] ? bcsub($this->num, 1, 0) : bcadd($this->num, 0, 0))
    );
  }

  /**
   * Returns the rounded value of val to specified precision (number of digits 
   * after the decimal point).
   *
   * @param  int $precision
   * @return self
   */
  public function round($precision= 0) {
    if (false === strpos($this->num, '.')) return new self($this->num);
    
    $a= '0.'.str_repeat('0', $precision).'5';
    return new self(false === strpos($this->num, '.') 
      ? $this->num 
      : ('-' === $this->num[0] ? bcsub($this->num, $a, $precision) : bcadd($this->num, $a, $precision))
    );
  }
}