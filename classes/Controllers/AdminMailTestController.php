<?php


namespace Ecjia\App\Mail\Controllers;


use admin_nav_here;
use ecjia;
use ecjia_admin;
use ecjia_admin_log;
use ecjia_screen;
use RC_App;
use RC_DB;
use RC_Error;
use RC_Hook;
use RC_Mail;
use RC_Script;
use RC_Style;
use RC_Uri;

class AdminMailTestController extends AdminBase
{

    public function __construct()
    {
        parent::__construct();

        RC_Style::enqueue_style('chosen');
        RC_Style::enqueue_style('uniform-aristo');
        RC_Script::enqueue_script('jquery-chosen');
        RC_Script::enqueue_script('jquery-uniform');
        RC_Script::enqueue_script('jquery-validate');
        RC_Script::enqueue_script('jquery-form');
        RC_Script::enqueue_script('smoke');

        RC_Script::enqueue_script('mail_settings', RC_App::apps_url('statics/js/mail_settings.js', $this->__FILE__), array(), false, 1);

        RC_Script::localize_script('mail_settings', 'mail_settings', config('app-mail::jslang.mail_settings_page'));
    }

    /**
     * 邮件服务器设置
     */
    public function init()
    {
        $this->admin_priv('mail_settings_manage');

        ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('邮件服务器设置', 'mail')));

        $this->assign('ur_here',      __('测试邮件', 'mail'));

        ecjia_screen::get_current_screen()->add_help_tab( array(
            'id'        => 'overview',
            'title'     => __('概述', 'mail'),
            'content'   =>
                '<p>' . __('欢迎访问ECJia智能后台邮件服务器设置页面，可通过以下两种方式进行配置。', 'mail') . '</p>'
        ) );

        ecjia_screen::get_current_screen()->set_help_sidebar(
            '<p><strong>' . __('更多信息：', 'mail') . '</strong></p>' .
            '<p><a href="https://ecjia.com/wiki/帮助:ECJia智能后台:系统设置#.E9.82.AE.E4.BB.B6.E6.9C.8D.E5.8A.A1.E5.99.A8.E8.AE.BE.E7.BD.AE" target="_blank">' . __('关于邮件服务器设置帮助文档', 'mail') . '</a></p>'
        );

        $this->assign('form_action', RC_Uri::url('mail/admin_mail_test/send_test_email'));

        return $this->display('mail_test.dwt');
    }


    /**
     * 发送测试邮件
     */
    public function send_test_email()
    {
        $this->admin_priv('mail_settings_manage', ecjia::MSGTYPE_JSON);

        $mail_config = [
            'smtp_host'     => $_POST['smtp_host'],
            'smtp_port'     => $_POST['smtp_port'],
            'smtp_mail'     => $_POST['reply_email'],
            'shop_name'     => ecjia::config('shop_name'),
            'smtp_user'     => $_POST['smtp_user'],
            'smtp_pass'     => $_POST['smtp_pass'],
            'mail_charset'  => $_POST['mail_charset'],
            'smtp_ssl'      => $_POST['smtp_ssl'],
            'mail_service'  => $_POST['mail_service'],
        ];

        /* 取得参数 */
        RC_Hook::do_action('reset_mail_config', $mail_config);

        $test_mail_address = trim($_POST['test_mail_address']);

        $error = RC_Mail::send_mail($test_mail_address, $test_mail_address, __('测试邮件', 'mail'),  __('您好！这是一封检测邮件服务器设置的测试邮件。收到此邮件，意味着您的邮件服务器设置正确！您可以进行其它邮件发送的操作了！', 'mail'), 0);
        if ( RC_Error::is_error($error) ) {
            return $this->showmessage(sprintf(__('测试邮件发送失败！%s', 'mail'), $error->get_error_message()) , ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
        } else {
            return $this->showmessage(sprintf(__('恭喜！测试邮件已成功发送到 %s。', 'mail'), $test_mail_address), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS);
        }
    }


}