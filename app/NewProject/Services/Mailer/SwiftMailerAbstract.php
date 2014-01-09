<?php namespace NewProject\Services\Mailer;

/*
 * This class defines abstract Mailer methods
 */

abstract class SwiftMailerAbstract implements MailerInterface {

    protected $layout = 'emails.layouts.default';

    protected $template;

    protected $subject;

    protected $to_data;

    protected $body_data;

    protected $cc = array();

    protected $bcc = array();

    protected $attachments = array();

    /**
    * @params array $input
    *
    */
    public function __construct($to_data, $body_data)
    {
        $this->to_data = $to_data;
        $this->body_data = $body_data;
        $this->body_data['template'] = $this->template;
    }

    /**
    * Send Mail
    *
    * @return boolean
    */
    public function send()
    {
        \Mail::send($this->layout, $this->body_data, function($message)
        {
            // Set to
            $message->to($this->to_data)->subject($this->subject);

            // Set all CC
            foreach($this->cc as $cc) {
                $message->cc($cc);
            }

            // Set all BCC
            foreach($this->bcc as $bcc) {
                $message->bcc($bcc);
            }

            // Set all attachments
            foreach($this->attachments as $a) {
                $message->attach($a['path'], $a['options']);
            }

            return true;
        });
    }


    /**
     * Sets Subject
     *
     * @param $subject
     * @return \NewProject\Services\Mailer\SwiftMailerAbstract
     */
    public function subject($subject) {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Adds a Carbon Copy(CC) address
     *
     * @param $address
     * @return \NewProject\Services\Mailer\SwiftMailerAbstract
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
     * @return \NewProject\Services\Mailer\SwiftMailerAbstract
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
     * @return \NewProject\Services\Mailer\SwiftMailerAbstract
     */
    public function attach($pathToFile, $options = array())
    {
       $attachment['path'] =  $pathToFile;
       $attachment['options'] = $options;

       array_push($this->attachments, $attachment);

       return $this;
    }

}