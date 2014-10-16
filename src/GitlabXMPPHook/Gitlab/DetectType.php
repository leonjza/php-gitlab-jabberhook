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
 * Class DetectType
 */

class DetectType
{

    /**
     * Determines the type of JSON message received from the parsed hook POST
     *
     * @param object $source The Json object from \GitlabXMPPHook\Gitlab\Json::toObject()
     *
     * @return string
     */
    public function detect($source)
    {

        if (!is_object($source))
            throw new Exception\InvalidObject("The source is not a valid Object. Had the Json been parsed?");

        // Merge Requests and Issues have a object_kind identifier
        // so we will just use that.
        if (isset($source->object_kind))
            return $source->object_kind;

        // For pushes though, we need to check a few fields
        if (isset($source->before) && isset($source->after) && isset($source->total_commits_count))
            return 'push';

        // If we are unable to return for anything, we will have to throw an exception
        throw new Exception\UnknownPost("Unable to identify the json message type");

    }
}
