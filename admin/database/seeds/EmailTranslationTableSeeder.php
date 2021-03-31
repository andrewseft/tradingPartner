<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmailTranslationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_translations')->insert([
            [
                'email_id' => 1,
                'locale' => 'en',
                'title' => 'This email is sent to user when user clicks Forgot Password',
                'subject' => 'Reset  Password',
                'description' => '
                    <p>Dear <strong>[NAME]</strong></p>

                    <p>A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, click on button:</p>

                    <center><a href="[RESET_PASSWORD_LINK]" rel="nofollow" style="display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none" target="_other">Reset Password</a></center>

                    <p>If you&rsquo;re having trouble clicking the &#39;Reset Password&#39; button, copy and paste the URL below into your web browser:</p>

                    <p>[RESET_PASSWORD_LINK]</p>

                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>
                ',
                'keyword' => '
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50">&nbsp;</th>
                                <th width="400">Information PlaceHolder</th>
                                <th>Explaination</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>[NAME]</td>
                                <td>This will be replaced by full name of user.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>[RESET_PASSWORD_LINK]</td>
                                <td>This will be replaced by link of reset password in email.</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Message</td>
                                <td>
                                <p>Dear <strong>tradingPartner</strong></p>

                                <p>A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, click on button:</p>

                                <center><a href="[RESET_PASSWORD_LINK]" rel="nofollow" style="display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none" target="_other">Reset Password</a></center>

                                <p>If you&rsquo;re having trouble clicking the &#39;Reset Password&#39; button, copy and paste the URL below into your web browser:</p>

                                <p>www.tradingPartner.com/reset_password</p>

                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email_id' => 2,
                'locale' => 'en',
                'title' => 'This email is sent to user when they reset their password successfully',
                'subject' => 'Password Reset Successfully',
                'description' => '
                    <p>Dear <strong>[NAME]</strong></p>

                    <p>A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, click on button:</p>

                    <center><a href="[RESET_PASSWORD_LINK]" rel="nofollow" style="display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none" target="_other">Reset Password</a></center>

                    <p>If you&rsquo;re having trouble clicking the &#39;Reset Password&#39; button, copy and paste the URL below into your web browser:</p>

                    <p>[RESET_PASSWORD_LINK]</p>

                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>
                ',
                'keyword' => '
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50">&nbsp;</th>
                                <th width="400">Information PlaceHolder</th>
                                <th>Explaination</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>[NAME]</td>
                                <td>This will be replaced by full name of user.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Message</td>
                                <td>
                                <p>Dear<strong> tradingPartner</strong></p>

                                <p>You have reset your password successfully.</p>

                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email_id' => 3,
                'locale' => 'en',
                'title' => 'User/ Driver will receive this confirmation email when User/ Driver creates an account',
                'subject' => 'Activate your account',
                'description' => '
                    <p>Dear <strong>[NAME]&nbsp;</strong></p>

                    <p>Your account has been&nbsp;set up at <strong>[SITE_NAME]</strong>.&nbsp;Kindly click the Account Activation Link&nbsp;to verify your email address.</p>

                    <p>&nbsp;</p>

                    <center><a href="[ACCOUNT_ACTIVATION_LINK]" style="display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none" target="_other">Account Activation Link</a></center>

                    <p>&nbsp;</p>

                    <p>Email Address: [EMAIL]</p>

                    <p>If you&rsquo;re having trouble clicking the &#39;Account Activation Link&#39; button, copy and paste the URL below into your web browser:</p>

                    <p><a class="view_link" href="[ACCOUNT_ACTIVATION_LINK]" style="word-break: break-all;" target="_other">[ACCOUNT_ACTIVATION_LINK]</a></p>

                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>
                ',
                'keyword' => '
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50">&nbsp;</th>
                            <th width="400">Information PlaceHolder</th>
                            <th>Explaination</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>[NAME]</td>
                                <td>This will be replaced by full name of user.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>[SITE_NAME]</td>
                                <td>This will be replaced by Name of platform/Website.</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>[EMAIL]</td>
                                <td>This will be replaced by EMAIL of user.</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>[ACCOUNT_ACTIVATION_LINK]</td>
                                <td>This will be replaced by account activation link.</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Message</td>
                                <td>
                                <p>Dear <strong>tradingPartner&nbsp;</strong></p>

                                <p>Your account has been&nbsp;set up at <strong>tradingPartner.com</strong>.&nbsp;Kindly click the Account Activation Link&nbsp;to verify your email address.</p>

                                <p>&nbsp;</p>

                                <center><a href="[ACCOUNT_ACTIVATION_LINK]" style="display: inline-block ; padding: 11px 30px ; margin: 20px 0px 30px ; font-size: 15px ; color: #fff ; background: #0062cc; border-radius: 60px ; text-decoration: none" target="_other">Account Activation Link</a></center>

                                <p>&nbsp;</p>

                                <p>Email Address: user@tradingPartner.com</p>

                                <p>If you&rsquo;re having trouble clicking the &#39;Account Activation Link&#39; button, copy and paste the URL below into your web browser:</p>

                                <p><a class="view_link" href="[ACCOUNT_ACTIVATION_LINK]" style="word-break: break-all;" target="_other">tradingPartner.com/account/activation</a></p>

                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email_id' => 4,
                'locale' => 'en',
                'title' => 'Account Active',
                'subject' => 'Account Active',
                'description' => '
                    <h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Dear [NAME],</h1>

                    <p>Your account has been successfully activated on <strong>[SITE_NAME]</strong>, now you can log in your account.</p>

                    <center>&nbsp;</center>',
                    'keyword' => '<h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Dear [NAME],</h1>

                    <p>Your account has been successfully activated on <strong>[SITE_NAME]</strong>, now you can log in your account.</p>

                    <center>&nbsp;</center>
                ',
                'keyword'=>'
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50">&nbsp;</th>
                                <th width="400">Information PlaceHolder</th>
                                <th>Explaination</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>[NAME]</td>
                                <td>This will be replaced by full name of user.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>[SITE_NAME]</td>
                                <td>This will be replaced by Name of platform/Website.</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Message</td>
                                <td>
                                <h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Dear tradingPartner,</h1>

                                <p>Your account has been successfully activated on <strong>tradingPartner.com</strong>, now you can log in to your account.</p>

                                <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>

                                <center>&nbsp;</center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email_id' => 5,
                'locale' => 'en',
                'title' => 'User/ Driver will receive this email when there is a new notification',
                'subject' => 'You have a new notification',
                'description' => '
                    <h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Dear [NAME],</h1>

                    <p>Your account has been successfully activated on <strong>[SITE_NAME]</strong>, now you can log in to your account.</p>

                    <p>If you have any questions, please email us at enquiry@tradingPartner.com</p>

                    <center>&nbsp;</center>
                ',
                'keyword'=>'
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50">&nbsp;</th>
                                <th width="400">Information PlaceHolder</th>
                                <th>Explaination</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>[NAME]</td>
                                <td>This will be replaced by full name of user.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>[ACTION]</td>
                                <td>This will be replaced by Action of platform/Website.</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Message</td>
                                <td>
                                <p>Dear<strong> tradingPartner&nbsp;</strong></p>

                                <p>You have a new notification, kindly check in your account.</p>

                                <p><span>Your account has been deactivated</span></p>

                                <p>If you have any questions, please email us at info@tradingPartner.com</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
