<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\EmailTranslation;
use App\Helpers\Helper;
use App\Constants\Constant;

class OTPNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $slug;

    private $user;

    private $language;

    private $url;

    private $notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id, $user, $url, $notification)
    {
       

        $this->slug = $id;
        $this->user = $user;
        $this->url = $url;
        $this->language = $user->language;
        $this->notification = $notification;
 
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $email = EmailTranslation::where('email_id', $this->slug)->where('locale', 'en')->select(['title', 'subject', 'description'])->first();
        $message = $email->description;
        $message = str_replace("[NAME]", Helper::mb_strtolower($this->user->name), $message);
        $message = str_replace("[EMAIL]", $this->user->email, $message);
        $message = str_replace("[SITE_NAME]", Helper::setting()->name, $message);
        $message = str_replace("[OTP]", $this->url, $message);
        $message = str_replace("[ACTION]", $this->notification, $message);
        $message = str_replace("[ACCOUNT_ACTIVATION_LINK]", $this->url, $message);
        $message = str_replace("[RESET_PASSWORD_LINK]", $this->url, $message);
        if($this->slug == 3){
            $message = str_replace("[PASSWORD]", $this->notification, $message);
        }

        return (new MailMessage)
            ->subject($email->subject)
            ->from(Helper::setting()->email, Helper::setting()->name)
            ->view('emails.notificationsEmail', ['data' => $message, 'language' => $this->language, 'url' => $this->url]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
