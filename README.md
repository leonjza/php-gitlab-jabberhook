## php-gitlab-jabberhook

A simple project to parse Gitlab Webhooks and send notifications via XMPP.  
The main idea is to have the messages sent to a broadcast service. This library has only really been testing using a Openfire jabber server, but will probably work fine on many others.

## installation
Installation is relatively simple. Ensure that you have `composer` available and issue the command:

`php composer.phar create-project leonjza/php-gitlab-jabberhook gitlab-notifier "dev-master"`  
Where `gitlab-notifier` is the name of the directory you wish to install to. 

Next, create the entry point file (call it anything you want) where your webhook will POST to (`from examples/test.php`):

```php
// File hook.php
<?php

require 'vendor/autoload.php';

$input = file_get_contents('php://input');

$message = new \GitlabXMPPHook\Read($input);
$message = $message->parse();

$jabber = new \GitlabXMPPHook\Client();
$jabber->setOptions('server.local', 5222, 'username@server.local', 'password');
$jabber->call('message')->send($message, 'gitlab_users@broadcast.server.local');
```

Ensure that this file is accessable by your webserver and setup the service hook in your Gitlab install.

Lastly, ensure you have modified the `setOptions()` call with a valid Jabber server and JID.

##contact
[@leonjza](https://twitter.com/leonjza)
