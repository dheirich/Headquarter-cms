# CLAN_ONBOARDING.md – konsolidierte Arbeitsfassung v1.2

**Stand: 16.11.2026 · Status: fachlich beschlossene Ergänzungen, technische Detailfreigabe teilweise offen.**

## Konsolidierungsbeschlüsse vom 16.11.2026 (Zielstand v1.2)

**Vorrang:** Die folgenden ausdrücklich bestätigten Beschlüsse ersetzen widersprechende ältere Entwurfsstellen. Ältere Versionsangaben im übernommenen Quelltext sind historisch und nicht der Versionskopf dieser Datei. Diese Fassung beschreibt **Soll-Anforderungen**, keine implementierten Funktionen.

- **Serverintegration (OFF-10):** Verbindlich sind lesende Statusinformationen, Spieler-/Benutzerlisten, Channels und Join-Links, soweit externe APIs dies erlauben. Neustart, Shutdown, Backup und sonstige Remote-Administration sind **nicht** Bestandteil von v1.2; als späteres Erweiterungsvorhaben dokumentieren.
- **Aufnahme:** Neue Clanmitgliedschaften benötigen die nicht abschaltbare Freigabe des Clanleaders. Eine vom Clanleader persönlich versandte Einladung gilt bereits als Freigabe; Annahme und serverseitige Lizenz-/Slot-/Sicherheitsprüfung bleiben Pflicht. Berechtigte andere Rollen dürfen Einladungen anstoßen, aber nicht abschließend genehmigen. Kein Self-Join.
- **Permission-Matrix:** Die vollständige Liste aus den Whiteboard-Einzelprotokollen ist als verbindlicher Spezifikationsumfang festgelegt, einschließlich individueller Permission-Codes, Scope (Plattform/Clan/Team/eigene Daten), delegierbarer Rollen, Step-up und Audit. Die **Einzelmatrix ist noch nicht vollständig in dieser Fassung ausformuliert**; keine pauschale Freigabe oder Implementierungsreife daraus ableiten.
- **Clan-Onboarding:** Bei Verbindungsabbruch kann ein noch nicht abgeschlossener Gründungsentwurf innerhalb von **30 Minuten** sicher wiederaufgenommen werden. Erneuter Abbruch startet eine neue Frist; expliziter Logout verwirft den Entwurf. Diese Frist ist unabhängig vom allgemeinen Session-Idle-Timeout (historischer Default 60 Minuten).
- **Sieben Lizenzkorrekturen:** `LICENCE-038–041` und `LICENCE-054–056` gelten fachlich als bestätigt. Der ausformulierte Wortlaut steht in der beigefügten `Pflichtenheft_v1.2.md` (aus der Korrekturfassung übernommen); andere Dokumente verweisen darauf, statt die Regeln zu verkürzen.
- **Trial:** Sieben Tage bleiben vollständig erhalten, auch bei vorheriger Bezahlung. Die bezahlte Periode beginnt erst nach Trial-Ende (`SCHEDULED` bis dahin).
- **Slots:** STANDARD und TRIAL höchstens 25 aktive Clanmitgliedschaften; UNLIMITED ohne Limit. Bei Downgrade gilt die 30-tägige Schonfrist erst ab tatsächlichem STANDARD-Wechsel. Einladungen trotz voller Slots möglich, Aktivierung nur unter 25 oder nach wirksamer UNLIMITED-Freischaltung. `PAYMENT_OVERDUE_LOCKED` ist eine eigenständige strengere Sperre.
- **Einladungen:** Ablauf 7/14/30 Kalendertage (Default 14), nur für neue Einladungen geänderte Policy; Resend-Default 24 Stunden und höchstens drei Wiederholungen zusätzlich zum Erstversand, ohne Verlängerung des ursprünglichen Ablaufs. Sichere konfigurierbare Grenzwerte sind noch zu definieren.
- **Wiederbeitritt:** `ALLOWED`, `APPROVAL_REQUIRED` (Default: Clanleader) oder `BLOCKED`; frühere Rollen/Rechte werden nicht automatisch wiederhergestellt.
- **Forum:** Sichtbarkeit von Kategorien und Beiträgen durch Clanleader oder ausdrücklich delegierten Subleader; Audit und sofortige Benachrichtigung betroffener Rollen. Teamleader sehen standardmäßig nur eigene Teambereiche.
- **Delegation:** Subleader dürfen delegierte Rechte nicht weiterdelegieren; Rechte können unbefristet oder befristet sein, sofort widerrufen werden, 24-Stunden-Vorwarnung vor Ablauf und Ablaufbenachrichtigung; serverseitige Neubewertung vor Abschluss kritischer Aktionen.
- **Inaktivität:** `DISABLED`, `WARN_ONLY` (Default) oder `AUTO_LOCK` mit vorheriger Warnung. Konkrete Fristen und Entsperrprozess bleiben offen.

