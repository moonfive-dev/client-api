<?php

namespace MoonfiveDev\ClientApi;

use GuzzleHttp\ClientInterface;
use MoonfiveDev\ClientApi\Data\ServerCheck;
use MoonfiveDev\ClientApi\Data\SiteCheck;

class ClientApi
{
    public function __construct(
        public readonly string $secret,
        public readonly string $baseUrl,
        public readonly ClientInterface $client,
    ) {}

    protected function request(string $method, string $endPoint, array $json = []): array
    {
        $response = $this->client->request($method, $this->baseUrl . $endPoint, [
            "headers" => [
                "Authorization" => "Bearer " . $this->secret,
                "Content-Type" => "application/json",
            ],
            "json" => $json,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Failed to check server");
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    public function checkServer(int $server_id, ServerCheck $payload): array
    {
        return $this->request("POST", "/servers/{$server_id}/check", $payload->toArray());
    }

    public function checkSite(int $site_id, SiteCheck $payload): array
    {
        return $this->request("POST", "/sites/{$site_id}/check", $payload->toArray());
    }
}
