=== Mailing Group Listserv ===
Contributors: marcusbs
Donate link: https://www.wpmailinggroup.com
Tags: listserv, mailing group, listserve, email discussion, mailing list
Requires at least: 3.0.3
Tested up to: 6.6.2
Tested up to PHP: 8.2
Stable tag: 2.0.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Creates a Mailing Group on your site to which users can subscribe, messages sent to the group's email address will be forwarded to all members.

== Description ==

The WP MailingGroup plugin allows you to run a Mailing Group, also known as a Listserv, right from your WordPress website. You can sign up your users, friends, family etc, directly from your WordPress administration area, and they can then all exchange emails via their favourite email software, no need to login to wordpress dashboard. It has very easy to use intuitive interface and advanced debugging functions. This is NOT a one-way Announcement list where only YOU can email everyone else. Its a Two-Way mailing group just like Yahoo Groups, Google Groups etc (provides most functions of those groups but not all). It can be used as a partial alternative to php List and mailman. Its a wonderful wordpress group plugin to help you and your groups stay connected! - Premium version includes message moderation and archives.
<strong>Premium version offers Email message archives where so you can see all messages sent to mailing group in these archives. Users can also see archives of their groups. Pro version also supports email moderation.</strong>

<strong>Free Version - Features</strong>
<ul>
<li> Shortcode for display of sign-up form </li>
<li> Customisable CSS for sign-up form to match your website design</li>
<li> Double opt-in via email or direct member addition</li>
<li> Public, Invitation-only and Private group settings</li>
<li> Add members from WordPress User list </li>
<li> Import members from external .CSV file </li>
<li> Optional email alert to administrator when new member applications come in </li>
<li> ADVANCED AND EASY TROUBLESHOOTING FOR IMAP. Test connection button shows all debuggin information</li>
<li> Ability to send emails using 3 options, php, wp_mail and smtp.</li>
<li> Allows email attachments. </li>
<li> Prefix email subject lines with group name.</li>
<li> Customizeable group email footer.</li>
<li> Get Started now with these quick installation steps or watch video below: https://www.wpmailinggroup.com/faq/quick-start-in-6-steps/</li>
</ul>

