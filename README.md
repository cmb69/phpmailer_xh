# Phpmailer_XH

Phpmailer_XH provides [PHPMailer](https://github.com/PHPMailer/PHPMailer),
a full-featured email creation and transfer component for PHP, for easy
and frictionless usage by other CMSimple_XH plugins.

## Table of Contents

- [Requirements](#requirements)
- [Download](#download)
- [Installation](#installation)
- [Settings](#settings)
- [Usage](#usage)
  - [SMTP](#smtp)
  - [For Developers](#for-developers)
- [Troubleshooting](#troubleshooting)
- [License](#license)
- [Credits](#credits)

## Requirements

Phpmailer_XH is a plugin for [CMSimple_XH](https://www.cmsimple-xh.org/).
It requires CMSimple_XH ≥ 1.7.0, and PHP ≥ 7.1.0.

## Download

The [lastest release](https://github.com/cmb69/phpmailer_xh/releases/latest)
is available for download on Github.

## Installation

The installation is done as with many other CMSimple_XH plugins.

1. Backup the data on your server.
1. Unzip the distribution on your computer.
1. Upload the whole directory `phpmailer/` to your server into
   the `plugins/` directory of CMSimple\_XH.
1. Set write permissions for the subdirectories `config/`
   and `languages/`.
1. Navigate to `Plugins` → `Phpmailer` in the back-end to check if all
   requirements are fulfilled.

## Settings

The configuration of the plugin is done as with many other
CMSimple_XH plugins in the back-end of the website.
Select `Plugins` → `Phpmailer`.

You can change the default settings of Phpmailer_XH under `Config`.
Hints for the options will be displayed
when hovering over the help icon with your mouse.

Localization is done under `Language`.
You can translate the character strings to your own language
if there is no appropriate language file available,
or customize them according to your needs.

## Usage

First, you should configure your email address
(`Plugins` → `Phpmailer` → `Config` -> `Sender` → `Address`).
The system check will do a basic validity check of the address.

Then you are encouraged to enable SMTP; see the following section.

### SMTP

Per default, Phpmailer_XH uses the `mail()` function of PHP,
which is typically just a simple [sendmail](https://en.wikipedia.org/wiki/Sendmail) wrapper.
This way to send mails has some limitations,
and is no longer supported by some Webservers.

Thus, you are encouraged to enable SMTP support in the configuration.
It is important to properly fill in all relevant configuration settings;
request the necessary information from your mail provider.
If the SMTP server requires authentication (quite likely),
you have to provide the username and password in the configuration.
Note that these credentials are necessarily stored in plain text in
`plugins/phpmailer/config/config.php`.
Therefore it is important that the configuration folder of Phpmailer_XH is
protected against direct access.  The plugin ships with a respective `.htaccess`
file, but this may not be recognized by your server, so you need to take
suitable measures yourself.  Before entering the sensitive credentials into
the configuration, check whether the system check is green regarding the
access protection of `config.php`.

If you have trouble with the SMTP configuration,
i.e. some plugin using Phpmailer_XH cannot send emails,
you can enable the `SMTP` → `Debug` configuration option.
When you are logged in as administrator, a detailed log
of the communication with the SMTP server will be shown if a mail is sent
(note that this debug output may contain sensitve information;
therefore it is never shown to visitors of your site).
The debug output may already be sufficient for you to solve the issue;
otherwise see [Troubleshooting](#troubleshooting).

### For Developers

Other plugins can use PHPMailer exactly like before; they just need to
remove their own `require` or `include` statements which include `PHPMailer`
and possibly some additional helper classes (like `SMTP`), since the
required classes will be autoloaded by CMSimple_XH.

For plugins using `XH\Mail`, there is a shim available: `PHPMailer\Mail`,
which roughly works like before, but uses PHPMailer under the hood.

However, either variant would ignore the configuration of Phpmailer_XH,
unless the plugin would apply that manually.
The convenient way to use the Phpmailer_XH configuration is to
create an instance of `PHPMailer` by calling

    phpmailer_create()

This function returns a preconfigured `PHPMailer` which then can
be used almost (see below) like before, for instance:

    $mail = phpmailer_create();
    $mail->addAddress("joe@example.com");
    $mail->Subject = "Hey Joe!";
    $mail->Body = "where you goin’ with that gun in your hand?";
    $mail->send();

To apply the Phpmailer_XH configuration to `PHPMailer\Mail`:

    $mail = new PHPMailer\Mail(phpmailer_create());

Note that you must not call any of the `PHPMailer` methods which change
the sending method (i.e. `::isSMTP()`, `::isMail()` and `::isSendmail()`),
since that would override the Phpmailer_XH configuration.
That also applies to any SMTP configuration changes to the `PHPMailer`
instance.

Also note that you must not change the sender/from address
by calling `::setFrom()`, since this is alreay configured.
Instead, call `::addReplyTo()` to set this address.

## Troubleshooting

Report bugs and ask for support either on
[Github](https://github.com/cmb69/phpmailer_xh/issues)
or in the [CMSimple\_XH Forum](https://cmsimpleforum.com/).

## License

Phpmailer_XH is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Phpmailer_XH is distributed in the hope that it will be useful,
but *without any warranty*; without even the implied warranty of
*merchantibility* or *fitness for a particular purpose*. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Phpmailer_XH.  If not, see <https://www.gnu.org/licenses/>.

Copyright © Christoph M. Becker

## Credits

The plugin is inspired by *olape* who made the CMSimple_XH community
aware of the need of direct SMTP sending of emails (instead of using
the `mail()` function of PHP).

Many thanks to all maintainers of PHPMailer for providing this simple
and great email solution over the years.

The plugin logo is from
[Email icons created by Freepik - Flaticon](https://www.flaticon.com/free-icons/email).
Many thanks for making this icon freely available.

Many thanks to the community at the [CMSimple_XH forum](https://www.cmsimpleforum.com/)
for tips, suggestions and testing.

And last but not least many thanks to
[Peter Harteg](https://www.harteg.dk/), the “father” of CMSimple,
and all developers of [CMSimple\_XH](https://www.cmsimple-xh.org/)
without whom this amazing CMS would not exist.
