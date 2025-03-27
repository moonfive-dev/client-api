<?php

namespace MoonfiveDev\ClientApi\Actions;

use MoonfiveDev\ClientApi\Data\SiteCheck;

class CheckSite
{
    public function handle(): SiteCheck
    {
        return new SiteCheck(
            prev_error_log_count: $this->getPrevErrorLogCount(),
            current_error_log_count: $this->getCurrentErrorLogCount(),
        );
    }

    private function getPrevErrorLogCount(): ?int
    {
        return null;
    }

    private function getCurrentErrorLogCount(): ?int
    {
        return null;
    }
}
