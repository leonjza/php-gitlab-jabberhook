#example files and scripts.

If you have PHP 5.4+, you can start a test server with `php -S 127.0.0.1:4000`  
Using the sample `.json` files, one can test with the test script with:

`$ curl -X POST -H "Content-Type: application/json" -d '@push.json' http://127.0.0.:4000/test.php`

Ensure you specified valid XMPP account details in `test.php`.

