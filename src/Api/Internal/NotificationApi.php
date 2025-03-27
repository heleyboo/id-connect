<?php

namespace SonLeu\IDConnect\Api\Internal;

use SonLeu\IDConnect\ApiException;

class NotificationApi extends BaseInternalApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int|array $user_ids
     * @param string $title
     * @param string $message
     * @param string $target
     * @param string $action
     * @param int $id
     * @param string $event
     * @return mixed
     * @throws ApiException
     */
    public function sendNotification($user_ids, $title, $message, $target = null, $action = 'detail', $id = null, $event = null)
    {
        if (is_integer($user_ids))
            $user_ids = [$user_ids];

        list($data, $statusCode, $headers) = $this->callApi('notification-for-app', 'POST', [], [
            'user_ids' => $user_ids,
            'title' => $title,
            'message' => $message,
            'target' => $target,
            'action' => $action,
            'id' => $id,
            'event' => $event,
        ]);

        return $data->success;
    }
}
