<?php

require 'vendor/autoload.php';

// Connect-Time: 0
// X-Request-Id: de7144d5-74d4-4901-8345-d2a664bca038
// Content-Type: application/json
// Host: requestb.in
// Total-Route-Time: 0
// Content-Length: 1742
// Via: 1.1 vegur
// Connection: close

// BODY

$input = file_get_contents('php://input');

$message = new \GitlabXMPPHook\Read($input);
$message = $message->parse();

$jabber = new \GitlabXMPPHook\Client();
$jabber->setOptions('server.local', 5222, 'username@server.local', 'password');
$jabber->call('message')->send($message, 'gitlab_users@broadcast.server.local');
