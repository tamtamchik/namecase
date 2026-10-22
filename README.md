<p align="center">
  <img src="docs/assets/namecase-readme-banner.png" alt="NameCase" width="100%">
</p>

<p align="center">
  <strong>Personal name capitalization for PHP.</strong>
</p>

<p align="center">
  <a href="https://packagist.org/packages/tamtamchik/namecase"><img alt="Latest version on Packagist" src="https://img.shields.io/packagist/v/tamtamchik/namecase?style=flat-square"></a>
  <a href="https://packagist.org/packages/tamtamchik/namecase"><img alt="Total downloads" src="https://img.shields.io/packagist/dt/tamtamchik/namecase?style=flat-square"></a>
  <a href="https://packagist.org/packages/tamtamchik/namecase"><img alt="PHP 7.3 or later" src="https://img.shields.io/badge/PHP-%3E%3D7.3-777BB4?style=flat-square&logo=php&logoColor=white"></a>
  <a href="https://github.com/tamtamchik/namecase/actions/workflows/tests.yml"><img alt="CI" src="https://img.shields.io/github/actions/workflow/status/tamtamchik/namecase/tests.yml?branch=master&style=flat-square&label=CI"></a>
  <a href="https://scrutinizer-ci.com/g/tamtamchik/namecase/"><img alt="Scrutinizer build" src="https://img.shields.io/scrutinizer/build/g/tamtamchik/namecase/master?style=flat-square"></a>
  <a href="https://scrutinizer-ci.com/g/tamtamchik/namecase/"><img alt="Scrutinizer quality" src="https://img.shields.io/scrutinizer/quality/g/tamtamchik/namecase/master?style=flat-square"></a>
  <a href="https://scrutinizer-ci.com/g/tamtamchik/namecase/"><img alt="Code coverage" src="https://img.shields.io/scrutinizer/coverage/g/tamtamchik/namecase/master?style=flat-square"></a>
  <a href="LICENSE.md"><img alt="License MIT" src="https://img.shields.io/badge/license-MIT-22c55e?style=flat-square"></a>
</p>

<p align="center">
  <a href="#quick-start">Quick Start</a> ·
  <a href="#usage">Usage</a> ·
  <a href="#options">Options</a> ·
  <a href="#development-setup">Development Setup</a> ·
  <a href="#documentation">Documentation</a> ·
  <a href="#support">Support</a>
</p>

NameCase converts names stored in UPPERCASE or lowercase into conventional
capitalization where possible. It handles full names, apostrophes, hyphens,
particles such as `van` and `de`, Irish `Mc` and `Mac` prefixes, Roman numerals,
and post-nominal letters such as `PhD`.

## Quick Start

Requires PHP 7.3 or later and the `mbstring` extension.

Install with Composer:

```shell
composer require tamtamchik/namecase
```

Format a name:

```php
require 'vendor/autoload.php';

use Tamtamchik\NameCase\Formatter;

echo Formatter::nameCase("O'CALLAGHAN");
// O'Callaghan
```

