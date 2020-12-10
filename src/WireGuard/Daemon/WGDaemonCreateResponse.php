<?php

/*
 * eduVPN - End-user friendly VPN.
 *
 * Copyright: 2016-2019, The Commons Conservancy eduVPN Programme
 * SPDX-License-Identifier: AGPL-3.0+
 */

namespace LC\Portal\WireGuard\Daemon;

/**
 * @psalm-immutable
 */
class WGDaemonCreateResponse
{
    /** @var string */
    public $ip;

    /** @var string */
    public $serverPublicKey;

    /**
     * @param string $ip
     * @param string $serverPublicKey
     */
    public function __construct($ip, $serverPublicKey)
    {
        $this->ip = $ip;
        $this->serverPublicKey = $serverPublicKey;
    }
}
