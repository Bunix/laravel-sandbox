<?php
namespace App\Services\Mailer;

/**
 * Class SwiftMailerAbstract
 * @package App\Services\Mailer
 *
 * This class defines abstract Swift Mailer methods
 *
 */
abstract class SwiftMailerAbstract implements MailerInterface
{

    protected $_layout = 'emails.layouts.default';

    protected $_template;

    protected $_subject;

    protected $_to_data;

    protected $_body_data;

    protected $_cc = array();

    protected $_bcc = array();

    protected $_attachments = array();

    protected $_pretend = false;


    /**
     * Swift Mailer Abstract Constructor
     *
     * @param $to_data
     * @param $body_data
     */
    public function __construct($to_data=null, $body_data=null)
    {
        if(!is_null($to_data))
            $this->_to_data = $to_data;

        if(!is_null($body_data)) {
            if (!is_array($body_data))
                $this->_body_data['body'] = $body_data;
            else
                $this->_body_data = $body_data;
        }

        $this->_assignTemplate();
    }

    /**
    * Send Mail
    *
    * @return boolean
    */
    public function send()
    {

        // Set pretend value
        \Mail::pretend($this->_pretend);

        \Mail::send($this->_layout, $this->_body_data, function($message)
        {
            // Set To and Subject
            $message->to($this->_to_data)->subject($this->_subject);

            // Set all CC
            foreach($this->_cc as $cc) {
                $message->cc($cc);
            }

            // Set all BCC
            foreach($this->_bcc as $bcc) {
                $message->bcc($bcc);
            }

            // Set all attachments
            foreach($this->_attachments as $a) {
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
     * @return \App\Services\Mailer\SwiftMailerAbstract
     */
    public function setLayout($view)
    {
        $this->_layout = $view;

        return $this;
    }


    /**
     * Set Email Template
     *
     * @param $view
     * @return \App\Services\Mailer\SwiftMailerAbstract
     */
    public function setTemplate($view)
    {
        $this->_body_data['_template'] = $view;

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
        $this->_to_data = $to_data;

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
        if(!is_array($body_data))
            $this->_body_data['body'] = $body_data;
        else
            $this->_body_data = $body_data;

        $this->_assignTemplate();

        return $this;
    }

    /**
     * Set Subject
     *
     * @param $subject
     * @return \App\Services\Mailer\SwiftMailerAbstract
     */
    public function subject($subject)
    {
        $this->_subject = $subject;

        return $this;
    }

    /**
     * Adds a Carbon Copy(CC) address
     *
     * @param $address
     * @return \App\Services\Mailer\SwiftMailerAbstract
     */
    public function cc($address)
    {
         array_push($this->_cc, $address);

         return $this;
    }

    /**
     * Adds a Blind Carbon Copy(BCC) address
     *
     * @param $address
     * @return \App\Services\Mailer\SwiftMailerAbstract
     */
    public function bcc($address)
    {
       array_push($this->_bcc, $address);

       return $this;
    }

    /**
     * Attaches file to mail
     *
     * @param $pathToFile
     * @param array $options
     * @return \App\Services\Mailer\SwiftMailerAbstract
     */
    public function attach($pathToFile, $options = array())
    {
       $attachment['path'] = base_path().$pathToFile;
       $attachment['options'] = $options;

       array_push($this->_attachments, $attachment);

       return $this;
    }

    /**
     * Use Laravel pretend method and send mail to log file instead
     *
     * @param bool $value
     * @return \App\Services\Mailer\SwiftMailerAbstract
     */
    public function pretend($value = true)
    {
       $this->_pretend = $value;

       return $this;
    }

    /**
     * Assign the template variable into body data
     *
     */
    private function _assignTemplate()
    {
        $this->_body_data['_template'] = $this->_template;
    }

}