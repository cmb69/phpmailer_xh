<?php

namespace PHPMailer;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * @author    Peter Harteg <peter@harteg.dk>
 * @author    The CMSimple_XH developers <devs@cmsimple-xh.org>
 * @author    Christoph M. Becker
 * @copyright 1999-2009 Peter Harteg
 * @copyright 2009-2019 The CMSimple_XH developers <http://cmsimple-xh.org/?The_Team>
 * @copyright 2025 Christoph M. Becker
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @see       http://cmsimple-xh.org/
 */
class Mail
{
    /** @var PHPMailer */
    private $mailer;

    public function __construct(?PHPMailer $mailer = null)
    {
        $this->mailer = $mailer ?? new PHPMailer();
        $this->mailer->CharSet = PHPMailer::CHARSET_UTF8;
    }

    public function isValidAddress(string $address): bool
    {
        return $this->mailer->validateAddress($address);
    }

    public function setTo(string $to): void
    {
        // TODO: split $to in $address and $name?
        // TODO: reset if called multiple times?
        $this->mailer->addAddress($to);
    }

    public function getSubject(): string
    {
        return $this->mailer->encodeHeader($this->mailer->secureHeader($this->mailer->Subject));
    }

    public function setSubject(string $subject): void
    {
        $this->mailer->Subject = $subject;
    }

    public function setMessage(string $message): void
    {
        // TODO: force base64 encoding?
        $this->mailer->Body = $message;
    }

    public function addHeader(string $name, string $value): void
    {
        // TODO: allow more headers?
        assert(in_array(strtolower($name), ["from", "cc", "bcc", "reply-to"]));
        // TODO: split $value in $address and $name?
        switch (strtolower($name)) {
            case "from":
                $this->mailer->setFrom($value);
                break;
            case "cc":
                $this->mailer->addCC($value);
                break;
            case "bcc":
                $this->mailer->addBCC($value);
                break;
            case "reply-to":
                $this->mailer->addReplyTo($value);
                break;
        }
    }

    public function send(): bool
    {
        return $this->mailer->send();
    }
}
