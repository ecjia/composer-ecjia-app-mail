<?php


namespace Ecjia\App\Mail\Events;


class SendMailBeforeEvent
{

    /**
     * @var string
     */
    public $email;

    /**
     * @var array
     */
    public $template_var;

    /**
     * SendMailBeforeEvent constructor.
     * @param string $email
     * @param array $template_var
     */
    public function __construct(string $email, array $template_var)
    {
        $this->email        = $email;
        $this->template_var = $template_var;
    }

}