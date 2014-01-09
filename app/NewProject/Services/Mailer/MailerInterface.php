<?php namespace NewProject\Services\Mailer;

interface MailerInterface {


    /**
    * Sends mail
    *
    * @return boolean
    */
    public function send();


    /**
     * Sets Subject
     *
     * @param $subject
     * @return boolean
     */
    public function subject($subject);


    /**
     * Adds a Carbon Copy(CC) address
     *
     * @param $address
     * @return boolean
     */
    public function cc($address);

    /**
     * Adds a Blind Carbon Copy(BCC) address
     *
     * @param $address
     * @return boolean
     */
    public function bcc($address);

    /**
     * Attaches file to mail
     *
     * @param $pathToFile
     * @return boolean
     */
    public function attach($pathToFile);

}