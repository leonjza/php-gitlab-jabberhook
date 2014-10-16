<?php

namespace GitlabXMPPHook;

use GitlabXMPPHook\Gitlab;
use GitlabXMPPHook\Exception;

class Read
{

    public $version = '0.1';
    protected $type = null;

    public function __construct($source)
    {

        if (is_null($source) || !isset($source))
            throw new Exception\EmptySource("Unable to parse empty Object");

        $this->source = Gitlab\Json::toObject($source);
            return $this;

    }

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