<?php

namespace FreepikLabs\Tests\Unit;
use FreepikLabs\DomPurify\Purifier;
use PHPUnit\Framework\TestCase;


class PurifyTest extends TestCase
{
    public function test_returns_sanitized_svg()
    {
        $process = new Purifier;

        // Clean events
        $output = $process->clean('<svg><g onload="alert(\'test\')"></g>', [
            'USE_PROFILES' => [
                'svg' => true
            ]
        ]);

        $this->assertEquals('<svg><g></g></svg>', $output);

        // Clean js
        $output = $process->clean('<svg><script>alert(\'test\')</script></svg>', [
            'USE_PROFILES' => [
                'svg' => true
            ]
        ]);

        $this->assertEquals('<svg></svg>', $output);

        // Regex
        $output = $process->clean("<a href=\"https://www.wepik.com\" /><a href=\"https://www.wepik.es\" />", [
            'USE_PROFILES' => [
                'html' => true,
            ],
            'ALLOWED_URI_REGEXP' => "/https:\/\/www\.[a-z0-9-]+(?:\.[a-z0-9-]+)*\.com/g",
        ]);

        $this->assertEquals('<a href="https://www.wepik.com"></a><a></a>', $output);
    }

}
