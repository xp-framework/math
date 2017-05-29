<?php namespace math;

/**
 * A big number
 *
 * @see      php://pack
 * @see      php://unpack
 * @see      http://pear.php.net/package/Math_BigInteger/docs/latest/__filesource/fsource_Math_BigInteger__Math_BigInteger-1.0.0RC3BigInteger.php.html#a1669
 * @see      http://sine.codeplex.com/SourceControl/changeset/view/57274#1535069 
 * @ext      bcmath
 */
abstract class BigNum implements \lang\Value {
  protected $num;

  static function __static() {
    bcscale(ini_get('precision') ?: 14);
  }
  
  /**
   * +
   *
   * @param   var other
   * @return  math.BigNum
   */
  public function add($other) {
    return new $this(bcadd($this->num, $other instanceof self ? $other->num : $other));
  }

  /**
   * -
   *
   * @param   var other
   * @return  math.BigNum
   */
  public function subtract($other) {
    return new $this(bcsub($this->num, $other instanceof self ? $other->num : $other));
  }

  /**
   * *
   *
   * @param   var other
   * @return  math.BigNum
   */
  public function multiply($other) {
    return new $this(bcmul($this->num, $other instanceof self ? $other->num : $other));
  }

  /**
   * /
   *
   * @param   var other
   * @return  math.BigNum
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
  public function toString() { return nameof($this).'('.$this->num.')'; }

  /** @return string */
  public function hashCode() { return $this->num; }

  /**
   * Compare another value to this bignum
   *
   * @param  var $value
   * @return int
   */
  public function compareTo($value) {
    return $value instanceof $this ? bccomp($this->num, $value->num) : 1;
  }

  /**
   * Returns whether another object is equal to this
   *
   * @param  var $value
   * @return bool
   */
  public function equals($value) {
    return $value instanceof $this && 0 === bccomp($this->num, $value->num);
  }
}
