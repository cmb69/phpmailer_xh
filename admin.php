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

const PHPMAILER_VERSION = "6.9.3.1-dev";

function phpmailer_info(): string
{
    global $pth, $plugin_cf, $plugin_tx, $title;

    $ptx = $plugin_tx["phpmailer"];
    $title = "Phpmailer " . XH_hsc(PHPMAILER_VERSION);
    $o = "<h1>$title</h1>\n";
    $phpVersion = "7.1.0";
    $type = version_compare(PHP_VERSION, $phpVersion) >= 0 ? "success" : "fail";
    $o .= XH_message($type, $ptx["syscheck_phpversion"], $phpVersion) . "\n";
    $xhVersion = "1.7.0";
    $type = version_compare(CMSIMPLE_XH_VERSION, "CMSimple_XH $xhVersion") >= 0 ? "success" : "fail";
    $o .= XH_message($type, $ptx["syscheck_xhversion"], $xhVersion) . "\n";
    foreach (["config", "languages"] as $folder) {
        $folder = $pth["folder"]["plugins"] . "phpmailer/$folder";
        $type = is_writable($folder) ? "success" : "warning";
        $o .= XH_message($type, $ptx["syscheck_writable"], $folder) . "\n";
    }
    $file = $pth["folder"]["plugins"] . "phpmailer/config/config.php";
    $type = XH_isAccessProtected($file) ? "success" : "warning";
    $o .= XH_message($type, $ptx["syscheck_access_protection"], $file) . "\n";
    $type = PHPMailer::validateAddress($plugin_cf["phpmailer"]["sender_address"]) ? "success" : "warning";
    $o .= XH_message($type, $ptx["syscheck_sender"]) . "\n";
    return $o;
}

if (!defined("CMSIMPLE_XH_VERSION")) {
    http_response_code(403);
    exit;
}

XH_registerStandardPluginMenuItems(false);
if (XH_wantsPluginAdministration("phpmailer")) {
    $o .= print_plugin_admin("off");
    switch ($admin) {
        case "":
            $o .= phpmailer_info();
            break;
        default:
            $o .= plugin_admin_common();
    }
}
