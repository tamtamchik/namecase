<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use Tamtamchik\NameCase\Formatter;

class PostNominalsTest extends TestCase
{
    /** Test `MBE` post-nominal */
    public function testMbe() {
        $this->assertEquals('Adisa Azapagic MBE Freng Frsc Ficheme', Formatter::nameCase('ADISA AZAPAGIC MBE FRENG FRSC FICHEME'));
    }

    /** Test post-nominals exclusion. */
    public function testExcludeString() {
        Formatter::excludePostNominals('MOst');
        $this->assertEquals('Černý Most', Formatter::nameCase('ČERNÝ MOST'));
    }

    /** Test post-nominals exclusion. */
    public function testExcludeArray() {
        Formatter::excludePostNominals(['MOst']);
        $this->assertEquals('Černý Most', Formatter::nameCase('ČERNÝ MOST'));
    }
}
