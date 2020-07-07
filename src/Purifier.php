<?php

namespace FreepikLabs\DomPurify;

use Symfony\Component\Process\Process;

class Purifier
{
    private string $executablePath;

    public function __construct(string $executablePath = null)
    {

        $this->executablePath = $executablePath ?: __DIR__ . '/purify.js';
    }


    public function clean(string $string, array $config = [])
    {
        $process = new Process([
            $this->executablePath,
            base64_encode($string),
            base64_encode(json_encode($config)),
        ]);

        $process->run();

        if ($error = $process->getErrorOutput()) {
            throw new InvalidOutputException("Purifier error: {$error} | " . $process->getOutput());
        }

        return trim($process->getOutput());
    }
}
