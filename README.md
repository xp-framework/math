Math
====

[![Build status on GitHub](https://github.com/xp-framework/math/workflows/Tests/badge.svg)](https://github.com/xp-framework/math/actions)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Requires PHP 7.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_0plus.svg)](http://php.net/)
[![Supports PHP 8.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-8_0plus.svg)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-framework/math/version.png)](https://packagist.org/packages/xp-framework/math)

Big number handling

API: BigInt
-----------

```php
public class math.BigInt extends math.BigNum {

  public math.BigInt __construct(string $in)

  protected static string bytesOf(var $n)

  public math.BigNum add(var $other)
  public math.BigNum subtract(var $other)
  public math.BigNum multiply(var $other)
  public math.BigNum divide(var $other)
  public math.BigNum add0(var $other)
  public math.BigNum subtract0(var $other)
  public math.BigNum multiply0(var $other)
  public math.BigNum divide0(var $other)
  public math.BigNum power(var $other)
  public math.BigNum modulo(var $other)
  public math.BigNum bitwiseAnd(var $other)
  public math.BigNum bitwiseOr(var $other)
  public math.BigNum bitwiseXor(var $other)
  public math.BigNum shiftRight(var $shift)
  public math.BigNum shiftLeft(var $shift)
  public int byteValue()
  public int intValue()
  public int doubleValue()
}
```

API: BigFloat
-------------

```php
public class math.BigFloat extends math.BigNum {
  protected var math.BigNum::$num

  public math.BigFloat __construct(string $in)

  public math.BigNum add(var $other)
  public math.BigNum subtract(var $other)
  public math.BigNum multiply(var $other)
  public math.BigNum divide(var $other)
  public math.BigNum power(var $other)
  public math.BigFloat ceil()
  public math.BigFloat floor()
  public math.BigFloat round([int $precision= 0])
  public bool equals(lang.Generic $cmp)
  public int intValue()
  public int doubleValue()
}
```