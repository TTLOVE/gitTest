<?php

namespace Controller;
use Service\View;
use Service\Mail;

/**
 * Class BaseController
 * @author xiaozhu
 */
class BaseController
{
    protected $view;
    protected $mail;

    public function __construct()
    {
    }

    public function __destruct()
    {

        // 导入页面
        $view = $this->view;

        if ( $view instanceof View ) {
            extract($view->data);
            // render the template file and echo it
            echo $view->view->make($view->viewName, $view->data)->render();
        }

        // 发送邮件
        $mail = $this->mail;

        if ( $mail instanceof Mail ) {

            $mailer = new \Nette\Mail\SmtpMailer($mail->config);

            $mailer->send($mail);

        }
    }
}
