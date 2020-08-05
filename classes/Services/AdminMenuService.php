<?php
namespace Ecjia\App\Mail\Services;


use ecjia_admin;
use RC_Uri;

/**
 * 后台菜单API
 * @author royalwang
 */
class AdminMenuService
{
    /**
     * @param $options
     * @return
     */
	public function handle(& $options)
    {
        $menus = ecjia_admin::make_admin_menu('14_email_manage', __('邮件管理', 'mail'), '', 14);

        $submenus = array(
            ecjia_admin::make_admin_menu('email_list', __('邮件订阅管理', 'mail'), RC_Uri::url('mail/admin_email_list/init'), 2)->add_purview('email_list_manage'),
            ecjia_admin::make_admin_menu('view_sendlist', __('邮件队列管理', 'mail'), RC_Uri::url('mail/admin_view_sendlist/init'), 4)->add_purview('email_sendlist_manage'),
            ecjia_admin::make_admin_menu('divider', '', '', 10)->add_purview('mail_template_manage'),
            ecjia_admin::make_admin_menu('mail_template', __('邮件模板', 'mail'), RC_Uri::url('mail/admin/init'), 11)->add_purview('mail_template_manage'),
        );

        $menus->add_submenu($submenus);
    	
    	return $menus;
    	
    }
}

// end