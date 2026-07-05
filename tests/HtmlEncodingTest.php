<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use Tamtamchik\NameCase\Formatter;
use function Tamtamchik\NameCase\str_name_case;

class HtmlEncodingTest extends TestCase
{
    private $names = [
        "Keith & Leo da Vinci",
        "Keith &amp; Yusof bin Ishak",
        "Keith &amp; Leo &amp; Ben",
        "Keith &amp; Leo & ben Gurion",
        "Keith &amp; Leo &amp; MacMurdo & Paul &quot;Ringo&quot;",
        "Keith &amp; Leo &amp; John & Paul \"Ringo\"",
        "&lt;Keith&gt; &amp; Leo",
        "<Keith> & Leonard",
        "&#39;Keith&#39; & Leo",
        "'Keith' &amp; Charles II",
    ];

    protected function tearDown(): void
    {
        Formatter::setOptions(['lazy' => true]);
    }

    /** Test function call. */
    public function testCallWorks(): void
    {
        foreach ($this->names as $name) {
            $this->assertEquals($name, str_name_case(mb_strtolower($name)));
        }
    }

    public function testEntitiesAreNormalisedBeforeLazySkip(): void
    {
        $this->assertEquals('Joe &amp; Bob', str_name_case('Joe &Amp; Bob'));
        $this->assertEquals('Joe &amp; Bob', str_name_case('Joe &AMP; Bob'));
    }

    public function testCommonSemicolonlessEntitiesAreNormalised(): void
    {
        $this->assertEquals('Joe &amp Bob', str_name_case('joe &amp bob'));
        $this->assertEquals('Joe &amp Bob', str_name_case('JOE &AMP BOB'));
    }

    public function testLazyFalseDoesNotBreakEntities(): void
    {
        $this->assertEquals('Joe &amp; Bob', Formatter::nameCase('Joe &Amp; Bob', ['lazy' => false]));
    }
}
