<?php

namespace GitlabXMPPHook\Gitlab;

use GitlabXMPPHook\Exception;

class Json
{

    public function toObject($source)
    {

        if (is_string($source) && is_object(json_decode($source)))
            return json_decode($source);
        else
            throw new Exception\InvalidJson("Unable to parse Json Source");

    }
}