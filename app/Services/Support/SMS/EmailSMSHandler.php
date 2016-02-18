<?php namespace App\Services\Support\SMS;

use Larablocks\Pigeon\PigeonInterface;

class EmailSMSHandler
{
    /**
     * Mailer Object
     *
     * @var PigeonInterface
     */
    private $mailer;

    /**
     * Phone Providers
     *
     * @var array
     */
    private $phone_providers = [
        '3 River Wireless' => 'sms.3rivers.net',
        'ACS Wireless' => 'paging.acswireless.com',
        'Alltel' => 'message.alltel.com',
        'AT&T' => 'txt.att.net',
        'Bell Canada' => 'txt.bellmobility.ca',
        'Bell Mobility (Canada)' => 'txt.bell.ca',
        'Bell Mobility' => 'txt.bellmobility.ca',
        'Blue Sky Frog' => 'blueskyfrog.com',
        'Bluegrass Cellular' => 'sms.bluecell.com',
        'Boost Mobile' => 'myboostmobile.com',
        'BPL Mobile' => 'bplmobile.com',
        'Carolina West Wireless' => 'cwwsms.com',
        'Cellular One' => 'mobile.celloneusa.com',
        'Cellular South' => 'csouth1.com',
        'Centennial Wireless' => 'cwemail.com',
        'CenturyTel' => 'messaging.centurytel.net',
        'Cingular (Now AT&T)' => 'txt.att.net',
        'Clearnet' => 'msg.clearnet.com',
        'Comcast' => 'comcastpcs.textmsg.com',
        'Corr Wireless Communications' => 'corrwireless.net',
        'Dobson' => 'mobile.dobson.net',
        'Edge Wireless' => 'sms.edgewireless.com',
        'Fido' => 'fido.ca',
        'Golden Telecom' => 'sms.goldentele.com',
        'Helio' => 'messaging.sprintpcs.com',
        'Houston Cellular' => 'text.houstoncellular.net',
        'Idea Cellular' => 'ideacellular.net',
        'Illinois Valley Cellular' => 'ivctext.com',
        'Inland Cellular Telephone' => 'inlandlink.com',
        'MCI' => 'pagemci.com',
        'Metrocall' => 'page.metrocall.com',
        'Metrocall 2-way' => 'my2way.com',
        'Metro PCS' => 'mymetropcs.com',
        'Microcell' => 'fido.ca',
        'Midwest Wireless' => 'clearlydigital.com',
        'Mobilcomm' => 'mobilecomm.net',
        'MTS' => 'text.mtsmobility.com',
        'Nextel' => 'messaging.nextel.com',
        'OnlineBeep' => 'onlinebeep.net',
        'PCS One' => 'pcsone.net',
        'President\'s Choice' => 'txt.bell.ca',
        'Public Service Cellular' => 'sms.pscel.com',
        'Qwest' => 'qwestmp.com',
        'Rogers AT&T Wireless' => 'pcs.rogers.com',
        'Rogers Canada' => 'pcs.rogers.com',
        'Satellink' => 'satellink.net',
        'Solo Mobile' => 'txt.bell.ca',
        'Southwestern Bell' => 'email.swbw.com',
        'Sprint' => 'messaging.sprintpcs.com',
        'Sumcom' => 'tms.suncom.com',
        'Surewest Communicaitons' => 'mobile.surewest.com',
        'T-Mobile' => 'tmomail.net',
        'Telus' => 'msg.telus.com',
        'Tracfone' => 'txt.att.net',
        'Triton' => 'tms.suncom.com',
        'Unicel' => 'utext.com',
        'US Cellular' => 'email.uscc.net',
        'US West' => 'uswestdatamail.com',
        'Verizon' => 'vtext.com',
        'Virgin Mobile' => 'vmobl.com',
        'Virgin Mobile Canada' => 'vmobile.ca',
        'West Central Wireless' => 'sms.wcc.net',
        'Western Wireless' => 'cellularonewest.com'
    ];

    /**
     * EmailSMSHandler constructor.
     *
     * @param PigeonInterface $mailer
     */
    public function __construct(PigeonInterface $mailer )
    {
        $this->mailer = $mailer;
    }

    /**
     * Send an SMS text via email through a validated provider.
     *
     * @param $phone_number
     * @param $provider
     * @param $message
     * @param null $subject
     * @return bool
     */
    public function send($phone_number, $provider, $message, $subject = null)
    {
        $this->mailer->type('alert');

        // Set Subject
        if (!is_null($subject)) {
            $this->mailer->subject($subject);
        }

        $this->mailer->to($phone_number .'@'. $this->phone_providers[$provider]);
        $this->mailer->send($message);

        return true;
    }

}