<?php

namespace Ecjia\App\Mail;

use ecjia_admin_log;
use RC_Service;
use Royalcms\Component\App\AppParentServiceProvider;

class MailServiceProvider extends  AppParentServiceProvider
{
    
    public function boot()
    {
        $this->package('ecjia/app-mail');

        $this->assignAdminLogContent();
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

    /**
     * 添加管理员记录日志操作对象
     */
    protected function assignAdminLogContent()
    {
        ecjia_admin_log::instance()->add_object('email', __('邮件地址', 'mail'));
        ecjia_admin_log::instance()->add_object('subscription_email', __('订阅邮件', 'mail'));
        ecjia_admin_log::instance()->add_object('email_template', __('邮件模板', 'mail'));

        ecjia_admin_log::instance()->add_action('batch_send', __('批量发送', 'mail'));
        ecjia_admin_log::instance()->add_action('all_send', __('全部发送', 'mail'));

        ecjia_admin_log::instance()->add_action('batch_exit', __('批量退订', 'mail'));
        ecjia_admin_log::instance()->add_action('batch_ok', __('批量确定', 'mail'));

        ecjia_admin_log::instance()->add_action('batch_setup', __('批量设置', 'mail'));
    }
    
}