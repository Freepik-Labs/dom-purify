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
        $temporalFile = tmpfile();
        fwrite($temporalFile, $string);

        $process = new Process([
            $this->executablePath,
            stream_get_meta_data($temporalFile)['uri'],
            base64_encode(json_encode($config)),
        ]);

        $process->run();

        fclose($temporalFile);

        if ($error = $process->getErrorOutput()) {
            throw new InvalidOutputException("Purifier error: {$error} | " . $process->getOutput());
        }

        return trim($process->getOutput());
    }
}
