<?php namespace Tamtamchik\NameCase\Test;

use PHPUnit\Framework\TestCase;
use function Tamtamchik\NameCase\str_name_case;

class HtmlEncodingTest extends TestCase
{
    // Currently if I pass & through, namecase changes it to &Amp; which breaks decoding. Please add an ignore for html encoded entities.
    //&lt;, &gt;, &amp, &#39; and &quot;

    // Here is what I'm having to do currently to get around the problem:
    //
    //		$adjusted_name = str_name_case($input);
    //
    //		// Use preg_replace_callback to match HTML entities and convert them to lowercase.
    //		$adjusted_name = preg_replace_callback('/&[a-zA-Z0-9#]+;/', function($matches) {
    //			return strtolower($matches[0]);
    //		}, $adjusted_name);
    //
    //		return $adjusted_name;

    private $names = [
        "Keith & Leo da Vinci",
        "Keith &amp; Yusof bin Ishak",
        "Keith &amp; Leo &amp; Ben",
        "Keith &amp; Leo & ben Gurion",
        "Keith &amp; Leo &amp; MacMurdo & Paul &quot;Ringo&quote;",
        "Keith &amp; Leo &amp; John & Paul \"Ringo\"",
        "&lt;Keith&gt; &amp; Leo",
        "<Keith> & Leonard",
        "&#39;Keith&#39; & Leo",
        "'Keith' &amp; Charles II",
    ];

    /** Test function call. */
    public function testCallWorks(): void
    {
        foreach ($this->names as $name) {
            $this->assertEquals($name, str_name_case(mb_strtolower($name)));
        }
    }
}
