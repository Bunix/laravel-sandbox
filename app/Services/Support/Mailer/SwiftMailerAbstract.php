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

    /**
     * Constant representing a variable that will hold the message data in email view if data is not an array.
     *
     */
    const MESSAGE_VARIABLE = '_message';

    /**
     * Constant representing a variable that will hold the template path in email view.
     */
    const TEMPLATE_VARIABLE = '_template';

    /**
     * Email Layout View Path
     *
     * @var string
     */
    protected $layout = 'emails.layouts.default';

    /**
     * Email Template View Path
     *
     * @var
     */
    protected $template = 'emails.templates.default';

    /**
     * Subject
     *
     * @var
     */
    protected $subject;

    /**
     * To
     *
     * @var null
     */
    protected $to_data;

    /**
     * Message Data
     *
     * @var
     */
    protected $message_data;

    /**
     * CC Addresses
     *
     * @var array
     */
    protected $cc = [];

    /**
     * BCC Addresses
     *
     * @var array
     */
    protected $bcc = [];

    /**
     * File Attachments
     *
     * @var array
     */
    protected $attachments = [];

    /**
     * Pretend On/Off
     *
     * @var bool
     */
    protected $pretend = false;


    /**
     * Swift Mailer Abstract Constructor
     *
     * @param null $to_data
     * @param null $message_data
     */
    public function __construct($to_data = null, $message_data = null)
    {
        if (!is_null($to_data)) {
            $this->to_data = $to_data;
        }

        if (!is_null($message_data)) {
            $this->processMessageData($message_data);
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

        \Mail::send($this->layout, $this->message_data, function($message)
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
     * @return SwiftMailerAbstract
     */
    public function setLayout($view)
    {
        $this->layout = $view;

        return $this;
    }


    /**
     * Set Email Template
     *
     * @param $template
     * @return SwiftMailerAbstract
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        $this->assignTemplate();

        return $this;
    }


    /**
     * Set To
     *
     * @param $to_data
     * @return SwiftMailerAbstract
     */
    public function to($to_data)
    {
        $this->to_data = $to_data;

        return $this;
    }

    /**
     * Set Message data
     *
     * @param $message_data
     * @return SwiftMailerAbstract
     */
    public function setMessageData($message_data)
    {
        $this->processMessageData($message_data);

        return $this;
    }


    /**
     * Set Subject
     *
     * @param $subject
     * @return SwiftMailerAbstract
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
     * @return SwiftMailerAbstract
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
     * @return SwiftMailerAbstract
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
     * @return SwiftMailerAbstract
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
     * @return SwiftMailerAbstract
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
        $this->message_data[SwiftMailerAbstract::TEMPLATE_VARIABLE] = $this->template;
    }

    /**
     * Process Message for passing to view
     *
     * @param $data
     */
    private function processMessageData($data)
    {
        if (!is_array($data)) {
            $this->message_data[SwiftMailerAbstract::MESSAGE_VARIABLE] = $data;
        } else {
            $this->message_data = $data;
        }
    }


}