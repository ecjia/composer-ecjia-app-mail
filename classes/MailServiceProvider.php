<?php

namespace Ecjia\App\Mail;

use RC_Service;
use Royalcms\Component\App\AppParentServiceProvider;

class MailServiceProvider extends  AppParentServiceProvider
{
    
    public function boot()
    {
        $this->package('ecjia/app-mail');
    }
    
    public function register()
    {
        $this->registerAppService();
    }

    protected function registerAppService()
    {
        RC_Service::addService('admin_purview', 'mail', 'Ecjia\App\Mail\Services\AdminPurviewService');
        RC_Service::addService('setting_menu', 'mail', 'Ecjia\App\Mail\Services\SettingMenuService');
        RC_Service::addService('admin_menu', 'mail', 'Ecjia\App\Mail\Services\AdminMenuService');
        RC_Service::addService('mail_template', 'mail', 'Ecjia\App\Mail\Services\MailTemplateService');
    }
    
}