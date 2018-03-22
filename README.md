# Notification with popup and send email
 > It's an extension kit for our theme https://github.com/hieu-pv/nf-theme 

<a name="local-reposoitory"></a>
## Add notifications folder in your theme
> Add notifications folder in your theme

## Working with local repository
To add namespace of package with PSR-4, add the following code to your composer.json then run command `composer dump-autoload` or `composer dump-autoload -o` to optimize

```php
"autoload": {
    "psr-4": {
        "Vicoders\\Notification\\": "notifications/src/"
    }
},
```

##### Step 1: Install Through Composer
```
Updating ...
```

<a name="configuration"></a>
##### Step 2: Add the Service Provider
> Open `config/app.php` and register the required service provider.

```php
  'providers'  => [
        // .... Others providers 
        \Vicoders\Notification\NotificationServiceProvider::class
    ],
```

##### Step 3: Run migrate
> Run below command to migrate tables into database. It'll create 2 tables is `wp_notify` and `wp_user_notify`.

```php
php command migrate
```

##### Step 4: Insert shortcodes
> Insert 2 shortcodes where you need

```php
[vc-notify link_more="#"]: Show icon notify, badge and link to redirect to list notify page
[vc-notify-list-page]: List all notifies
```

##### Step 5: Save data to database
> use Notify model to determine notification type, refer [Notify](https://github.com/garungabc/notification_with_paginate/blob/master/src/Models/Notify.php)

```php
NotificationManager::saveDataToDatabase($id_post, Notify::NOTIFIABLE_TYPE);
```

<a name="compiler"></a>
### Send Email with Lumen-email-microservice
> Send email easy

##### Step 1: Prepare data, email template

- Prepare data array with key is variables use to show into email template
```php
$data = [
    'param_1' => title_case(get_the_author_meta('user_nicename', $post->post_author)),
    'param_2'  => $post->post_title
]
```


- Get html content from email template file
```php	

$email_template = '<div class="this_is_1">{$param_1}</div><div class="this_is_2">{$param_2}</div>';

or

$email_template = file_get_contents(PATH_TO_EMAIL_TEMPLATE_FILE);
```
##### Step 2: Send email

- Send bulk email
```php
NotificationManager::sendBulkEmail($id_post, $data, $from, $subject = "This is email subject", $email_template);
```

- Send email
```php
NotificationManager::sendEmail($data, $to, $from, $subject = "Default", $email_template);
```
