# NameCase

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![SensioLabsInsight][ico-insight]][link-insight]

Forenames and surnames are often stored either wholly in UPPERCASE or wholly in lowercase. This package allows you to convert names into the correct case where possible. Although forenames and surnames are normally stored separately if they do appear in a single string, whitespace separated, NameCase deals correctly with them.  

Currently correctly name cases names which include any of the following:  

```
Mc, Mac, al, el, ap, da, de, delle, della, di, du, del, der, den, ten, ter, la, le, lo, van and von.
```

It correctly deals with names which contain apostrophes and hyphens too.

> **Warning!** This readme is for version 2.0.x. If you need PHP 5 compatible version, please use 1.0.x! [README](https://github.com/tamtamchik/namecase/blob/1.0.x/README.md)

## Install

Via Composer

``` bash
$ composer require tamtamchik/namecase
```

## Usage

``` php
use \Tamtamchik\NameCase\Formatter;

// As a static call
Formatter::nameCase("KEITH");               // => Keith
Formatter::nameCase("LEIGH-WILLIAMS");      // => Leigh-Williams
Formatter::nameCase("MCCARTHY");            // => McCarthy
Formatter::nameCase("O'CALLAGHAN");         // => O'Callaghan
Formatter::nameCase("ST. JOHN");            // => St. John
Formatter::nameCase("VON STREIT");          // => von Streit
Formatter::nameCase("AP LLWYD DAFYDD");     // => ap Llwyd Dafydd
Formatter::nameCase("HENRY VIII");          // => Henry VIII
Formatter::nameCase("VAN DYKE");            // => van Dyke

// Or as an instance
$formatter = new Formatter();
$formatter->nameCase("LOUIS XIV");          // => Louis XIV
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing & Demo

``` bash
$ composer tests
$ composer demo
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email <yuri.tam.tkachenko@gmail.com> instead of using the issue tracker.

## Acknowledgements

This library is a port of the [Perl library](https://metacpan.org/release/BARBIE/Lingua-EN-NameCase-1.19), and owes most of its functionality to the Perl version by Mark Summerfield.  
I also used some solutions from [Ruby version](https://github.com/tenderlove/namecase) by Aaron Patterson.  
Any bugs in the PHP port are my fault.

## Credits

Original PERL `Lingua::EN::NameCase` Version:

- Copyright &copy; Mark Summerfield 1998-2014. All Rights Reserved.
- Copyright &copy; Barbie 2014-2015. All Rights Reserved.

Ruby Version:

- Copyright &copy; Aaron Patterson 2006. All Rights Reserved.

PHP Version:

- [Yuri Tkachenko][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/tamtamchik/namecase.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/tamtamchik/namecase/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/tamtamchik/namecase.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/tamtamchik/namecase.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tamtamchik/namecase.svg?style=flat-square
[ico-insight]: https://img.shields.io/sensiolabs/i/660fea1e-d105-4064-9caa-f47e8a282f2a.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tamtamchik/namecase
[link-travis]: https://travis-ci.org/tamtamchik/namecase
[link-scrutinizer]: https://scrutinizer-ci.com/g/tamtamchik/namecase/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/tamtamchik/namecase
[link-downloads]: https://packagist.org/packages/tamtamchik/namecase
[link-author]: https://github.com/tamtamchik
[link-contributors]: ../../contributors
[link-insight]: https://insight.sensiolabs.com/projects/660fea1e-d105-4064-9caa-f47e8a282f2a
