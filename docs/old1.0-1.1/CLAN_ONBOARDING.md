# ClanIntern / Headquarter – Clan-Onboarding

**Stand:** 15.11.2026  
**Status:** Fachliche Teilanforderung bestätigt; weitere Onboarding-Details gesondert zu spezifizieren  
**Dokumenttyp:** Ergänzende Fachspezifikation für das Dokumentenverzeichnis

## 1. Zweck und Abgrenzung

Dieses Dokument hält die bestätigte Regel zur Wiederaufnahme des Clan-Einrichtungsassistenten fest. Es ergänzt die bestehenden Projektunterlagen und ersetzt weder Pflichtenheft noch Requirements, Architekturentscheidungen oder Sicherheitsrichtlinien.

Die Clan-Gründung erfolgt nur durch einen dafür berechtigten Account im vorgesehenen Leader-/Plattformverwaltungskontext. Authentifizierung allein gewährt kein Gründungsrecht. Ein Clan wird erst nach erfolgreichem Abschluss des Einrichtungsassistenten angelegt.

## 2. CLAN-ONBOARDING-003 – Sitzungserhalt bei Verbindungsabbruch

**Status:** Fachlich bestätigt am 15.11.2026

1. **Temporärer Verbindungsabbruch:** Der Einrichtungsassistent bewahrt den bisherigen Bearbeitungsstand einschließlich bereits erfasster Eingaben für eine Unterbrechung von bis zu 30 Minuten auf.
2. **Fristbeginn:** Die 30-Minuten-Frist beginnt mit dem tatsächlichen Verbindungsabbruch, nicht bereits mit dem letzten Eingabezeitpunkt.
3. **Rechtzeitige Wiederverbindung:** Gelingt die Wiederverbindung innerhalb der Frist und ist die Authentifizierung weiterhin gültig, wird der Assistent mit dem zuletzt erreichten Schritt und den bisherigen Eingaben fortgesetzt.
4. **Zurücksetzen der Frist:** Bei erfolgreicher Wiederverbindung wird die Unterbrechungsfrist zurückgesetzt. Bei einem späteren erneuten Abbruch beginnt eine neue 30-Minuten-Frist.
5. **Unterbrechung über 30 Minuten:** Dauert die Unterbrechung länger als 30 Minuten, wird der temporäre Bearbeitungsstand verworfen. Bei der nächsten Nutzung beginnt der Assistent von vorn.
6. **Bewusste Abmeldung:** Bei ausdrücklichem Logout wird der unvollständige Bearbeitungsstand sofort verworfen; die Wiederaufnahmefrist greift nicht.
7. **Sicherheitsvorrang:** Ein Verbindungsabbruch ist keine bewusste Abmeldung. Die Wiederaufnahme setzt jedoch eine gültige und berechtigte Sitzung voraus und darf keine abgelaufene oder widerrufene Authentifizierung umgehen.

### Abgrenzung zur allgemeinen Sitzungsrichtlinie

Die vorhandene Sicherheitsregel `SESSION_IDLE_TIMEOUT_MINUTES = 60` bleibt unverändert. Sie regelt die allgemeine Sitzungsinaktivität; die **30 Minuten** sind ausschließlich das Wiederaufnahmefenster für den Einrichtungsassistenten nach einem Verbindungsabbruch. Eine abgelaufene oder widerrufene Sitzung wird durch die Onboarding-Regel nicht wieder gültig.

## 3. Technische Umsetzungsvorgaben

- Der wiederherstellbare Zwischenstand muss **serverseitig** gesichert sein und darf nicht ausschließlich im flüchtigen Blazor-Interactive-Server-Circuit liegen.
- Zwischendaten sind an den berechtigten Account beziehungsweise den konkreten Einrichtungsvorgang zu binden; fremde Accounts dürfen darauf nicht zugreifen.
- Die Zeitmessung muss serverseitig erfolgen. Wiederverbindung, Fristablauf und Logout dürfen keine konkurrierenden oder widersprüchlichen Zustandsübergänge erzeugen.
- Nicht abgeschlossene Entwürfe dürfen nicht als fertig gegründete Clans behandelt werden.
- Datenschutz, Zugriffsschutz und die bestehende Security-Baseline gelten auch für temporär gespeicherte Eingaben.

**Implementierungsdetails noch offen:** Das konkrete Persistenzschema, der Mechanismus zur Feststellung des Verbindungsabbruchs sowie die genaue Behandlung nicht eindeutig erkennbarer Verbindungszustände sind vor der Implementierung technisch festzulegen. Diese offenen Punkte ändern die bestätigte fachliche 30-Minuten-Regel nicht.

## 4. Abnahmekriterien

| ID | Szenario | Erwartetes Ergebnis |
|---|---|---|
| ONB-AC-01 | Verbindungsabbruch, Wiederverbindung nach 10 Minuten bei gültiger Sitzung | Letzter Schritt und Eingaben bleiben erhalten. |
| ONB-AC-02 | Wiederverbindung innerhalb von 30 Minuten, danach erneuter Abbruch | Neue 30-Minuten-Frist beginnt mit dem erneuten Abbruch. |
| ONB-AC-03 | Unterbrechung länger als 30 Minuten | Zwischenstand verworfen; Assistent startet neu. |
| ONB-AC-04 | Bewusster Logout während der Einrichtung | Zwischenstand sofort verworfen. |
| ONB-AC-05 | Authentifizierung während Unterbrechung abgelaufen oder widerrufen | Keine unberechtigte Wiederaufnahme. |
| ONB-AC-06 | Abbruch vor endgültigem Abschluss | Kein vollständig gegründeter Clan wird erzeugt. |
| ONB-AC-07 | Blazor-Circuit wird neu aufgebaut, Wiederverbindung innerhalb der Frist | Servergesicherter Zwischenstand ist wiederherstellbar. |

## 5. Einordnung in die Projektunterlagen

- **REQUIREMENTS.md / Pflichtenheft:** Fachregel `CLAN-ONBOARDING-003` bei der nächsten ausdrücklich freigegebenen Konsolidierung referenzieren.
- **ARCHITECTURE.md / DECISIONS.md:** Serverpersistenz und Wiederverbindung mit Blazor Interactive Server bei technischer Ausgestaltung berücksichtigen.
- **MILESTONES.md:** Implementierung und Tests dem Clan-Onboarding (M6) zuordnen; keine bereits erfolgte Umsetzung behaupten.
- **Bestehende Dokumente:** Durch die Erstellung dieser eigenständigen Datei unverändert.

## 6. Geltungsgrenze

Diese Datei dokumentiert den im vorliegenden Gespräch **bestätigten Teil** des Clan-Onboardings. Aus der Kennung `CLAN-ONBOARDING-003` wird nicht abgeleitet, dass der genaue Wortlaut von `CLAN-ONBOARDING-001` und `CLAN-ONBOARDING-002` vorliegt. Fehlende Regeln oder Schritte werden nicht erfunden.
