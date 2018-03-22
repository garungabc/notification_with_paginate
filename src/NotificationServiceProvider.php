<?php

namespace Vicoders\Notification;

use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use NF\Facades\App;
use Vicoders\Notification\Models\Notify;
use Vicoders\Notification\Models\UserNotify;
use Vicoders\Notification\NotificationManager;
use Vicoders\Notification\Paginate\Paginator;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('events', function ($app) {
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });

        $this->app->singleton('NotificationView', function ($app) {
            $view = new \NF\View\View;
            $view->setViewPath(__DIR__ . '/../resources/views');
            $view->setCachePath(__DIR__ . '/../resources/cache');
            return $view;
        });
        $this->app->singleton('NotificationManager', function ($app) {
            return new NotificationManager;
        });

        if (!is_dir('database')) {
            mkdir('database', 0755);
        }

        if (!is_dir('database/migrations')) {
            mkdir('database/migrations', 0755);
        }

        if (!file_exists(get_stylesheet_directory() . '/database/migrations/2018_01_01_000001_create_notifications_table.php')) {
            copy(get_stylesheet_directory() . '/notifications/database/migrations/2018_01_01_000001_create_notifications_table.php', get_stylesheet_directory() . '/database/migrations/2018_01_01_000001_create_notifications_table.php');
        }

        if (!file_exists(get_stylesheet_directory() . '/database/migrations/2018_01_01_000002_create_user_notify_table.php')) {
            copy(get_stylesheet_directory() . '/notifications/database/migrations/2018_01_01_000002_create_user_notify_table.php', get_stylesheet_directory() . '/database/migrations/2018_01_01_000002_create_user_notify_table.php');
        }

        $this->registerAdminPostAction();

        if (is_admin()) {
            $this->registerOptionPage(); // it require nf/theme-option package in template
        }
    }

    public function registerCommand()
    {
        // Register your command here, they will be bootstrapped at console
        //
        // return [
        //     PublishCommand::class,
        // ];
    }

    public function registerAdminPostAction()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_media();
        });

        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style(
                'vicoders-notification-style',
                wp_slash(get_stylesheet_directory_uri() . '/notifications/assets/dist/app.css'),
                false
            );
            wp_enqueue_script(
                'vicoders-notification-scripts',
                wp_slash(get_stylesheet_directory_uri() . '/notifications/assets/dist/app.js'),
                'jquery',
                '1.0',
                true
            );
        });
        add_action('wp_ajax_get_notification', [$this, 'getNotification']);
        add_action('wp_ajax_nopriv_get_notification', [$this, 'getNotification']);

        add_action('save_post', [$this, 'saveDataForApproved']);

        add_shortcode('vc-notify', function ($args) {
            $link_more  = $args['link_more'];
            $user_id    = get_current_user_id();
            $sum_notify = UserNotify::where('user_id', $user_id)->where('status', UserNotify::UNREAD)->count();
            return App::make('NotificationView')->render('show', compact('link_more', 'sum_notify'));
        });

        add_shortcode('vc-notify-list-page', function ($args) {
            global $wp;
            $page = 1;
            if(isset($_GET['trang']) && !empty($_GET['trang'])) {
                $page = $_GET['trang'];
            }
            $current_url = home_url(add_query_arg([], $wp->request));
            $user_id     = get_current_user_id();
            $all_notify  = UserNotify::where('user_id', $user_id)->orderBy('ID', 'DESC')->paginate(4,['*'], 'trang', $page)->setPageName("trang");
            $paginator = new Paginator($all_notify, $current_url, $page,'trang');
            return App::make('NotificationView')->render('list-notify', compact('all_notify', 'paginator'));
        });
    }

    public function registerOptionPage()
    {}

    public function getNotification()
    {
        if (!is_user_logged_in()) {
            return false;
        }
        $id          = get_current_user_id();
        $user_notify = UserNotify::where('user_id', $id)->orderBy('id', 'DESC')->skip(0)->take(7)->get();
        $result      = __('<li class="item"><p>Không có thông báo nào</p></li>', 'hope');

        if (!$user_notify->isEmpty()) {
            $result = '';
            foreach ($user_notify->toArray() as $key => $item) {
                $result .= '<li class="item ' . ($item['status'] == 0 ? 'unread' : '') . '">';
                $notification = Notify::where('id', $item['notification_id'])->orderBy('id', 'DESC')->skip(0)->take(10)->get();
                foreach ($notification as $key => $value_notification) {
                    $result .= $value_notification->content;
                }
                $result .= '</li>';
            }
        }

        $change_status_user_notify = UserNotify::where('user_id', $id)->where('status', UserNotify::UNREAD)->get();
        if (!$change_status_user_notify->isEmpty()) {
            foreach ($change_status_user_notify as $key => $item) {
                $update_status_notify         = UserNotify::find($item['id']);
                $update_status_notify->status = UserNotify::READ;
                $update_status_notify->save();
            }
        }

        return wp_send_json($result);
    }

    public function saveDataForApproved($post_id)
    {
        if (get_post($post_id)->post_status == 'draft') {
            // NotificationManager::saveDataToDatabase($post_id, Notify::NOTIFIABLE_TYPE_PUBLIC);
        }
    }
}
