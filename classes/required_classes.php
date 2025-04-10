<?php

/**
 * Copyright (c) Christoph M. Becker
 *
 * This file is part of Phpmailer_XH.
 *
 * Phpmailer_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Phpmailer_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Phpmailer_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function phpmailer_create(): PHPMailer
{
    global $plugin_cf;
    $pcf = $plugin_cf["phpmailer"];
    $mailer = new PHPMailer();
    if ($pcf["smtp_enabled"]) {
        $mailer->isSMTP();
        $mailer->Host = $pcf["smtp_host"];
        $mailer->Port = (int) $pcf["smtp_port"];
        if ($pcf["smtp_tls"]) {
            $mailer->SMTPSecure = constant(PHPMailer::class . "::ENCRYPTION_" . $pcf["smtp_tls"]);
        }
        if ($pcf["smtp_username"]) {
            $mailer->SMTPAuth = true;
            $mailer->Username = $pcf["smtp_username"];
            $mailer->Password = $pcf["smtp_password"];
        }
        if (defined("XH_ADM") && XH_ADM && $pcf['smtp_debug']) {
            $mailer->SMTPDebug = SMTP::DEBUG_CONNECTION;
            $mailer->Debugoutput = function (string $str, int $level): void {
                global $plugin_tx, $e;
                $kind = $plugin_tx["phpmailer"]["debug_level_$level"];
                $e .= "<li><b>PHPMailer $kind:</b><br>" . XH_hsc(rtrim($str)) . "</li>\n";
            };
        }
    }
    return $mailer;
}
