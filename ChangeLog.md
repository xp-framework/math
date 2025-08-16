XP Math changelog
=================

## ?.?.? / ????-??-??

## 10.0.0 / ????-??-??

**Heads up:** Dropped support for PHP < 7.4, see xp-framework/rfc#343
  (@thekid)
* Merged PR #6: Make `Big(Int|Float)::power()` consistent with IEEE 754
  rules, see issue #5.
  (@thekid)

## 9.3.0 / 2024-03-24

* Made compatible with XP 12 - @thekid

## 9.2.0 / 2024-03-01

* Added PHP 8.4 to the test matrix - @thekid
* Merged PR #4: Migrate to new testing library - @thekid

## 9.1.0 / 2022-03-25

* Deprecated doubleValue() in favor of floatValue() - @thekid
* Merged PR #3: Comparison and equality - @thekid

## 9.0.2 / 2022-03-25

* Fixed issue #2: Bit shifting introduces "decimals" - @thekid

## 9.0.1 / 2021-10-21

* Made compatible with XP 11 - @thekid

## 9.0.0 / 2020-04-10

* Fixed PHP 8.0 compatibility when dividing by zero - @thekid
* Implemented xp-framework/rfc#334: Drop PHP 5.6:
  . **Heads up:** Minimum required PHP version now is PHP 7.0.0
  . Rewrote code base, grouping use statements
  (@thekid)

## 8.0.1 / 2019-12-01

* Made compatible with XP 10 - @thekid

## 8.0.0 / 2017-05-29

* **Heads up:** Dropped PHP 5.5 support - @thekid
* Merged PR #1: Forward compatibility with XP 9.0.0 - @thekid

## 7.1.0 / 2016-08-28

* Added forward compatibility with XP 8.0.0 - @thekid

## 7.0.0 / 2016-02-21

* **Adopted semantic versioning. See xp-framework/rfc#300** - @thekid 
* Added version compatibility with XP 7 - @thekid

## 6.6.0 / 2014-12-08

* Extracted from the XP Framework's core - @thekid