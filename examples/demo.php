<?php

use Tamtamchik\NameCase\Formatter;

require_once __DIR__ . '/../vendor/autoload.php';

use function Tamtamchik\NameCase\str_name_case;

// As static call
echo 'KEITH => ' . Formatter::nameCase('KEITH') . PHP_EOL;
echo 'LEIGH-WILLIAMS => ' . Formatter::nameCase('LEIGH-WILLIAMS') . PHP_EOL;
echo 'MCCARTHY => ' . Formatter::nameCase('MCCARTHY') . PHP_EOL;

// As instance call
$formatter = new Formatter();
echo 'O\'CALLAGHAN => ' . $formatter->nameCase('O\'CALLAGHAN') . PHP_EOL;
echo 'ST. JOHN => ' . $formatter->nameCase('ST. JOHN') . PHP_EOL;
echo 'VON STREIT => ' . $formatter->nameCase('VON STREIT') . PHP_EOL;
echo 'AP LLWYD DAFYDD => ' . $formatter->nameCase('AP LLWYD DAFYDD') . PHP_EOL;

// As function call
echo 'HENRY VIII => ' . str_name_case('HENRY VIII') . PHP_EOL;
echo 'VAN DYKE => ' . str_name_case('VAN DYKE') . PHP_EOL;
echo 'PRINCE PHILIP, DUKE OF EDINBURGH => ' . str_name_case('PRINCE PHILIP, DUKE OF EDINBURGH') . PHP_EOL;
echo 'LOUIS XIV => ' . str_name_case('LOUIS XIV') . PHP_EOL;
echo 'KEITH => ' . str_name_case('KEITH') . PHP_EOL;

echo PHP_EOL;
echo '*** lazy = true (default) ***' . PHP_EOL;
echo 'Da Vinci => ' . $formatter->nameCase('Da Vinci', ['lazy' => true]) . PHP_EOL;
echo '*** lazy = false ***' . PHP_EOL;
echo 'Da Vinci => ' . $formatter->nameCase('Da Vinci', ['lazy' => false]) . PHP_EOL;

echo PHP_EOL;
echo '*** irish = true (default) ***' . PHP_EOL;
echo 'JOHN MACDONALD => ' . $formatter->nameCase('JOHN MACDONALD', ['irish' => true]) . PHP_EOL;
echo '*** irish = false ***' . PHP_EOL;
echo 'JOHN MACDONALD => ' . $formatter->nameCase('JOHN MACDONALD', ['irish' => false]) . PHP_EOL;

echo PHP_EOL;
echo '*** spanish = true ***' . PHP_EOL;
echo 'EL PASO => ' . $formatter->nameCase('EL PASO', ['spanish' => true]) . PHP_EOL;
echo '*** spanish = false (default) ***' . PHP_EOL;
echo 'EL PASO => ' . $formatter->nameCase('EL PASO', ['spanish' => false]) . PHP_EOL;

echo PHP_EOL;
echo '*** roman = true (default) ***' . PHP_EOL;
echo 'NA LIV => ' . $formatter->nameCase('NA LIV', ['roman' => true]) . PHP_EOL;
echo '*** roman = false ***' . PHP_EOL;
echo 'NA LIV => ' . $formatter->nameCase('NA LIV', ['roman' => false]) . PHP_EOL;

echo PHP_EOL;
echo '*** hebrew = true (default) ***' . PHP_EOL;
echo 'BEN GURION => ' . $formatter->nameCase('BEN GURION', ['hebrew' => true]) . PHP_EOL;
echo '*** hebrew = false ***' . PHP_EOL;
echo 'BEN GURION => ' . $formatter->nameCase('BEN GURION', ['hebrew' => false]) . PHP_EOL;

echo PHP_EOL;
echo '*** postnominal = true (default) ***' . PHP_EOL;
echo 'BRIAN MAY, CBE, PHD => ' . $formatter->nameCase('BRIAN MAY, CBE, PHD', ['postnominal' => true]) . PHP_EOL;
echo '*** postnominal = false ***' . PHP_EOL;
echo 'BRIAN MAY, CBE, PHD => ' . $formatter->nameCase('BRIAN MAY, CBE, PHD', ['postnominal' => false]) . PHP_EOL;
