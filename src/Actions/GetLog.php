<?php

namespace MoonfiveDev\ClientApi\Actions;

class GetLog
{
    public function __construct(public readonly string $logPath) {}

    public function handle(string $date_iso_string): string
    {
        $logFileName = $this->generateLogFileName($date_iso_string);

        if (!file_exists($logFileName)) {
            throw new \Exception("Log file not found: " . $logFileName);
        }

        return file_get_contents($logFileName);
    }

    protected function generateLogFileName(string $date_iso_string): string
    {
        $date = new \DateTime($date_iso_string);
        return $this->logPath . '/laravel-' . $date->format('Y-m-d') . '.log';
    }
}
