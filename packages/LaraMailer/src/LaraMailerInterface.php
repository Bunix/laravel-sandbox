<?php namespace LaraMailer;

/**
 * Interface LaraMailerInterface
 * @package LaraMailer
 *
 * Interface for using different PHP mailer libraries with LaraMailer
 *
 */
interface LaraMailerInterface
{

    /**
     * Set Message Type
     *
     * @param $message_type
     * @return object
     */
    public function type($message_type);

    /**
     * Get Message Type
     *
     */
    public function getType();

    /**
    * Sends mail
    *
    * @return boolean
    */
    public function send();

    /**
     * Set Email Layout
     *
     * @param $layout_path
     * @return object
     */
    public function layout($layout_path);

    /**
     * Set Email Template
     *
     * @param $template_path
     * @return object
     */
    public function template($template_path);

    /**
     * Set To Address
     *
     * @param $email_address
     * @return mixed
     */
    public function to($email_address);

    /**
     * Set Email Subject
     *
     * @param $subject
     * @return object
     */
    public function subject($subject);

    /**
     * Adds a Carbon Copy(CC) address
     *
     * @param $address
     * @return object
     */
    public function cc($address);

    /**
     * Adds a Blind Carbon Copy(BCC) address
     *
     * @param $address
     * @return object
     */
    public function bcc($address);

    /**
     * Set Message Data
     *
     * @param $message_data
     * @return mixed
     */
    public function messageData($message_data);

    /**
     * Clear Message Data
     *
     * @return mixed
     */
    public function clearMessageData();

    /**
     * Attaches file to mail
     *
     * @param $pathToFile
     * @return object
     */
    public function attach($pathToFile);

}