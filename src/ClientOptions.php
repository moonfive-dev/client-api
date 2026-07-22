<?php

namespace MoonfiveDev\ClientApi;

class ClientOptions
{
    public function __construct(
        public readonly ?string $logPath = null,
    ) {}

    /**
     * Return the configured log path, or throw a clear error when it is missing.
     *
     * `logPath` is optional (e.g. `checkServer()` does not need it), but any
     * operation that reads logs requires it. Validating here means a
     * misconfigured `ClientOptions` fails with an actionable message instead of
     * a `TypeError` deep inside {@see Actions\GetLog}.
     */
    public function requireLogPath(): string
    {
        if ($this->logPath === null || trim($this->logPath) === '') {
            throw new \InvalidArgumentException(
                'ClientOptions::$logPath must be configured to use checkSite().'
            );
        }

        return $this->logPath;
    }
}
