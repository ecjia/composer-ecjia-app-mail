<?php


namespace Ecjia\App\Mail;


use Ecjia\App\Mail\Models\EmailSendlistModel;
use RC_Time;

class MailRecord
{
    /**
     * @var \Ecjia\App\Mail\MailAbstract
     */
    protected $handler;

    /**
     * @var \Ecjia\App\Mail\MailManager
     */
    protected $manager;

    /**
     * MailRecord constructor.
     * @param MailAbstract $handler
     * @param MailManager $manager
     * @param array $result
     */
    public function __construct(MailAbstract $handler, MailManager $manager)
    {
        $this->handler = $handler;
        $this->manager = $manager;
    }

    /**
     * 添加邮件发送记录
     * @param $email
     * @param ?array $result
     * @param int $priority
     * @return void
     */
    public function addRecord($email, ?array $result, $priority = 1)
    {
        try {
            if (is_ecjia_error($result)) {
                $error = 1;
            } else {
                $error = 0;
            }

            $template_id = $this->handler->getContent()->getTemplateModel()->id;

            $data = array(
                'email'         => $email, //邮箱地址
                'template_id'   => $template_id, //邮件模板ID
                'email_content' => $this->handler->getContent()->render(), //邮件内容
                'priority'      => $priority, //优先级高低（0，1）1 立即发送，0 异步发送
                'error'         => $error, //是否出错（0，1）
                'last_send'     => RC_Time::gmtime(), //最后发送时间
            );
            //写入数据
            EmailSendlistModel::create($data);
        } catch (\Exception $exception) {
            ecjia_log_error($exception);
        }
    }



}