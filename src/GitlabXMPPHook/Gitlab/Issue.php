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

namespace GitlabXMPPHook\Gitlab;

/**
 * PHP Gitlab Jabber Hook
 *
 * @package  php-gitlab-jabberhook
 * @author   Leon Jacobs <@leonjza>
 * @license  MIT
 * @link     https://leonjza.github.io/
 */

use GitlabXMPPHook\Exception;

/**
 * Class Issue
 */

class Issue
{

    /**
     * Parses a Gitlab Issue POST Hook Message
     *
     * @param object $object the scope injected from GitlabXMPPHook\Gitlab\Read
     *
     * @return string
     */
    public function parse($object)
    {

        // Start a empty message
        $message = '';

        // Add a header
        $message .= "New Issue notification via Gitlab XMPP Hook/v" . $object->version . PHP_EOL;
        $message .= "" . PHP_EOL;

        $message .= "Title: " . $object->source->object_attributes->title . PHP_EOL;
        $message .= "Created At: " . $object->source->object_attributes->created_at . PHP_EOL;
        $message .= "Updated At: " . $object->source->object_attributes->updated_at . PHP_EOL;
        $message .= "Description: " . $object->source->object_attributes->description . PHP_EOL;
        $message .= "Current Action: " . $object->source->object_attributes->action . PHP_EOL;
        $message .= "" . PHP_EOL;
        $message .= "Url: " . $object->source->object_attributes->url . PHP_EOL;

        return $message;
    }
}
