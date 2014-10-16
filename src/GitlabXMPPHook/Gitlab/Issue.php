<?php

namespace GitlabXMPPHook\Gitlab;

use GitlabXMPPHook\Exception;

class Issue
{

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