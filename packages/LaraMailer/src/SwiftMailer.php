<?php namespace LaraMailer;

use ErrorException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


/**
 * Class SwiftMailerAbstract
 * @package LaraMailer
 *
 * This class utilizes Laravel 5 Swift Mailer methods for a LaraMailer Implementation
 *
 */
class SwiftMailer extends LaraMailerAbstract implements LaraMailerInterface
{

    /**
     * Pretend On/Off
     *
     * @var bool
     */
    protected $pretend = false;

    /**
     * Swift Mailer Abstract Constructor
     *
     * @param LaraMailerLayout $mailer_layout
     */
    public function __construct(LaraMailerLayout $mailer_layout)
    {
        $this->mailer_layout = $mailer_layout;
    }

    /**
     * Send Mail
     *
     * @param null $raw_message
     * @return bool
     */
    public function send($raw_message = null)
    {
        // Set pretend value
        Mail::pretend($this->pretend);

        // Set Optional Message Data
        if (!is_null($raw_message)) {
            $send_result = $this->sendRawMessage($raw_message);
        } else {
            $send_result = $this->sendMessage();
        }

        // Turn pretend back to global config after send
        Mail::pretend(config('mail.pretend'));

        return $send_result;
    }


    /**
     * Send SwiftMail Message
     *
     * @return bool
     */
    private function sendMessage()
    {
        try {
            Mail::send($this->mailer_layout->getViewLayout(), $this->mailer_layout->getMessageVariables(), function ($message) {

                // Set message parts
                $message->to($this->to)
                    ->subject($this->subject)
                    ->cc($this->cc)
                    ->bcc($this->bcc);

                // Set all attachments
                foreach ($this->attachments as $a) {
                    $message->attach($a['path'], $a['options']);
                }

                $this->subjectWarning();
            });
        } catch (ErrorException $e) {
            $msg = 'SwiftMail could not send message: ' . $e->getMessage();
            Log::error($msg);
            return false;
        } catch (\Swift_TransportException $e) {
            $msg = 'SwiftMail SMTP is not working: ' . $e->getMessage();
            Log::error($msg);
            return false;
        }

        return true;
    }


    /**
     * Send SwiftMail Raw Message
     *
     * @param $message
     * @return bool
     */
    private function sendRawMessage($message)
    {
        try {
            Mail::raw($message, function ($message) {

                // Set message parts
                $message->to($this->to)
                    ->subject($this->subject)
                    ->cc($this->cc)
                    ->bcc($this->bcc);

                // Set all attachments
                foreach ($this->attachments as $a) {
                    $message->attach($a['path'], $a['options']);
                }

                $this->subjectWarning();
            });
        } catch (ErrorException $e) {
            $msg = 'SwiftMail could not send message: ' . $e->getMessage();
            dd($msg);
            Log::error($msg);
            return false;
        } catch (\Swift_TransportException $e) {
            $msg = 'SwiftMail SMTP is not working: ' . $e->getMessage();
            dd($msg);
            Log::error($msg);
            return false;
        }

        return true;
    }

    /**
     * Use Laravel pretend method and send mail to log file instead
     *
     * @param bool $value
     * @return LaraMailerAbstract
     */
    public function pretend($value = true)
    {
       $this->pretend = $value;

       return $this;
    }
}