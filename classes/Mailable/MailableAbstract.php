<?php

namespace Ecjia\App\Mail\Mailable;

use Ecjia\App\Mail\Models\MailTemplateModel;
use Illuminate\Support\HtmlString;

abstract class MailableAbstract extends \Illuminate\Mail\Mailable
{
    /**
     * @var string
     */
    protected $eventCode;

    /**
     * @var MailTemplateModel
     */
    protected $templateModel;

    /**
     * @var string
     */
    protected $renderContent;

    public function __construct()
    {
        $this->templateModel = (new MailTemplateModel())->getTemplateByCode($this->eventCode);
    }

    /**
     * Build the view for the message.
     *
     * @return array|string
     *
     * @throws \ReflectionException
     */
    protected function buildView()
    {
        return $this->buildSmartyView();
    }

    /**
     * @return array
     */
    protected function buildSmartyView()
    {
        $smarty = royalcms('view')->getSmarty();

        $data = $this->buildViewData();

        $smarty->assign($data);

        $content = $smarty->fetch('string:' . $this->view);

        return [
            'html' => new HtmlString($content),
        ];
    }

    /**
     * @return string
     */
    public function getEventCode(): string
    {
        return $this->eventCode;
    }

    /**
     * @param string $eventCode
     * @return MailableAbstract
     */
    public function setEventCode($eventCode): MailableAbstract
    {
        $this->eventCode = $eventCode;
        return $this;
    }

    /**
     * @return MailTemplateModel
     */
    public function getTemplateModel(): MailTemplateModel
    {
        return $this->templateModel;
    }

    /**
     * @param MailTemplateModel $templateModel
     * @return MailableAbstract
     */
    public function setTemplateModel(MailTemplateModel $templateModel): MailableAbstract
    {
        $this->templateModel = $templateModel;
        return $this;
    }

    /**
     * @return string
     */
    public function getRenderContent(): string
    {
        return $this->renderContent;
    }

    /**
     * @param string $renderContent
     * @return MailableAbstract
     */
    public function setRenderContent(string $renderContent): MailableAbstract
    {
        $this->renderContent = $renderContent;
        return $this;
    }



}