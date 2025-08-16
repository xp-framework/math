Math
====

[![Build status on GitHub](https://github.com/xp-framework/math/workflows/Tests/badge.svg)](https://github.com/xp-framework/math/actions)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Requires PHP 7.4+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_4plus.svg)](http://php.net/)
[![Supports PHP 8.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-8_0plus.svg)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-framework/math/version.svg)](https://packagist.org/packages/xp-framework/math)

Big number handling

API: BigInt
-----------

```php
public class math.BigInt extends math.BigNum {
  public math.BigInt __construct(int|float|string|parent $in)

  public math.BigNum add(int|float|string|parent $other)
  public math.BigNum subtract(int|float|string|parent $other)
  public math.BigNum multiply(int|float|string|parent $other)
  public math.BigNum divide(int|float|string|parent $other)
  public math.BigNum add0(int|float|string|parent $other)
  public math.BigNum subtract0(int|float|string|parent $other)
  public math.BigNum multiply0(int|float|string|parent $other)
  public math.BigNum divide0(int|float|string|parent $other)
  public math.BigNum power(int|float|string|parent $other)
  public math.BigNum modulo(int|float|string|parent $other)
  public math.BigNum bitwiseAnd(int|float|string|parent $other)
  public math.BigNum bitwiseOr(int|float|string|parent $other)
  public math.BigNum bitwiseXor(int|float|string|parent $other)
  public math.BigNum shiftRight(int|float|string|parent $shift)
  public math.BigNum shiftLeft(int|float|string|parent $shift)
  public int byteValue()
  public int intValue()
  public float floatValue()
}
```

API: BigFloat
-------------

```php
public class math.BigFloat extends math.BigNum {
  public math.BigFloat __construct(int|float|string|parent $in)

  public math.BigNum add(int|float|string|parent $other)
  public math.BigNum subtract(int|float|string|parent $other)
  public math.BigNum multiply(int|float|string|parent $other)
  public math.BigNum divide(int|float|string|parent $other)
  public math.BigNum power(int|float|string|parent $other)
  public math.BigFloat ceil()
  public math.BigFloat floor()
  public math.BigFloat round([int $precision= 0])
  public int compare(int|float|string|parent $other, ?int $precision= null)
  public bool equals(int|float|string|parent $other, ?int $precision= null)
  public int intValue()
  public float floatValue()
}
```