[youtube https://www.youtube.com/watch?v=WFnLcyOwDbs ]

[Pro Version - Wordpress Mailing Group Listserv Plugin Features](https://www.wpmailinggroup.com/wordpress-mailing-group-premium-feature-list/) 
<blockquote>

<p>
The [WPMG](https://www.wpmailinggroup.com/) Pro plugin has several extra features other than all features of free plugin:</p>


*Unlimited mailing groups per domain name.<p></p>
*Unlimited members per mailing group.<p></p>
*Original Sender email can be shown in group email footer from group settings page. <p></p>
*Group administrator can choose what to set as "reply to" email for group. This means that when members reply to group emails using their email clients, it either goes to whole group, a custom email or original sender only. 
*Wordpress Mailing Group Pro has message moderation & archive functionality.<p></p>
*Quick Premium support for plugin initial setup.<p></p>
*Shortcode for displaying emails from any mailing group on frontend.<p></p>
*Application for multiple mailing groups from one sign-up form.<p></p>
*Support and new feature requests.<p></p>
*Allows email attachments. Ability to restrict size of email attachments <p></p>
*Email digest option mailing groups<p></p>
*Create WPMG API using action hooks in WPMG Pro. All emails which are sent to mailing groups can be sent to external webhook or API<p></p>
*NOW PHP 7 COMPATIBLE, DEMO AVAILABLE ON PREMIUM PLUGIN SITE www.WPMailingGroup.com<p></p>

<p>


</p>

</blockquote>
See [WPMG](https://www.wpmailinggroup.com/) Premium Official Site for FAQs and more.

== Installation ==
1. Unzip / Unrar the plugin folder and copy all the files to YOUR_SITE/wp-content/plugins/ folder.
2. You can also use the WordPress plugin uploader to do so via Plugins > Add new
3. Activate the plugin through the Plugins page in WordPress
4. Add a new Mailing Group from the plugin's control panel, inserting the relevant mail box details. Test imap connections using the button provided.
5. After setting up a mailing group, if you want to see status of Imap/Pop3 connection or sent emails, go to troubleshooting page ans 
5. Insert the registration form shortcode on a page or widget on your website if you wish for visitors to be able to subscribe to Mailing Groups via your website:

[mailing_group_form]
6. Optional (for low to medium traffic websites only): 
Paste the following command into the cron script manager on your server:
wget http://www.YOUR_SITE.com/wp-cron.php

On some systems, you may need to use a curl function instead: 
curl -s http://www.YOUR_SITE.com/wp-cron.php

For either function, the suggested frequency is every 2 minutes.
You will need to adjust the path according to where your WordPress installation is located. The above paths are for root level installations.

Full information on this can be found in the plugin s General Settings > Help panel.

There are various methods to set the crons on your server. Here are a few for your reference:

From cPanel:https://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/CronJobs

From Telnet / Putty / Command line (for Advanced Users):

http://www.web-site-scripts.com/knowledge-base/article/AA-00484/0/Setup-Cron-job-on-Linux-UNIX-via-command-line.html

== Frequently Asked Questions === 

= How many subscribers can I have in the mailing group? =

You can add up to 30 subscribers in ONE mailing group using the free plugin.

= Emails are not being sent to mailing group members, how to know what is wrong? =

The plugin has a page called 'Troubleshooting'. This page will show you latest errors for IMAP/POP3 connection for each group and also any email sending errors.

= Can I create my own customised messages to send to prospective subscribers? = 

Yes, you can: go to Mailing Group Manager > General Settings, and select the Custom Messages tab. There you can input your custom message (using the listed variables, if you are technical!). 
You can also go to Mailing Group Manager > Subscription Requests, and click the message icon next to a subscription request. This opens up a popup window where you can type in a custom message, and check the box at the bottom that allows you to save it for repeated use.

= I do not have access to cron scripts on my shared server. Can I still use the plugin? =

If you do not have cron access, then you will have to rely on visitors to your site to trigger the in-built WP-cron, which checks for new messages and distributes them to the list of subscribers. For example, if you have a visitor on average every 10 minutes, then the Mailing Group messages will be received and sent every 10 minutes. If you have Cron access, you can set a higher frequency of 2 minutes to keep the Mailing Group updated more often (see Installation instructions above), but without cron access, it may just run more slowly.  

=In my plain text emails, there are not line breaks, all text is on one line, what to do?

When some subscribers use HTML email format and some use plain text email format, the line breaks in emails do not appear correctly, to fix this you can install a plugin which converts all emails to HTML format, Read the instructions at https://www.wpmailinggroup.com/faq/strange-characters-in-emails/

=I am getting strange characters and HTML tags in emails, sometimes no line breaks how to fix that?

Read the instructions at https://www.wpmailinggroup.com/faq/strange-characters-in-emails/

== Screenshots ==

1. Screenshot-1.png - Your Mailing Group can be added and configured and only one Mailing Group is available in this Free plugin.
2. Screenshot-2.png - Add subscribers to the mailing group.
3. Screenshot-3.png - Shows the list of subscribers in the mailing group and buttons to activate their membership.
4. Screenshot-4.png - Import subscribers to the mailing group from Excel (VCF import is available in the Premium plugin).
5. Screenshot-5.png - Shows a focus of add a mailing group screen.
6. Screenshot-6.png - Group email footer is fully customizeable.

== Changelog ==

=2.0.8 =
*Replaced deprecated function imap_header.

=2.0.7 =
*Tested with latest wp version.

=2.0.6 =
*Allowed more email domains in add mailing group page.

=2.0.4 =
*Fixed a broken a tag in mailing group add screen.

=2.0.3 =
*Added some help text.

=2.0.2 =
*Compatible to PHP 8.

= 2.0.1 =
* Tested with Wordpress 5.6. 
* Increase subscriber limit in free version to 30 users. Previously was 20 users.


= 2.0.0 =
* Tested with Wordpress 5.6. 
* Increase subscriber limit in free version to 30 users. Previously was 20 users.

= 1.9.0 =
* Removed errors in connecting to imap. 

= 1.8.0 =
* Removed SMTP class dependency error. 
* Removed ssl error always evaluating to false for test imap connection.
* User registration emails showing html tags - Fixed.
* Email type HTML not working - Fixed.


= 1.7.4 =
* Fixed bugs from last release.

= 1.7.3=
* Corrected charset for emails, fixed strange characters problem in outlook emails.

= 1.7.2 =
* Set default for settings.

= 1.7.1 =
* Added list headers.

= 1.7.0 =
* Error fixing.

= 1.6.9 =
* Fixed outdated code and errors and warnings and removed outdated code.

= 1.6.7 =
* Fixed outdated code and errors and warnings.

= 1.6.6 =
* Mailing group not creating fixed. Fixed wpmg_parse_email.php warning.

= 1.6.5 =
* Removed more warning.

= 1.6.4 =
* Removed undefined variable errors from files and troubleshooting page.

= 1.6.3 =
* fixed emails not getting deleted from inbox and continuous cycle of same email.

= 1.6.2 =
* Checked compatibility with wordpress release 5.0.

= 1.6.1 =
* Fixed problem in adding new mailing group resulting from last update.
* Reverted mailing group add page to old version.

= 1.6.0 =
* Fixed warnings.
* Added help tips to mailing group add page.

= 1.3.9 =

* Removed plugin's phpmailer library and used wordpress packaged library instead.


= 1.3.8 =

* Removed a deprecated mysql function.


= 1.3.7 =

* Removed sql query for setting utf-8 because not wokred on majority servers.
* Fixed a critical bug related to user import.

= 1.3.6 =

* Added filter to modify mailbox connection string.
* Ensure the connection to sql is utf-8.
* SMTP mail troubleshooting fix.

= 1.3.5 =

* Added import users function for each group individually
* Added option to delete users from mailing group only, or totally from WP system
* Fixed attachment name bug for invalid attachment names
* Fixed foreign language issues for subject and email body
* Changed subject and email character and transfer encoding to UTF-8
* Added a test email page to test group email

= 1.3.4 =

* Fixed import duplicate user issue.
* Updated languages files. 
* Updated character issues.
* Resolved attachment file url issue.

= 1.3.3 =
* Fixed plugin parsed email bug.
* Implement German language translation.

= 1.3.2 =

* Fixed import duplicate user issue.
* Updated languages files. 
* Resolved free to premium update bug.
* Updated character issues.
* Resolved attachment file url issue.

= 1.3.1 =
* Fixed plugin update bug.

= 1.3 =
* Updated save attachment module.
* Resolved bug fixes and formatting.

= 1.2.2 =
* Resolved updated plugin version issue.
* Resolved attachment issue and added attachment settings.
* Fixed mailing charactor issue.

= 1.2.1 =
* Resolved import csv file issue.
* Fixed plugin update bug.

= 1.2 =
* Fixed mailing reply-to Group email issue. 
* Resolved Group member delete issue.

= 1.1 =
* Additional settings for Mail checking and sending: separate field for username.
* Fix for  has_cap Deprecated  notices.

= 1.0 =
* First version of the plugin released.

