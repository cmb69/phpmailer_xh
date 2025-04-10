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
