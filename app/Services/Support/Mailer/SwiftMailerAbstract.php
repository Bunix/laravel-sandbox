<?php namespace App\Services\Support\Mailer;

/**
 * Class SwiftMailerAbstract
 * @package App\Services\Mailer
 *
 * This class defines abstract Swift Mailer methods
 *
 */
abstract class SwiftMailerAbstract implements MailerInterface
{

    protected $layout = 'emails.layouts.default';

    protected $template;

    protected $subject;

    protected $to_data;

    protected $body_data;

    protected $cc = [];

    protected $bcc = [];

    protected $attachments = [];

    protected $pretend = false;


    /**
     * Swift Mailer Abstract Constructor
     *
     * @param $to_data
     * @param $body_data
     */
    public function __construct($to_data=null, $body_data=null)
    {
        if (!is_null($to_data)) {
            $this->to_data = $to_data;
        }

        if (!is_null($body_data)) {
            if (!is_array($body_data)) {
                $this->body_data['body'] = $body_data;
            } else {
                $this->body_data = $body_data;
            }
        }

        $this->assignTemplate();
    }

    /**
    * Send Mail
    *
    * @return boolean
    */
    public function send()
    {

        // Set pretend value
        \Mail::pretend($this->pretend);

        \Mail::send($this->layout, $this->body_data, function($message)
        {
            // Set To and Subject
            $message->to($this->to_data)->subject($this->subject);

            // Set all CC
            foreach ($this->cc as $cc) {
                $message->cc($cc);
            }

            // Set all BCC
            foreach ($this->bcc as $bcc) {
                $message->bcc($bcc);
            }

            // Set all attachments
            foreach ($this->attachments as $a) {
                $message->attach($a['path'], $a['options']);
            }
        });

        // Turn pretend back to global config after send
        \Mail::pretend(\Config::get('mail.pretend'));

        return true;
    }


    /**
     * Set Email Layout
     *
     * @param $view
     * @return \App\Services\Support\Mailer\SwiftMailerAbstract
     */
    public function setLayout($view)
    {
        $this->layout = $view;

        return $this;
    }


    /**
     * Set Email Template
     *
     * @param $view
     * @return \App\Services\Support\Mailer\SwiftMailerAbstract
     */
    public function setTemplate($view)
    {
        $this->body_data['_template'] = $view;

        return $this;
    }


    /**
     * Set To
     *
     * @param $to_data
     * @return $this
     */
    public function to($to_data)
    {
        $this->to_data = $to_data;

        return $this;
    }

    /**
     * Set HTML body data
     *
     * @param $body_data
     * @return $this
     */
    public function setBodyData($body_data)
    {
        if (!is_array($body_data)) {
            $this->body_data['body'] = $body_data;
        } else {
            $this->body_data = $body_data;
        }

        $this->assignTemplate();

        return $this;
    }

    /**
     * Set Subject
     *
     * @param $subject
     * @return \App\Services\Support\Mailer\SwiftMailerAbstract
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Adds a Carbon Copy(CC) address
     *
     * @param $address
     * @return \App\Services\Support\Mailer\SwiftMailerAbstract
     */
    public function cc($address)
    {
         array_push($this->cc, $address);

         return $this;
    }

    /**
     * Adds a Blind Carbon Copy(BCC) address
     *
     * @param $address
     * @return \App\Services\Support\Mailer\SwiftMailerAbstract
     */
    public function bcc($address)
    {
       array_push($this->bcc, $address);

       return $this;
    }

    /**
     * Attaches file to mail
     *
     * @param $pathToFile
     * @param array $options
     * @return \App\Services\Support\Mailer\SwiftMailerAbstract
     */
    public function attach($pathToFile, $options = array())
    {
       $attachment['path'] = base_path().$pathToFile;
       $attachment['options'] = $options;

       array_push($this->attachments, $attachment);

       return $this;
    }

    /**
     * Use Laravel pretend method and send mail to log file instead
     *
     * @param bool $value
     * @return \App\Services\Support\Mailer\SwiftMailerAbstract
     */
    public function pretend($value = true)
    {
       $this->pretend = $value;

       return $this;
    }

    /**
     * Assign the template variable into body data
     *
     */
    private function assignTemplate()
    {
        $this->body_data['_template'] = $this->template;
    }

}