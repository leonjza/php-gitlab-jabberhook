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

namespace GitlabXMPPHook;

/**
 * PHP Gitlab Jabber Hook
 *
 * @package  php-gitlab-jabberhook
 * @author   Leon Jacobs <@leonjza>
 * @license  MIT
 * @link     https://leonjza.github.io/
 */

use GitlabXMPPHook\Xmpp;
use GitlabXMPPHook\Exception;

/**
 * Class Client
 */

class Client
{

    /**
     * Stores a configured and connected XMPPClient instance
     *
     * @var \GitlabXMPPHook\Xmpp\XMPPClient
     */
    public $xmpp_connection;

    /**
     * @var string
     */
    public $username = null;

    /**
     * @var string
     */
    public $password = null;

    /**
     * @var string
     */
    public $host = null;

    /**
     * @var string
     */
    public $port = null;

    /**
     * @var boolean
     */
    public $debug = false;

    /**
     * @var string
     */
    public $version = '0.1';

    /**
     * Creates a new \GitlabXMPPHook\Client Object
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Sets the options needed to connect to a XMPP server
     *
     * @param   string $host  The hostname of the XMPP server
     * @param   string $port  The port to connect to
     * @param   string $user  The username to authenticate with
     * @param   string $pass  The password to authenticate with
     * @param   bool   $debug Debug logging enabled
     *
     * @return void
     */
    public function setOptions($host = null, $port = null, $user = null, $pass = null, $debug = false)
    {

        $this->username = $user;
        $this->password = $pass;
        $this->host = $host;
        $this->port = $port;
        $this->debug = $debug;

        return $this;
    }

    /**
     * Calls the XMPP functions
     *
     * @param   string $action The action to perform
     *
     * @return Object \GitlabXMPPHook\Xmpp\*
     */
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
