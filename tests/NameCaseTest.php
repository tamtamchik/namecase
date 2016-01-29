<?php namespace Tamtamchik\NameCase\Test;

class NameCaseTest extends \PHPUnit_Framework_TestCase
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
        "del Crond", "der Sind", "van der Post",
        "von Trapp", "la Poisson", "le Figaro",
        "Mack Knife", "Dougal MacDonald",
        "Ruiz y Picasso", "Dato e Iradier", "Mas i Gavarró",
        // Roman numerals
        "Henry VIII", "Louis III", "Louis XIV",
        "Charles II", "Fred XLIX", "Yusof bin Ishak",
    ];

    /** Test base NameCase. */
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
}
