<?php

namespace GitlabXMPPHook\Gitlab;

use GitlabXMPPHook\Exception;

class DetectType
{

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