<?php

namespace GitlabXMPPHook\XMPP;

use XMPPHP_XMPP as Xmpp;
use GitlabXMPPHook\Exception;

class XMPPClient
{

    protected $connection;

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

    public function __destruct()
    {

        $this->connection->disconnect();
    }
}