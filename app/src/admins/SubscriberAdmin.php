<?php

namespace SSDemo\Admin;

use SilverStripe\Admin\ModelAdmin;
use SSDemo\Models\Subscriber;

class SubscriberAdmin extends ModelAdmin
{
    private static $managed_models = [
        Subscriber::class,
    ];
    private static $url_segment = 'subscriber-admin';
    private static $menu_title = 'Subscribers';

    public function getExportFields()
    {
        return [
            'Name' => 'Name',
            'Company' => 'Company',
            'Email' => 'Email',
        ];
    }
}
