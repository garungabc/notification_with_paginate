<?php

namespace Vicoders\Notification;

use App\Models\Signal;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use League\Flysystem\Exception;
use Vicoders\Notification\Models\Notify;
use Vicoders\Notification\Models\UserNotify;

class NotificationManager
{
    public function __construct()
    {
        // do anything that you want to do
    }

    public function saveDataToDatabase($id_petition, $notify_type = Notify::NOTIFIABLE_TYPE)
    {
        if (!is_user_logged_in()) {
            return false;
        }
        if ($id_petition == null) {
            throw new Exception("ID petition is required", 1);
        }
        $petition_detail = get_post($id_petition);
        if (!$petition_detail) {
            throw new Exception("Don't found petition detail !", 1);
        }
        $link           = get_permalink($id_petition);
        $date_post      = current_time('g:i a, l, F j, Y');
        $notify_content = '<a href="' . $link . '">';
        switch ($notify_type) {
            case Notify::NOTIFIABLE_TYPE:
                $notify_content .= '<p class="content">' . __('Kiến nghị', 'hope') . ' "<strong>' . $petition_detail->post_title . '</strong>" ' . __('đã được cập nhật', 'hope') . '</p>';
                break;
            case Notify::NOTIFIABLE_TYPE_VICTORY:
                $notify_content .= '<p class="content">' . __('Kiến nghị', 'hope') . ' "<strong>' . $petition_detail->post_title . '</strong>" ' . __('đã thành công', 'hope') . '</p>';
                break;
            case Notify::NOTIFIABLE_TYPE_COLLECT:
                $notify_content .= '<p class="content">' . __('Kiến nghị', 'hope') . ' "<strong>' . $petition_detail->post_title . '</strong>" ' . __('đã thu thập đủ chữ ký', 'hope') . '</p>';
                break;
            case Notify::NOTIFIABLE_TYPE_PUBLIC:
                $notify_content .= '<p class="content">' . __('Kiến nghị', 'hope') . ' "<strong>' . $petition_detail->post_title . '</strong>" ' . __('đã được phê duyệt', 'hope') . '</p>';
                break;
            default:
                $notify_content .= '<p class="content">' . __('Kiến nghị', 'hope') . ' "<strong>' . $petition_detail->post_title . '</strong>" ' . __('đã được cập nhật', 'hope') . '</p>';
                break;
        }
        $notify_content .= '<span class="date">' . __('Vào lúc', 'hope') . ' ' . $date_post . ' </span>';
        $notify_content .= '</a>';

        $notify                  = new Notify;
        $notify->type            = Notify::TYPE;
        $notify->notifiable_id   = $id_petition;
        $notify->notifiable_type = $notify_type;
        $notify->content         = $notify_content;
        $notify->save();
        $notify_id = $notify->id;

        switch ($notify_type) {
            case Notify::NOTIFIABLE_TYPE:
                $this->saveNotifyForMoreUser($id_petition, $notify_id);
                $this->saveNotifyForAdmin($notify_id);
                break;
            case Notify::NOTIFIABLE_TYPE_VICTORY:
                $this->saveNotifyForMoreUser($id_petition, $notify_id);
                break;
            case Notify::NOTIFIABLE_TYPE_COLLECT:
                $this->saveNotifyForMoreUser($id_petition, $notify_id);
                $this->saveNotifyForAuthor($petition_detail->post_author, $notify_id);
                $this->saveNotifyForAdmin($notify_id);
                break;
            case Notify::NOTIFIABLE_TYPE_PUBLIC:
                $this->saveNotifyForAuthor($petition_detail->post_author, $notify_id);
                break;
            default:
                break;
        }
    }

    public function saveNotifyForMoreUser($id_petition, $notify_id)
    {
        $signals = Signal::where('petition_id', $id_petition)->get();
        if (!$signals->isEmpty()) {
            foreach ($signals as $key => $item) {
                $this->saveNotifyForAuthor($item->signer_id, $notify_id);
            }
        }
    }

    public function saveNotifyForAuthor($id_author, $notify_id)
    {
        $user_notify                  = new UserNotify;
        $user_notify->user_id         = $id_author;
        $user_notify->notification_id = $notify_id;
        $user_notify->status          = UserNotify::UNREAD;
        $user_notify->save();
    }

    public function saveNotifyForAdmin($notify_id)
    {
        $args = [
            'role' => 'administrator',
        ];
        $admins = get_users($args);
        if (empty($admins)) {
            throw new Exception("Don't found ID of administrators", 1);
        }
        foreach ($admins as $key => $admin) {
            $id_admin = (int) $admin->data->ID;
            $this->saveNotifyForAuthor($id_admin, $notify_id);
        }
    }

    public function sendBulkEmail($id_petition, $data = [], $from = "vicoders.test@gmail.com", $subject = "No Subject", $email_template)
    {
        $signals = Signal::where('petition_id', $id_petition)->get();
        if (!$signals->isEmpty()) {
            $users = [];
            foreach ($signals as $key => $item) {
                $users = [
                    $item->signer_id => [
                        'name_signer' => title_case(get_the_author_meta('user_nicename', $item->signer_id)),
                        'email'       => get_the_author_meta('user_email', $item->signer_id),
                    ],
                ];
            }
            $request = [
                'users'   => $users,
                'from'    => $from,
                'html'    => $email_template,
                'subject' => $subject,
                'data'    => $data,
            ];
            $url    = URI_API . "/api/emails/bulk";
            $client = new Client();
            try {
                $res  = $client->request('POST', $url, ['json' => $request]);
                $body = $res->getBody();
            } catch (RequestException $e) {
                echo \GuzzleHttp\Psr7\str($e->getRequest());
                if ($e->hasResponse()) {
                    echo \GuzzleHttp\Psr7\str($e->getResponse());
                }
                die;
            }
        }
    }

    public function sendEmail($data = [], $to, $from = "vicoders.test@gmail.com", $subject = "No Subject", $email_template)
    {
        $request = [
            'to'      => $to,
            'from'    => $from,
            'html'    => $email_template,
            'subject' => $subject,
            'data'    => $data,
        ];
        $url    = URI_API . "/api/emails/send";
        $client = new Client();

        try {
            $res  = $client->request('POST', $url, ['json' => $request]);
            $body = $res->getBody();
        } catch (RequestException $e) {
            echo \GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo \GuzzleHttp\Psr7\str($e->getResponse());
            }
            die;
        }
    }
}
