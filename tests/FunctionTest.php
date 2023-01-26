<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use function Tamtamchik\NameCase\str_name_case;

final class FunctionTest extends TestCase
{
    private $names = [
        // General
        "Keith", "Yuri's", "Leigh-Williams", "McCarthy",
        "O'Callaghan", "St. John", "von Streit",
        "van Dyke", "Van", "ap Llwyd Dafydd",
        "al Fahd", "Al",
        "el Grecco",
        "ben Gurion", "Ben",
        "da Vinci",
        "di Caprio", "du Pont", "de Legate",
        "del Crond", "der Sind", "van der Post", "van den Thillart",
        "ter Zanden", "ten Brink",
        "von Trapp", "la Poisson", "le Figaro",
        "Mack Knife", "Dougal MacDonald",
        "Yusof bin Ishak",
    ];

    /** Test function call. */
    public function testCallWorks(): void
    {
        foreach ($this->names as $name) {
            $this->assertEquals($name, str_name_case(mb_strtolower($name)));
        }
    }

    /** Test function call. */
    public function testOptionsWork(): void
    {
        $this->assertEquals('Dougal MACDonald', str_name_case('Dougal MACDonald'));
        $this->assertEquals('Dougal MacDonald', str_name_case('Dougal MACDonald', ['lazy' => false]));
        $this->assertEquals('Dougal MACDonald', str_name_case('Dougal MACDonald', ['lazy' => true]));
    }
}
