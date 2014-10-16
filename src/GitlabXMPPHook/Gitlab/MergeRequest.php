<?php

namespace GitlabXMPPHook\Gitlab;

use GitlabXMPPHook\Exception;

class MergeRequest
{

    public function parse($object)
    {

        // Start a empty message
        $message = '';

        // Add a header
        $message .= "New Merge Request notification via Gitlab XMPP Hook/v" . $object->version . PHP_EOL;
        $message .= "" . PHP_EOL;

        $message .= "Title: " . $object->source->object_attributes->title . PHP_EOL;
        $message .= "Created At: " . $object->source->object_attributes->created_at . PHP_EOL;
        $message .= "Updated At: " . $object->source->object_attributes->updated_at . PHP_EOL;
        $message .= "Description: " . $object->source->object_attributes->description . PHP_EOL;
        $message .= "" . PHP_EOL;
        $message .= "Target Branch: " . $object->source->object_attributes->target_branch . PHP_EOL;
        $message .= "Source Branch: " . $object->source->object_attributes->source_branch . PHP_EOL;
        $message .= "" . PHP_EOL;
        $message .= "Last commit message in source branch: " . $object->source->object_attributes->last_commit->message . PHP_EOL;

        return $message;
    }
}