<?php

namespace App\Manager;

use App\Manager\CacheManager;
use App\Notification;
use App\Jobs\PushNotificationios;
use App\Manager\EmailManager;

class NotificationManager
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Notification $Notification, CacheManager $cacheManager,EmailManager $emailManager)
    {
        $this->notification = $Notification;
        $this->cache = $cacheManager;
        $this->email = $emailManager;

    }

    /**
     * Send Notification
     *
     * @param $user
     * @param $language
     * @param $url
     * @param $title
     * @param $message
     */
    public function send($user,$url, $title, $message)
    {

        $data = $this->notification;
        $data->user_id = $user->id;
        $data->language = $user->language;
        $data->url = $url;
        $data->title = $title;
        $data->message = $message;
        $data->save();
        $this->cache->clear('App\Notification');

        PushNotificationios::dispatch($user->device_token, $message,$url);
        $this->email->sendEmail(5, $user,null,$message);
        return;
    }

    /**
     * Find notification data and update recode
     */
    public function findUpdate($id)
    {
        $data = $this->notification->findOrFail($id);
        $data->status = 2;
        $data->save();
        return $data;
    }

    /**
     * List of all notification
     * @param $request
     * @param $limit
     * @param $userId
     */
    function list($request, int $limit, int $userId) {
        $this->notification->where('user_id', $userId)->update(['status' => 1]);
        $notification = $this->notification->where('user_id', $userId)->orderBy('created_at', 'desc');
        $data = $notification->paginate($limit);
        return $data;
    }

    /**
     * Find notification delete
     */
    public function delete($id)
    {
        $data = $this->notification->findOrFail($id);
        $data->delete();
        $this->cache->clear('App\Notification');
        return true;
    }

    /**
     * Delete All
     * $userId
     */
    public function deleteAll($userId)
    {
        $data = $this->notification->where('user_id', $userId)->delete();
        $this->cache->clear('App\Notification');
        return true;
    }

    /**
     * Send Notification
     *
     * @param $user
     * @param $language
     * @param $url
     * @param $title
     * @param $message
     */
    public function sendCustomer($user,$url, $title, $message,$type)
    {

        $data = $this->notification;
        $data->user_id = $user->id;
        $data->language = $user->language;
        $data->url = $url;
        $data->type = $type;
        $data->title = $title;
        $data->message = $message;
        $data->save();
        $this->cache->clear('App\Notification');

        PushNotificationios::dispatch($user->device_token, $message,$url);
        $this->email->sendEmail(5, $user,null,$message);
        return;
    }

}
