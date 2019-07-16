<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use Tamtamchik\NameCase\Formatter;

final class NameCaseTest extends TestCase
{
    private $names = [
        "Keith", "Yuri's", "Leigh-Williams", "McCarthy",
        // Mac exceptions
        "Machin", "Machlin", "Machar",
        "Mackle", "Macklin", "Mackie",
        "Macquarie", "Machado", "Macevicius",
        "Maciulis", "Macias", "MacMurdo",
        // General
        "O'Callaghan", "St. John", "von Streit",
        "van Dyke", "Van", "ap Llwyd Dafydd",
        "al Fahd", "Al",
        "el Grecco",
        "ben Gurion", "Ben",
        "da Vinci",
        "di Caprio", "du Pont", "de Legate",
        "del Crond", "der Sind", "van der Post", "van den Thillart", "ter Zanden", "ten Brink",
        "von Trapp", "la Poisson", "le Figaro",
        "Mack Knife", "Dougal MacDonald",
        "Ruiz y Picasso", "Dato e Iradier", "Mas i Gavarró",
        // Roman numerals
        "Henry VIII", "Louis III", "Louis XIV",
        "Charles II", "Fred XLIX", "Yusof bin Ishak",
    ];

    /** Test base functionality. */
    public function testNameCase()
    {
        foreach ($this->names as $name) {
            $this->assertEquals($name, str_name_case(mb_strtolower($name)));
        }
    }

    /** Test base UTF-8 support. */
    public function testInternationalization()
    {
        $properCased = 'Iñtërnâtiônàlizætiøn';
        $this->assertEquals($properCased, str_name_case(mb_strtolower($properCased)));
    }

    /** Test static call. */
    public function testStatic()
    {
        foreach ($this->names as $name) {
            $this->assertEquals($name, Formatter::nameCase(mb_strtolower($name)));
        }
    }

    /** Test instantiation. */
    public function testInstantiation()
    {
        $formatter = new Formatter();

        foreach ($this->names as $name) {
            $this->assertEquals($name, $formatter->nameCase(mb_strtolower($name)));
        }
    }

    /** Test empty string. */
    public function testEmptyString()
    {
        $this->assertEquals("", str_name_case(""));
    }
}