**Restpunkte für technische Abnahme:** Vollständige Permission-/Scope-Matrix aus den Bildprotokollen, Lizenz-Zustands-/Aktionsmatrix einschließlich aller sieben Korrekturtexte in Tests, konfigurierbare Grenzen, Datenaufbewahrung, Inaktivitätsdetails, Abnahmefälle und fehlende historische Quellen. Die 50 Bilder wurden in Einzelprotokollen behandelt; dies ersetzt keine regelweise Freigabe aller Implementierungsdetails.

---

## Übernommener Ausgangsstand (historische Metadaten beachten)

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

---

## v1.2 – verbindliche Fortschreibung vom 16.11.2026


### Verbindliche Konsolidierungsregeln (Beschlussstand 16.11.2026)

- **Status:** Die folgenden Punkte sind **beschlossene Zielanforderungen**, keine Implementierungsnachweise. Ein abgeschlossenes Alpha 0.1 ist nicht belegt.
- **Autorisierung:** Jede geschützte Aktion prüft serverseitig Account, aktuelle Mitgliedschaft, Rolle, Permission, Scope, Policy und Lizenz. Widerrufe wirken sofort, auch bei offenen Dashboards; Exporte und Downloads erfordern dieselbe Autorisierung. Teamleader ist eine teambezogene Funktion, keine eigenständige organisatorische Rolle. Genau ein Clanleader; Subleader dürfen delegierte Rechte nicht weiterdelegieren.
- **Aufnahme:** Nur Clanleader erteilt die finale Mitgliedsfreigabe. Direkt vom Leader initiierte Einladungen gelten als vorab freigegeben, bleiben aber an Sicherheits- und Slotprüfung gebunden. Einladung 7/14/30 Tage (Standard 14), höchstens drei Resends, Cooldown 12/24/48/72 Stunden (Standard 24), ohne Fristverlängerung. Wiederbeitritt ALLOWED/APPROVAL_REQUIRED (Standard)/BLOCKED, ohne automatische Rollenrückgabe.
- **Inaktivität:** DISABLED/WARN_ONLY (Standard)/AUTO_LOCK, Schwelle Standard 90 Tage und 30–365 konfigurierbar, Vorwarnung Standard 10 Tage. Nur echte Benutzeraktivität zählt. Gesperrte Mitglieder bleiben ACTIVE und belegen einen Slot. Entsperrantrag im eingeschränkten Dashboard, genau einer offen, 24 Stunden Cooldown; Freigabe Leader oder delegierter Subleader, Audit und neue Aktivitätsfrist.
- **Sicherheit:** Privilegierte Rollen und Teamleader MFA-pflichtig, normale Mitglieder optional oder per Clanregel verpflichtend; TOTP plus Einmal-Recovery-Codes, SMS nicht allein. Maximal eine aktive Session; Step-up für kritische Aktionen. 5 fehlgeschlagene Logins in 15 Minuten führen zu 30 Minuten Sperre; 3 fehlgeschlagene Resetversuche in 15 Minuten zu 15 Minuten Cooldown. Reset als gesicherter Selfservice ohne pauschale Leader-Freigabe; risikobasierte Geräte-/Standort-Challenges; obligatorische Sicherheitswarnungen. Passwörter, MFA-Secrets und Zahlungsgeheimnisse niemals in Audits speichern.
- **Lizenz:** 7 Tage Trial einmal je Account; STANDARD/TRIAL 25 ACTIVE-Mitglieder einschließlich Leader; UNLIMITED unbegrenzt. Bezahlte Laufzeiten 30/90/180/360 Tage, nur nach serverseitig verifizierter Zahlung. Kauf während Trial wird SCHEDULED und startet nach Trialende; Renewal nach aktueller Paid-Periode. STANDARD→UNLIMITED hebt Slotlimit unmittelbar auf ohne Verlängerung des bisherigen Ablaufs. UNLIMITED→STANDARD erst zum Periodenende; bei >25 Mitgliedern 30 Tage Schonfrist, danach SLOT_LIMIT_LOCKED; keine automatische Löschung. SLOT_LIMIT_LOCKED lässt Einladungen und Annahmen zu, blockiert Aktivierung; PAYMENT_OVERDUE_LOCKED blockiert neue Einladungen und Aktivierungen. EXPIRED ermöglicht Account-/Zahlungs-/Support-/Exportfunktionen, sperrt Clanaktionen. Lizenzperioden getrennt speichern, Providerereignisse idempotent, parallele Slotbelegung transaktional absichern.
- **Onboarding:** Clangründung nur nach verifizierter Lizenz. 30 Minuten serverseitig gesicherte Wiederaufnahme nach Verbindungsabbruch, bei neuem Abbruch neuer Fristbeginn, expliziter Logout verwirft Entwurf; Session-Idle separat 60 Minuten. Ein unvollständiger Entwurf ist kein gegründeter Clan.
- **Clan-Sichtbarkeit:** PUBLIC/INTERNAL/HIDDEN pro Feld; allgemeine Stammdaten standardmäßig PUBLIC, Member-/Team-/Serverlisten INTERNAL, Kontakt-E-Mail HIDDEN; persönliche Privatsphäre hat Vorrang. Zehn separate Clan-Settings-Update-Permissions; sensible Änderungen mit Step-up/Audit, Theme-Änderung mit Audit ohne Step-up; Links und Kontakt separat autorisieren.
- **Content/Kommunikation:** Erstellen/Veröffentlichen trennen; Freigabe/Ablehnung von News begründen; optional Vier-Augen-Freigabe für sensible Publikationen. Forum- und Chat-Scope einschließlich Teamgrenzen serverseitig prüfen; Moderation auditieren, Soft-Delete und Restore. Umfragen mit Start/Ende, Wahlmodus vor Veröffentlichung fixiert und getrennten Create/Publish/Close/Evaluate-Rechten. Sicherheitsbenachrichtigungen verpflichtend, optionale nach Kanal/Kategorie; Zustellung persistent, begrenzte Retries ohne Duplikataktionen, sensible Daten nicht in E-Mail-Vorschauen.
- **Finanzen:** Beiträge, Spenden, sonstige Einnahmen und Ausgaben getrennt; Belegupload bestätigt keine Zahlung. Bestätigte Ledgerbuchungen nur durch Gegenbuchung korrigieren, unzugeordnete Zahlungen manuell prüfen; internes Ledger ist kein verifizierter Bankkontostand. Bankdaten nur Leader/autorisiertem Finanz-Subleader mit Step-up/Audit; separate Berechtigungen für Saldo, Transaktionen, Bestätigung, Belege, Bank und Auszahlung. Auszahlungen über konfigurierbarer Schwelle mit zweiter Freigabe. PDF-Belege mit Clan, Zahler, Empfänger, Betrag, Währung, Zeit, Kategorie, Status und Referenz.
- **Warplanner:** Match DRAFT→PLANNED→CONFIRMED→COMPLETED oder CANCELLED mit validierten Übergängen; RSVP YES/MAYBE/NO und Deadline. Matchdaten umfassen Spiel, Teams, Gegner, Termin/Zeitzone, Organisator. Änderungen nach RSVP-Deadline erfordern Organisatorfreigabe; wesentliche Änderungen werden protokolliert und gemeldet. Historie nach Retention-Policy erhalten.
- **SERVER v1.2:** Nur Status, Spieler, Kanäle, Join; kein Remote-Restart, Shutdown oder Backup. Serververwaltung Leader/delegierter Subleader. Secrets geschützt, keine Klartext-Logs.
- **Datenschutz/Betrieb:** Eigene personenbezogene Daten exportierbar; Leader nur berechtigte Clan-Stammdaten. Löschung berücksichtigt Aufbewahrung, Verpflichtungen, Mitgliedschaft und Leader-Transfer; getrennte Retention für Chat, Forum, Audit, Finanzen, Uploads. Backups dürfen gelöschte Daten nicht unbeabsichtigt wiederherstellen. Malware-Scan und Quoten für Uploads; kritische Jobs mit Retry-Limits und manuellem Prüfpfad; Restore-Tests, Monitoring, Secret-Management, vorgetestete Migrationen und Security-/Permission-/Integrationstests als Produktions-Gates.

**Vollständige Entscheidungsdetails und Ausnahmen:** `ENTSCHEIDUNGSBACKUP_VOLLSTAENDIG.md`. Die vorstehenden Regeln ersetzen ältere widersprechende Aussagen. Historische Abschnitte bleiben als Quellenbestand erhalten; sie sind bei Widerspruch nicht mehr normativ.
