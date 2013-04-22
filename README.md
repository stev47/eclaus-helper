eClaus - Helper
===============

eClaus-Helper ist ein Webinterface, um die Korrekturen von Abgaben aus dem eClaus zu vereinfachen. In erster Linie bedeutet es: kein lästiges umhernavigieren in der Ordnerstruktur aus dem Korrekturarchiv.
Es kann außerdem gut eingesetzt werden, um Abgaben zu präsentieren.

Getting started
---------------

1. Funktionierender Webserver (lokal ist empfehlenswert) mit PHP bereitstellen.
2. "Korrekturarchiv herunterladen", dabei beide Optionen für die Ordnerstruktur aktivieren.
3. `./extract.sh EClausAbgaben-xxx.zip`
4. `index.php` im Browser öffnen.

Beschreibung
------------

`extract.sh` extrahiert das Korrekturarchiv im Unterordner `data`. Zusätzlich werden alle enthaltenen zip-Files rekursiv ohne ihre Ordnerstruktur entpackt (wegen lästigen Abgaben, die tausend Verschachtelungen aufgrund des Package-Namens haben).

Im Webinterface kann zwischen den vorhandenen Kursen/Übungsgruppen/Aufgabenblättern/Aufgaben/Teilaufgaben in der Navigation oben gewechselt werden, die Gruppen werden links gewählt und die Dateien in den Reitern oben unter der Navigation.

Quellcode- und Bild-Dateien können direkt im Webinterfae angeschaut werden, zu allen anderen Dateien wird ein Download-Link angeboten.

Java-Programme testen
---------------------

Das Ausführen von Java-Programmen vereinfacht sich durch das Fehlen der Package-Ordnerstruktur.
Navigiere in das `uploads`-Verzeichnis der jeweiligen Abgabe und führe aus:

    javac -d . *.java

Anschließend kann das Programm z.B. über

    java my.package.hierarchy.Test

ausgeführt werden.
