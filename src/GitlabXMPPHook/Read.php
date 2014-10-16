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

use GitlabXMPPHook\Gitlab;
use GitlabXMPPHook\Exception;

/**
 * Class Read
 */

class Read
{

    /**
     * @var string
     */
    public $version = '0.1';

    /**
     * @var string
     */
    protected $type = null;

    /**
     * @var string
     */
    protected $source = null;

    /**
     * Creates a new \GitlabXMPPHook\Read Object
     *
     * @param string $source The raw JSON received from php://input
     *
     * @return Object \GitlabXMPPHook\Read
     */
    public function __construct($source)
    {

        if (is_null($source) || !isset($source))
            throw new Exception\EmptySource("Unable to parse a empty source");

        $this->source = Gitlab\Json::toObject($source);
        return $this;
    }

    /**
     * Parses $this->source to determine which type of message was
     * received. Then calls the appropriate parser
     *
     * @return Object \GitlabXMPPHook\Gitlab\*
     */
    public function parse()
    {

        $type = Gitlab\DetectType::detect($this->source);

        switch ($type) {
            case 'issue':
                $call = Gitlab\Issue::parse($this);
                break;

            case 'merge_request':
                $call = Gitlab\MergeRequest::parse($this);
                break;

            case 'push':
                $call = Gitlab\Push::parse($this);
                break;

            default:
                throw new Exception\MethodNotImplemented("The call to '" . $type . "' has not been implemented.");
                break;
        }

        return $call;
    }
}
