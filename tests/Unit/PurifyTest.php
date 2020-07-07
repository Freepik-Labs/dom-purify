<?php

namespace FreepikLabs\Tests\Unit;
use FreepikLabs\DomPurify\Purifier;
use PHPUnit\Framework\TestCase;


class PurifyTest extends TestCase
{
    public function test_returns_sanitized_svg()
    {
        $process = new Purifier;
        $output = $process->clean('<svg><g onload="alert(\'test\')"></g>', [
            'USE_PROFILES' => [
                'svg' => true
            ]
        ]);

        $this->assertEquals('<svg><g></g></svg>', $output);


        $output = $process->clean('<svg><script>alert(\'test\')</script></svg>', [
            'USE_PROFILES' => [
                'svg' => true
            ]
        ]);

        $this->assertEquals('<svg></svg>', $output);
    }

}
