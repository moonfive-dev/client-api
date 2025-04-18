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

    private function getPrevErrorLogCount(): ?int
    {
        try {
            $log = $this->getLog->handle(date("Y-m-d", strtotime("-1 day")));
            $errors = preg_grep("/production.ERROR/", explode("\n", $log));

            return count($errors);
        } catch (\Throwable $th) {
            return null;
        }
    }

    private function getCurrentErrorLogCount(): ?int
    {
        try {
            $log = $this->getLog->handle(date("Y-m-d"));
            $errors = preg_grep("/production.ERROR/", explode("\n", $log));

            return count($errors);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
