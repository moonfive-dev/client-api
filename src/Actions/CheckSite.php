<?php

namespace MoonfiveDev\ClientApi\Actions;

use MoonfiveDev\ClientApi\Data\SiteCheck;

class CheckSite
{
    public function __construct(public readonly GetLog $getLog) {}

    public function handle(): SiteCheck
    {
        return new SiteCheck(
            prev_error_log_count: $this->getPrevErrorLogCount(),
            current_error_log_count: $this->getCurrentErrorLogCount(),
        );
    }

    private function getErrorLogCount(string $date_iso_string): int
    {
        $log = $this->getLog->handle($date_iso_string);
        $errors = preg_grep("/production.ERROR/", explode("\n", $log));

        return count($errors);
    }

    private function getPrevErrorLogCount(): int
    {
        return $this->getErrorLogCount(date("Y-m-d", strtotime("-1 day")));
    }

    private function getCurrentErrorLogCount(): int
    {
        return $this->getErrorLogCount(date("Y-m-d"));
    }
}
