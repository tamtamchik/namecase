<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use Tamtamchik\NameCase\Formatter;

final class NameCaseTest extends TestCase
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

    private $macNames = [
         // Mac exceptions
         "Machin", "Machlin", "Machar",
         "Mackle", "Macklin", "Mackie",
         "Macquarie", "Machado", "Macevicius",
         "Maciulis", "Macias", "MacMurdo",
     ];

     private $romanNames = [
         // Roman numerals
         "Henry VIII", "Louis III", "Louis XIV",
         "Charles II", "Fred XLIX",
     ];

    /** Test base UTF-8 support. */
    public function testInternationalization(): void
    {
        $properCased = 'Iñtërnâtiônàlizætiøn';
        $this->assertEquals($properCased, Formatter::nameCase(mb_strtolower($properCased)));
    }

    /** Test static call. */
    public function testStatic(): void
    {
        foreach ($this->names as $name) {
            $this->assertEquals($name, Formatter::nameCase(mb_strtolower($name)));
        }
    }

    /** Test instantiation. */
    public function testInstantiation(): void
    {
        $formatter = new Formatter();

        foreach ($this->names as $name) {
            $this->assertEquals($name, $formatter->nameCase(mb_strtolower($name)));
        }
    }

    /** Test empty string. */
    public function testEmptyString(): void
    {
        $this->assertEquals("", Formatter::nameCase(""));
    }

    /** Test irish exceptions. */
    public function testIrishExceptions(): void
    {
        foreach ($this->macNames as $name) {
            $this->assertEquals($name, Formatter::nameCase(mb_strtolower($name)));
        }
    }

    /** Test roman numerals. */
    public function testRomanNumerals(): void
    {
        foreach ($this->romanNames as $name) {
            $this->assertEquals($name, Formatter::nameCase(mb_strtolower($name)));
        }
    }

    /** Test initials */
    public function testInitials(): void
    {
        $this->assertEquals('J. F. Kennedy', Formatter::nameCase(mb_strtolower('J. F. Kennedy')));
        $this->assertEquals('J.F. Kennedy', Formatter::nameCase(mb_strtolower('J.F. Kennedy')));
    }
}
