<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use Tamtamchik\NameCase\Formatter;

class OptionsTest extends TestCase
{
    /** Test `lazy` option */
    public function testLazy()
    {
        $this->assertEquals('Dougal MACDonald', Formatter::nameCase('Dougal MACDonald'));
        Formatter::setOptions(['lazy' => false]);
        $this->assertEquals('Dougal MacDonald', Formatter::nameCase('Dougal MACDonald'));
        Formatter::setOptions(['lazy' => true]);
        $this->assertEquals('Dougal MACDonald', Formatter::nameCase('Dougal MACDonald'));
    }

    /** Test `irish` option */
    public function testIrish()
    {
        $this->assertEquals('Macmurdo', Formatter::nameCase('Macmurdo'));
        Formatter::setOptions(['irish' => false]);
        $this->assertEquals('Macmurdo', Formatter::nameCase('Macmurdo'));
        Formatter::setOptions(['irish' => true]);
        $this->assertEquals('Macmurdo', Formatter::nameCase('Macmurdo'));
    }

    /** Test `spanish` option */
    public function testSpanish()
    {
        $names = ["Ruiz y Picasso", "Dato e Iradier", "Mas i Gavarró"];
        $formatter = new Formatter(['spanish' => true]);
        $this->assertEquals('La Luna', $formatter->nameCase(mb_strtolower('La Luna')));
        $this->assertEquals('El Paso', $formatter->nameCase(mb_strtolower('El Paso')));
        foreach ($names as $name) {
            $this->assertEquals($name, $formatter->nameCase(mb_strtolower($name)));
        }
        $formatter->setOptions(['spanish' => false]);
        $this->assertEquals('la Luna', $formatter->nameCase(mb_strtolower('La Luna')));
        $this->assertEquals('el Paso', $formatter->nameCase(mb_strtolower('El Paso')));
        foreach ($names as $name) {
            $this->assertNotEquals($name, $formatter->nameCase(mb_strtolower($name)));
        }
    }

    /** Test `roman` option */
    public function testRoman()
    {
        Formatter::setOptions(['roman' => false]);
        $this->assertEquals('Na Li', Formatter::nameCase(mb_strtolower('Na Li')));

        Formatter::setOptions(['roman' => true]);
        $this->assertEquals('Na LI', Formatter::nameCase(mb_strtolower('Na Li')));
    }

    /** Test `hebrew` option */
    public function testHebrew()
    {
        Formatter::setOptions(['hebrew' => false]);
        $this->assertEquals('Aharon Ben Amram Ha-Kohein', Formatter::nameCase(mb_strtolower('Aharon BEN Amram Ha-Kohein')));
        $this->assertEquals('Ben Gurion', Formatter::nameCase(mb_strtolower('ben Gurion')));

        Formatter::setOptions(['hebrew' => true]);
        $this->assertEquals('Aharon ben Amram Ha-Kohein', Formatter::nameCase(mb_strtolower('Aharon BEN Amram Ha-Kohein')));
        $this->assertEquals('ben Gurion', Formatter::nameCase(mb_strtolower('Ben Gurion')));
    }

    /** Test `postnominal` option */
    public function testPostnominal()
    {
        Formatter::setOptions(['postnominal' => false]);
        $this->assertEquals('Tam Phd', Formatter::nameCase(mb_strtolower('Tam PHD')));

        Formatter::setOptions(['postnominal' => true]);
        $this->assertEquals('Tam PhD', Formatter::nameCase(mb_strtolower('Tam PHD')));
    }
}
