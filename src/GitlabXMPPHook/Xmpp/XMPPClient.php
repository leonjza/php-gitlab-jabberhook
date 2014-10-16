<?php
/*
The MIT License (MIT)

Copyright (c) 2014 Leon Jacobs

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

namespace GitlabXMPPHook\Xmpp;

/**
 * PHP Gitlab Jabber Hook
 *
 * @package  php-gitlab-jabberhook
 * @author   Leon Jacobs <@leonjza>
 * @license  MIT
 * @link     https://leonjza.github.io/
 */

use XMPPHP_XMPP as Xmpp;
use GitlabXMPPHook\Exception;

/**
 * Class XMPPClient
 */

class XMPPClient
{

    /**
     * Stores a configured and connected XMPPClient instance
     *
     * @var \GitlabXMPPHook\Xmpp\XMPPClient
     */
    protected $connection;

    /**
     * Creates a new \GitlabXMPPHook\XMPPClient Object
     *
     * @param object $cope The scope injected from a \GitlabXMPPHook\Client Object
     *
     * @return void
     */
    public function __construct($scope)
    {

        if (is_null($scope->host) || is_null($scope->port) || is_null($scope->username) || is_null($scope->password))
            throw new Exception\InvalidXMPPOptions("Missing XMPP Settings");

        $this->connection = new Xmpp(

            $scope->host,
            $scope->port,
            $scope->username,
            $scope->password,
            'GitlabXMPPHook-Bot/' . $scope->version,
            null,   // hostname can be determined from full JID
            $printlog = $scope->debug,
            $loglevel = \XMPPHP_Log::LEVEL_DEBUG
        );

        try {

          $this->connection->connect();
          $this->connection->processUntil('session_start');
          $this->connection->presence();
          sleep(0.2);   // Give a few seconds for the dust to settle. Openfire don't like things happening too fast

        } catch (\XMPPHP_Exception $e) {

            throw new Exception\FailedConnection($e);
        }
    }

    /**
     * Disconnects a connected \GitlabXMPPHook\Xmpp\XMPPClient Object
     *
     * @return void
     */
    public function __destruct()
    {

        $this->connection->disconnect();
    }
}
