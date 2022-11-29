<?php

namespace MamaOmida\Dns\Handlers\Types;

use MamaOmida\Dns\Handlers\AbstractDnsHandler;
use MamaOmida\Dns\Handlers\DnsHandlerException;

class DnsGetRecord extends AbstractDnsHandler
{

    /**
     * @throws DnsHandlerException
     */
    public function getDnsData(string $hostName, int $type): array
    {
        $this->validateParams($hostName, $type);

        return $this->getDnsRawResult($hostName, $type);
    }

    private function getDnsRawResult(string $hostName, int $type): array
    {
        $startProcess = time();
        for ($i = 0; $i < $this->retries; $i++) {
            if (
                ($result = $this->getDnsRecord($hostName, $type)) !== []
                || ((time() - $startProcess) >= $this->timeout)
            ) {
                return is_array($result) ? $result : [];
            }
        }
        return [];
    }

    /**
     * @param string $hostName
     * @param int $type
     * @return array|false
     */
    private function getDnsRecord(string $hostName, int $type)
    {
        return dns_get_record($hostName, $type);
    }

}