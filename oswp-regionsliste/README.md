# oswp-regionsliste

Das Plugin ist Konfigurierbar und listet alle Regionen des OpenSimualtors auf.

Die Optik passt sich eurem Theme an.

Translation wurde hinzugefügt.

### Installation

Entpacken und das Verzeichnis oswp-regionsliste in euer /wp-content/plugins kopieren.

Das Plugin im Plugins Bereich von Wordpress Aktivieren.

Jetzt im Theme Bereich Widgets das widget dort hineinschieben wo ihr es hin haben wollt.

Anschließend noch die MySQL Server Daten, die Adresse des Server z.B. opensim.com 

sowie den Port Normal 8002 eures OpenSim eintragen und speichern anklicken.

Jetzt habt ihr alle eure Daten dort stehen wo ihr das Widget hineingeschoben habt.

Durch verschieben des Widget ändert ihr die Anzeigeposition.

### Install
Die Plugin stellen ein Widget zur verfügung.

Nach dem Aktivieren im Theme bereich Widget, die Robust Datenbank eintragen.

The plugin provide a widget.

After enabling in the Theme widget area, enter the Robust database.

Le plugin fournit un widget.

Après avoir activé la zone de widget Thème, entrez dans la base de données Robust.

### MySQL
Sollte sich die Webseite nicht auf dem gleichen Server befinden wie OpenSim,

muss man in der mysqld.cnf Datei auf dem OpenSim Server folgendes eintragen.

MySQL wird einfach über die Datei mysqld.cnf konfiguriert.

bind-address = Die-IP-des-externen-Wordpress-Server

Beispiele:

bind-address = 127.0.0.1 #Nur der Server auf dem MySQL läuft hat zugriff auf die Datenbanken.

bind-address = 192.168.2.105 #Zugriff nur für den Server 192.168.2.105.

bind-address = 0.0.0.0 #Von allen Externen Rechnern auf MySQL zugreifen lassen (nicht empfohlen gefährlich).

Überprüfen ob MySQL auf dem Server erreichbar ist:

telnet 192.168.2.105 3306

### Lizens

This program is distributed in the hope that it will be useful,

but WITHOUT ANY WARRANTY. without even the implied warranty of

MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the

GNU General Public License 2 for more details.

http://www.gnu.org/licenses/gpl-2.0.html

Dieses Programm wird in der Hoffnung verbreitet, dass es nützlich sein wird,

aber OHNE GARANTIE. ohne auch nur die implizite garantie von

MARKTGÄNGIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK. 

Siehe GNU General Public License 2 für weitere Details.

http://www.gnu.de/documents/gpl-2.0.de.html

### TODO

Translation
