<?php

namespace GitlabXMPPHook;

use GitlabXMPPHook\Xmpp;
use GitlabXMPPHook\Exception;

class Client
{

    public $xmpp_connection;

    public $username = null;
    public $password = null;
    public $host = null;
    public $port = null;
    public $debug = false;

    public $version = '0.1';

    public function __construct()
    {

    }

    public function setOptions($host = null, $port = null, $user = null, $pass = null, $debug = false)
    {

        $this->username = $user;
        $this->password = $pass;
        $this->host = $host;
        $this->port = $port;
        $this->debug = $debug;

        return $this;

    }

    public function call($action)
    {

        switch ($action) {
            case 'mess':
            case 'message':
                $call = new Xmpp\Message($this);
                break;

            default:
                throw new Exception\MethodNotImplemented("The call to '" . $action . "' has not been implemented.");
                break;
        }

        return $call;
    }
}