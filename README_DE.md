# Phpmailer_XH

Phpmailer_XH stellt [PHPMailer](https://github.com/PHPMailer/PHPMailer),
eine vollwertige E-Mail-Erstellungs und -Transfer-Komponente für PHP,
für einfache und reibungslose Verwendung durch andere CMSimple_XH Plugins
bereit.

## Inhaltsverzeichnis

- [Voraussetzungen](#voraussetzungen)
- [Download](#download)
- [Installation](#installation)
- [Einstellungen](#einstellungen)
- [Verwendung](#verwendung)
  -  [SMTP](#smtp)
  - [Für Entwickler](#für-entwickler)
- [Fehlerbehebung](#fehlerbehebung)
- [Lizenz](#lizenz)
- [Danksagung](#danksagung)

## Voraussetzungen

Phpmailer_XH ist ein Plugin für [CMSimple_XH](https://www.cmsimple-xh.org/de/).
Es benötigt CMSimple_XH ≥ 1.7.0, und PHP ≥ 7.1.0.

## Download

Das [aktuelle Release](https://github.com/cmb69/phpmailer_xh/releases/latest)
kann von Github herunter geladen werden.

## Installation

Die Installation erfolgt wie bei vielen anderen CMSimple_XH-Plugins
auch.

1. Sichern Sie die Daten auf Ihrem Server.
1. Entpacken Sie die ZIP-Datei auf Ihrem Rechner.
1. Laden Sie das ganze Verzeichnis `phpmailer/` auf Ihren Server in
   das `plugins/` Verzeichnis von CMSimple\_XH hoch.
1. Machen Sie die Unterverzeichnisse `config/` und
   `languages/` beschreibbar.
1. Browsen Sie zu `Plugins` → `Phpmailer` im Administrationsbereich,
   um zu prüfen, ob alle Voraussetzungen erfüllt sind.

## Einstellungen

Die Konfiguration des Plugins erfolgt wie bei vielen anderen
CMSimple_XH-Plugins auch im Administrationsbereich der Website.
Wählen Sie `Plugins` → `Phpmailer`.

Sie können die Original-Einstellungen von Phpmailer_XH unter `Konfiguration`
ändern. Beim Überfahren der Hilfe-Icons mit der Maus werden Hinweise zu
den Einstellungen angezeigt.

Die Lokalisierung wird unter `Sprache` vorgenommen. Sie können die
Zeichenketten in Ihre eigene Sprache übersetzen, falls keine
entsprechende Sprachdatei zur Verfügung steht, oder sie entsprechend
Ihren Anforderungen anpassen.

## Verwendung

Zunächst sollten Sie Ihre E-Mail-Adresse konfigurieren
(`Plugins` → `Phpmailer` → `Konfiguration` -> `Sender` → `Address`).
Die Systemprüfung wird eine Plausibilitätsprüfung der Adresse durchführen.

Dann sollten Sie die Aktivierung von SMTP in Erwägung ziehen;
siehe den folgenden Abschnitt.

### SMTP

Standardmäßig verwendet Phpmailer_XH die `mail()` Funktion von PHP,
die normalerweise nur ein einfacher
[sendmail](https://de.wikipedia.org/wiki/Sendmail) Wrapper ist.
Diese Art E-Mails zu versenden hat einige Einschränkungen,
und wird von einigen Webservern nicht mehr unterstützt.

Daher tun Sie gut daran SMTP-Support in der Konfiguration zu aktivieren.
Es ist wichtig alle relevanten Konfigurationeinstellungen sorgfältig
einzutragen; erfragen Sie die nötigen Information von Ihrem Mail-Provider.
Erfordert der SMTP-Server Authentifizierung (recht wahrscheinlich),
müssen Sie den Benutzernamen und das Passwort in der Konfiguration eintragen.
Beachten Sie, dass diese Anmeldedaten notwendigerweise im Klartext in
`plugins/phpmailer/config/config.php` gespeichert werden.
Daher ist es wichtig, dass der Konfigurationsorder von Phpmailer_XH vor
direktem Zugriff geschützt ist. Das Plugin liefert eine entsprechende `.htaccess`
aus, aber diese wird u.U. nicht von Ihrem Server erkannt, so dass Sie selbst
alternative Maßnahmen ergreifen müssen. Bevor sie die sensiblen Anmeldedaten
in die Konfiguration eintragen, überprüfen Sie, ob die System-Prüfung bezüglich
des Zugriffschutzes von `config.php` erfolgreich ist.

Haben Sie Schwierigkeiten mit der SMTP Konfiguration,
d.h. ein Plugin, das Phpmailer_XH verwendet, kann keine E-Mails versenden,
können Sie die `SMTP` → `Debug` Konfigurationsoption aktivieren.
Sind Sie als Administrator angemeldet, wird ein detailliertes Protokoll
der Kommunikation mit dem SMTP Server angezeig, wenn eine E-Mail versandt wird
(beachten Sie, dass diese Debugausgabe sensible Information enthalten kann;
daher wird sie niemals Besuchern Ihrer Website angezeigt).
Die Debugausgabe genügt vielleicht schon, damit Sie das Problem selbst
beheben können; andernfalls siehe [Fehlerbehebung](#fehlerbehebung).

### Für Entwickler

Andere Plugins können PHPMailer genau wie zuvor verwenden; sie müssen
lediglich ihre eigenen `require` oder `include` Anweisungen entfernen,
die `PHPMailer` und möglicherweise einige andere Hilfsklassen (wie `SMTP`)
einbinden, da die benötigten Klassen von CMSimple_XH automatisch geladen werden.

Für Plugins, die `XH\Mail` verwenden, gibt es ein Shim: `PHPMailer\Mail`,
das grob wie zuvor funktioniert, aber unter der Haube PHPMailer verwendet.

Allerdings ignorieren beide Varianten die Konfiguration von Phpmailer_XH;
diese müsste manual angewendet werden.
Der bequeme Weg die Phpmailer_XH Konfiguration zu verwenden,
ist ein `PHPMailer` Exemplar durch Aufruf von

    phpmailer_create()

zu erzeugen. Die Funktion gibt einen vorkonfigurierten `PHPMailer` zurück,
der dann nahezu (siehe weiter unten) wie zuvor verwendet werden kann,
beispielsweise:

    $mail = phpmailer_create();
    $mail->addAddress("joe@example.com");
    $mail->Subject = "Hey Joe!";
    $mail->Body = "wohin gehst du mit dieser Pistole in deiner Hand?";
    $mail->send();

Um die Phpmailer_XH Konfiguration auf `PHPMailer\Mail` anzuwenden:

    $mail = new PHPMailer\Mail(phpmailer_create());

Beachten Sie, dass sie keine der `PHPMailer` Methoden aufrufen dürfen,
die die Versandmethode ändern (d.h.  `::isSMTP()`, `::isMail()` und `::isSendmail()`),
da dies die Phpmailer_XH Konfiguration übersteuern würde.
Das gilt ebenso für alle SMTP Konfigurationsänderungen am
`PHPMailer` Exemplar.

Beachten Sie weiterhin, dass Sie die Sender/From Adresse durch den
Aufruf von `::setFrom()` nicht ändern dürfen, da diese bereits vorkonfiguriert ist.
Rufen Sie statt dessen `::addReplyTo()` auf, um die gewünschte Adresse zu setzen.

Es ist ebenfalls nicht mehr nötig `::setLanguage()` aufzurufen,
da dies bereits von `phpmailer_create()` getan wurde.

Wollen Sie prüfen, ob Phpmailer_XH installiert ist, dann prüfen Sie

    function_exists("phpmailer_create")

Wollen Sie die Version des PHPMailer erfahren, können Sie etwa das folgende tun:

    if (!class_exists(PHPMailer\PHPMailer\PHPMailer::class)) {
        return null;
    }
    return PHPMailer\PHPMailer\PHPMailer::VERSION;

## Fehlerbehebung

Melden Sie Programmfehler und stellen Sie Supportanfragen entweder auf
[Github](https://github.com/cmb69/phpmailer_xh/issues)
oder im [CMSimple\_XH Forum](https://cmsimpleforum.com/).

## Lizenz

Phpmailer_XH ist freie Software. Sie können es unter den Bedingungen der
GNU General Public License, wie von der Free Software Foundation
veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß
Version 3 der Lizenz oder (nach Ihrer Option) jeder späteren Version.

Die Veröffentlichung von Phpmailer_XH erfolgt in der Hoffnung, daß es Ihnen
von Nutzen sein wird, aber *ohne irgendeine Garantie*, sogar ohne die
implizite Garantie der *Marktreife* oder der *Verwendbarkeit für einen
bestimmten Zweck*. Details finden Sie in der GNU General Public License.

Sie sollten ein Exemplar der GNU General Public License zusammen mit
Phpmailer_XH erhalten haben. Falls nicht, siehe <https://www.gnu.org/licenses/>.

Copyright © Christoph M. Becker

## Danksagung

Das Plugin wurde von *olape* inspiriert, der die CMSimple_XH Gemeinschaft
auf die Notwendigkeit von direktem SMTP Versand von E-Mails aufmerksam
gemacht hat (anstatt einfach die `mail()` Funktion von PHP zu verwenden).

Vielen Dank an alle Maintainer von PHPMailer für die Bereitstellung
dieser einfachen und großartigen E-Mail Lösung über all die Jahre.

Das Plugin Logo stammt von
[Email icons created by Freepik - Flaticon](https://www.flaticon.com/free-icons/email).
Vielen Dank für die freie Verfügbarkeit dieses Icons.

Vielen Dank an die Gemeinde im [CMSimple_XH Forum](https://www.cmsimpleforum.com/)
für Hinweise, Vorschläge und das Testen.

Und zu guter letzt vielen Dank an [Peter Harteg](https://www.harteg.dk/),
den „Vater“ von CMSimple, und alle Entwickler von
[CMSimple\_XH](https://www.cmsimple-xh.org/), ohne die
dieses phantastische CMS nicht existieren würde.
