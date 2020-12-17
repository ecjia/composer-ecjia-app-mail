<?php


namespace Ecjia\App\Mail\Events;


class SendMailAfterEvent
{

    /**
     * 邮箱
     * @var string
     */
    public $email;

    /**
     * 模板变量
     * @var array
     */
    public $template_var;

    /**
     * 发送结果
     * @var array
     */
    public $result;

    /**
     * SendMailAfterEvent constructor.
     * @param string $email
     * @param array $template_var
     * @param array $result
     */
    public function __construct(string $email, array $template_var, array $result)
    {
        $this->email        = $email;
        $this->template_var = $template_var;
        $this->result       = $result;
    }


}