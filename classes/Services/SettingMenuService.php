<?php
namespace Ecjia\App\Mail\Services;

use ecjia_admin;
use RC_Uri;

/**
 * 后台菜单API
 * @author royalwang
 */
class SettingMenuService
{
    /**
     * @param $options
     * @return
     */
	public function handle(& $options)
    {

        $menus = ecjia_admin::make_admin_menu('05_mail_setting', __('邮件服务器设置', 'mail'), RC_Uri::url('mail/admin_mail_settings/init'), 1)->add_purview('mail_settings_manage');
    	
    	return $menus;
    	
    }
}

// end