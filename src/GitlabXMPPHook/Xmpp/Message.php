<?php

namespace GitlabXMPPHook\XMPP;

use GitlabXMPPHook\Exception;

class Message extends XMPPClient
{

    public function __construct($scope)
    {

      parent::__construct($scope);
      return $this;
    }

    public function send($message, $to)
    {

      $this->connection->message($to, $message);
    }
}