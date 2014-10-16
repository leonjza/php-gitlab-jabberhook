<?php

namespace GitlabXMPPHook\Gitlab;

use GitlabXMPPHook\Exception;

class Push
{

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