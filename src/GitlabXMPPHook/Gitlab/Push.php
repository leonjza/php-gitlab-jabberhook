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
 * CLass Push
 */

class Push
{

    /**
     * Parses a Gitlab Push POST Hook Message
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
        $message .= "New Push notification via Gitlab XMPP Hook/v" . $object->version . PHP_EOL;
        $message .= "" . PHP_EOL;

        // Parse a summary of the push
        $message .= $object->source->user_name . " pushed " .
                    $object->source->total_commits_count . " commits to " .
                    $object->source->ref . " in the " .
                    $object->source->repository->name . " project" . PHP_EOL;

        // Add some commit details
        $message .= "The pushed commits were: " . PHP_EOL;
        $message .= "" . PHP_EOL;

        foreach ($object->source->commits as $commit) {

            $message .= "Commit Message: " . $commit->message . PHP_EOL;
            $message .= "Url: " . $commit->url . PHP_EOL;
            $message .= "Timestamp: " . $commit->timestamp . PHP_EOL;
            $message .= "Author: " . $commit->author->name . " (" . $commit->author->email . ")" . PHP_EOL;
            $message .= "" . PHP_EOL;
        }

        return $message;
    }
}