This README covers version 3.x. For PHP 5, use version 1.0.x and its
[README](https://github.com/tamtamchik/namecase/blob/1.0.x/README.md#namecase).

## Usage

### Static Calls

```php
use Tamtamchik\NameCase\Formatter;

Formatter::nameCase('KEITH');              // Keith
Formatter::nameCase('LEIGH-WILLIAMS');     // Leigh-Williams
Formatter::nameCase('MCCARTHY');           // McCarthy
Formatter::nameCase("O'CALLAGHAN");        // O'Callaghan
Formatter::nameCase('ST. JOHN');           // St. John
Formatter::nameCase('VON STREIT');         // von Streit
Formatter::nameCase('AP LLWYD DAFYDD');     // ap Llwyd Dafydd
Formatter::nameCase('HENRY VIII');         // Henry VIII
Formatter::nameCase('VAN DYKE');            // van Dyke
```

### Instances and Function Calls

The same formatter is available through an instance or a namespaced function:

```php
use Tamtamchik\NameCase\Formatter;
use function Tamtamchik\NameCase\str_name_case;

$formatter = new Formatter();
$formatter->nameCase('LOUIS XIV'); // Louis XIV

str_name_case('JJ ABRAMS'); // JJ Abrams
```

### Mixed Case

The `lazy` option defaults to `true`: names recognized as mixed case are kept
as supplied. Set it to `false` to reformat them:

```php
Formatter::nameCase('Dougal MACDonald');                    // Dougal MACDonald
Formatter::nameCase('Dougal MACDonald', ['lazy' => false]); // Dougal MacDonald
Formatter::setOptions(['lazy' => true]);                    // Restore the default.
```

## Options

| Option | Default | Behavior when enabled |
| --- | --- | --- |
| `lazy` | `true` | Keep names recognized as mixed case unchanged. |
| `irish` | `true` | Apply `Mc` and `Mac` capitalization rules and exceptions. |
| `spanish` | `false` | Keep `El` and `La` capitalized and lowercase the conjunctions `y`, `e`, and `i`. |
| `roman` | `true` | Uppercase recognized Roman numerals, such as `VIII` and `XIV`. |
| `hebrew` | `true` | Lowercase `ben` and `bat` between name components. |
| `postnominal` | `true` | Restore recognized post-nominal letters, such as `PhD` and `CBE`. |

Set options through `Formatter::setOptions()`, the constructor, or the second
argument of `nameCase()` and `str_name_case()`:

```php
Formatter::setOptions(['spanish' => true]);
Formatter::nameCase('RUIZ Y PICASSO'); // Ruiz y Picasso

$formatter = new Formatter(['spanish' => false]);
$formatter->nameCase('EL GRECCO'); // el Grecco

str_name_case('EL PASO', ['spanish' => true]); // El Paso
Formatter::setOptions(['spanish' => false]);
```

Options are shared static state. Changes through any of these APIs affect
subsequent calls and all instances; omitted options retain their current values.
An instance does not hold an independent configuration.

### Exclude Post-Nominals

Exclude a recognized post-nominal when it is part of a name instead of a title:

```php
Formatter::excludePostNominals('MOst');
Formatter::nameCase('ČERNÝ MOST'); // Černý Most
```

Pass a string or an array of exact post-nominal spellings. Exclusions accumulate
and apply to subsequent calls across all instances.

## Development Setup

Install dependencies and run the checks used in CI:

```shell
composer install
composer validate --strict
composer tests
```

CI tests PHP 7.3, 7.4, and 8.0 through 8.5 with `mbstring` enabled.
Run the command-line examples with:

```shell
composer demo
```

## Documentation

- [Website](https://tamtamchik.github.io/namecase/): documentation on GitHub Pages.
- [Packagist](https://packagist.org/packages/tamtamchik/namecase): published versions and installation details.
- [Formatter](src/Formatter.php): capitalization rules, options, and post-nominal exclusions.
- [Function](src/function.php): the `str_name_case()` wrapper.
- [Tests](tests/): names, options, HTML entities, and post-nominals.
- [Changelog](CHANGELOG.md): release history.
- [CI](https://github.com/tamtamchik/namecase/actions/workflows/tests.yml): Composer validation and test results.

## Limitations

Capitalization rules are heuristics. Personal preferences and naming conventions
vary, so preserve a person's supplied spelling when it is known. Options can
resolve some ambiguities: for example, disable `roman` to avoid treating `Li`
as a Roman numeral.

## Security

Report vulnerabilities by emailing
[yuri.tam.tkachenko@gmail.com](mailto:yuri.tam.tkachenko@gmail.com).

## Contributing

See [Contributing](CONTRIBUTING.md) and the [Code of Conduct](CODE_OF_CONDUCT.md)
for guidelines.

## Acknowledgements

This library is a port of the
[Perl library Lingua::EN::NameCase](https://metacpan.org/release/BARBIE/Lingua-EN-NameCase-1.19)
by Mark Summerfield and Barbie. Some solutions come from
[Aaron Patterson's Ruby version](https://github.com/tenderlove/namecase).
Any bugs in the PHP port are my fault.

- Perl version: copyright Mark Summerfield 1998–2014 and Barbie 2014–2019.
- Ruby version: copyright Aaron Patterson 2006.
- PHP version: [Yuri Tkachenko](https://github.com/tamtamchik) and
  [all contributors](https://github.com/tamtamchik/namecase/graphs/contributors).

## Support

<p>
  <a href="https://www.buymeacoffee.com/tamtamchik"><img alt="Buy me a coffee" src="https://img.shields.io/badge/Buy%20Me%20A-Coffee-6F4E37?style=flat-square&logo=buymeacoffee&logoColor=white"></a>
</p>

## License

[MIT](LICENSE.md).
