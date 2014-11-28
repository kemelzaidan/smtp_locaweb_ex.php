<?php

namespace Html2Text;

class LinkTest extends \PHPUnit_Framework_TestCase
{
    const TEST_HTML = '<a href="http://example.com">Link text</a>';

    public function testDoLinksAfter()
    {
        $expected =<<<EOT
Link text [1]

Links:
------
[1] http://example.com

EOT;

        $html2text = new Html2Text(self::TEST_HTML, array('do_links' => 'table'));
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }

    public function testDoLinksInline()
    {
        $expected =<<<EOT
Link text [http://example.com]
EOT;

        $html2text = new Html2Text(self::TEST_HTML, array('do_links' => 'inline'));
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }

    public function testDoLinksNone()
    {
        $expected =<<<EOT
Link text
EOT;

        $html2text = new Html2Text(self::TEST_HTML, array('do_links' => 'none'));
        $output = $html2text->getText();

        $this->assertEquals($output, $expected);
    }

    public function testDoLinksNextline()
    {
        $expected =<<<EOT
Link text
[http://example.com]
EOT;

        $html2text = new Html2Text(self::TEST_HTML, array('do_links' => 'nextline'));
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }

    public function testDoLinksInHtml()
    {
        $html =<<<EOT
<p><a href="http://example.com" class="_html2text_link_none">Link text</a></p>
<p><a href="http://example.com" class="_html2text_link_inline">Link text</a></p>
<p><a href="http://example.com" class="_html2text_link_nextline">Link text</a></p>
EOT;

        $expected =<<<EOT
Link text 

Link text [http://example.com] 

Link text
[http://example.com]
EOT;

        $html2text = new Html2Text($html);
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }

    public function testBaseUrl()
    {
        $html = '<a href="/relative">Link text</a>';
        $expected = 'Link text [http://example.com/relative]';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));
        $html2text->setBaseUrl('http://example.com');

        $this->assertEquals($expected, $html2text->getText());
    }

    public function testBaseUrlWithPlaceholder()
    {
        $html = '<a href="/relative">Link text</a>';
        $expected = 'Link text [%baseurl%/relative]';

        $html2text = new Html2Text($html, array('do_links' => 'inline'));
        $html2text->setBaseUrl('%baseurl%');

        $this->assertEquals($expected, $html2text->getText());
    }
}
