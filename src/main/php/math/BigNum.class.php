<?php namespace math;

use lang\Value;

/**
 * A big number
 *
 * @see      php://pack
 * @see      php://unpack
 * @see      http://pear.php.net/package/Math_BigInteger/docs/latest/__filesource/fsource_Math_BigInteger__Math_BigInteger-1.0.0RC3BigInteger.php.html#a1669
 * @see      http://sine.codeplex.com/SourceControl/changeset/view/57274#1535069 
 * @ext      bcmath
 */
abstract class BigNum implements Value {
  protected $num;

  static function __static() {
    bcscale(ini_get('precision') ?: 14);
  }
  
  /**
   * +
   *
   * @param  self|int|float|string $other
   * @return self
   */
  public abstract function add($other);

  /**
   * -
   *
   * @param  self|int|float|string $other
   * @return self
   */
  public abstract function subtract($other);

  /**
   * *
   *
   * @param  self|int|float|string $other
   * @return self
   */
  public abstract function multiply($other);

  /**
   * /
   *
   * @param  self|int|float|string $other
   * @return self
   */
  public abstract function divide($other);
  
  /**
   * Returns an integer representing this bignum
   *
   * @return int
   */
  public function intValue() { return (int)substr($this->num, 0, strcspn($this->num, '.')); }

  /**
   * Returns a double representing this bignum
   *
   * @return double
   */
  public function doubleValue() { return (double)$this->num; }

  /** @return string */
  public function __toString() { return (string)$this->num; }

  /** @return string */
  public function toString() { return nameof($this).'('.$this->num.')'; }

  /** @return string */
  public function hashCode() { return 'B'.(string)$this->num; }

  /**
   * Compare another value to this bignum. Only regards instances of
   * the same class as equal. For comparison with arbitrary values,
   * use `compare()` instead.
   *
   * @param  var $value
   * @return int
   */
  public function compareTo($value) {
    return $value instanceof $this ? bccomp($this->num, $value->num) : 1;
  }

  /**
   * Compare another value to this bignum. Returns 1 if this number is larger
   * than the given value, 0 if they are the same, and -1 if this number is
   * smaller.
   *
   * @param  self|int|float|string $other
   * @param  ?int $precision
   * @return int
   */
  public function compare($other, $precision= null) {
    return bccomp(
      $this->num,
      $other instanceof self ? $other->num : $other,
      PHP_VERSION_ID >= 80000 ? $precision : $precision ?? bcscale(null)
    );
  }

  /**
   * Returns whether another value is equal to this bignum.
   *
   * @param  self|int|float|string $other
   * @param  ?int $precision
   * @return bool
   */
  public function equals($other, $precision= null) {
    return 0 === bccomp(
      $this->num,
      $other instanceof self ? $other->num : $other,
      PHP_VERSION_ID >= 80000 ? $precision : $precision ?? bcscale(null)
    );
  }
}