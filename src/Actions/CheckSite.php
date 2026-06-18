<?php

namespace MoonfiveDev\ClientApi\Actions;

use MoonfiveDev\ClientApi\Data\SiteCheck;

class CheckSite
{
    public function __construct(
        public readonly GetLog $getLog,
    ) {}

    public function handle(): SiteCheck
    {
        $prevErrorLogs = $this->getErrorLinesForDate($this->yesterday());
        $currentErrorLogs = $this->getErrorLinesForDate($this->today());

        return new SiteCheck(
            prev_error_logs: $prevErrorLogs,
            current_error_logs: $currentErrorLogs,
            prev_error_log_count: count($prevErrorLogs),
            current_error_log_count: count($currentErrorLogs),
        );
    }

    /**
     * @return array<string>
     */
    private function getErrorLinesForDate(string $date): array
    {
        $log = $this->getLog->handle($date);

        return array_values(
            preg_grep('/production\.ERROR/', explode("\n", $log))
        );
    }

    private function today(): string
    {
        return date('Y-m-d');
    }

    private function yesterday(): string
    {
        return date('Y-m-d', strtotime('-1 day'));
    }
}
