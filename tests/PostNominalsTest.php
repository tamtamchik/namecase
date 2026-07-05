<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use Tamtamchik\NameCase\Formatter;

class PostNominalsTest extends TestCase
{
    /** Test `MBE` post-nominal */
    public function testMbe(): void
    {
        $this->assertEquals('Adisa Azapagic MBE Freng Frsc Ficheme', Formatter::nameCase('ADISA AZAPAGIC MBE FRENG FRSC FICHEME'));
    }

    public function testAmbiguousInitialsOnlyAtEnd(): void
    {
        $this->assertEquals('Ed Oates', Formatter::nameCase('ED OATES'));
        $this->assertEquals('Tam ED', Formatter::nameCase('TAM ED'));
        $this->assertEquals("Tam ED \n", Formatter::nameCase("TAM ED \n"));
    }

    public function testPerlPostNominalInitials(): void
    {
        $this->assertEquals('Tam MEd', Formatter::nameCase('TAM MED'));
        $this->assertEquals('Tam MPA', Formatter::nameCase('TAM MPA'));
        $this->assertEquals('Tam QTS', Formatter::nameCase('TAM QTS'));
        $this->assertEquals('Tam RIBA', Formatter::nameCase('TAM RIBA'));
        $this->assertEquals('Tam FRCA', Formatter::nameCase('TAM FRCA'));
        $this->assertEquals('Tam FRCPCH', Formatter::nameCase('TAM FRCPCH'));
    }

    public function testExcludeNull(): void
    {
        Formatter::excludePostNominals(null);
        $this->assertEquals('Černý MOst', Formatter::nameCase('ČERNÝ MOST'));
    }

    /** Test post-nominals exclusion. */
    public function testExcludeString(): void
    {
        Formatter::excludePostNominals('MOst');
        $this->assertEquals('Černý Most', Formatter::nameCase('ČERNÝ MOST'));
    }

    /** Test post-nominals exclusion. */
    public function testExcludeArray(): void
    {
        Formatter::excludePostNominals(['MOst']);
        $this->assertEquals('Černý Most', Formatter::nameCase('ČERNÝ MOST'));
    }
}
