# OFF-01 – Whiteboard-Einzelabgleich, Bilder 1–5
Stand: 15.11.2026. Historische Inhalte werden nicht automatisch als aktuelle Beschlüsse übernommen. Keine Originaldokumente geändert.

## 1 – DFF42987-4F93-43FD-A8BE-51E646391657.JPG
**Thema:** Lizenzzustände.
**Sichtbar:** `PENDING_ACTIVISION` (Schreibweise auf Tafel), `TRIAL`, `SCHEDULED`, `ACTIVE`, `EXPIRED`. PENDING: Lizenz bestellt, Zahlung noch nicht erfolgreich, kein Lizenzzugriff. TRIAL: Testphase, Zugriff frei. SCHEDULED: kostenpflichtige Lizenz bereits erfolgreich bezahlt, Aktivierung liegt in Zukunft, bisherige Lizenz/Trial läuft weiter. ACTIVE: bezahlte Lizenz gültig. EXPIRED: Laufzeit abgelaufen, Claninhalte bleiben bestehen, Zugriff nur nach gültiger Lizenz; Reaktivierung durch erneuten Kauf möglich. Explizit: PENDING ≠ SCHEDULED.
**Dokumentabgleich:** Pflichtenheft v1.0 LICENCE-007, 008, 009, 026–033 und ältere Lizenzabschnitte decken Teilaspekte ab. Vollständiger Lifecycle und Abgrenzung `SCHEDULED`/`PENDING_ACTIVATION` nicht konsistent als Zustandsautomat spezifiziert.
**Befund:** TEILWEISE / MODELLIERUNGSBEDARF. Historische Schreibweise und Bedeutung vor Übernahme normalisieren; keine bestehende spätere Zahlungsregel überschreiben.

## 2 – IMG_4371.HEIC
**Thema:** Teamleiter-Kompetenzen, Rollen, Permission-Delegation, Audits.
**Sichtbar:** Teamlogo-/Teammitglied-/Teammitglied-Entfernungs- und Warplanner-/Member-Requests mit Approval an Clanadmin; Clanleader darf Rechte untergeordneter Rollen ändern, aber Subleader-Rechte nicht beliebig weiterreichen. Rollenhierarchie Supportadmin → Admin → Subadmin → Moderator → Clanmitglied (Teamleiter als Funktion separat zu prüfen). Ein Titel pro Benutzer. Sicherheitskritische Änderungen, Finanzen und Delegation auditieren. Teamleiter-Scopes und Adminaktionen werden beispielhaft genannt.
**Dokumentabgleich:** Pflichtenheft v1.0 §§4,6 und REQUIREMENTS §§4,6 übernehmen Grundsätze (Delegation, Scope, Titel, Teamleiter, Audit). Konkrete Permission-Liste, Antrags-/Freigabepfade und Rollenhierarchie nicht abschließend als Matrix umgesetzt.
**Befund:** TEILWEISE; OFF-02. Unleserliche Einzelbegriffe nicht als feststehende Permission-Codes behandeln.

## 3 – IMG_4372.HEIC
**Thema:** Content, Forum, Chat.
**Sichtbar:** Content intern: Create, Update, Read, Publish. Content extern: Create, Update, Delete, Submit, Approve, Reject, Publish; Adminfreigabe/Publish-Policy. Forum: interne, externe und Team-Bereiche; Thread/Post-Erstellung und -Bearbeitung, Moderation, Trash/Restore, Löschung, Filter-/Approval-/Upload-Policy; Publish-Modi Immediate, Delayed, Approval Required. Chat: private 1:1-, Gruppen-, Team-, Support- und Public-Chats; Send, Edit Own, Delete Own, Moderate, Mute, Policy/Spam, Upload-/Größenregeln; Teamscope.
**Dokumentabgleich:** Pflichtenheft v1.0 §7 und REQUIREMENTS §7 erfassen die meisten Funktionsgruppen und den Freigabeprozess. Einzelberechtigungen, Moderations-/Löschrechte und Scopes sind nicht als abnahmefähige Matrix festgelegt.
**Befund:** TEILWEISE; OFF-02/09.

## 4 – IMG_4373.HEIC
**Thema:** Clankasse, Spenden, Ledger, Zahlungsstatus.
**Sichtbar:** Bankdaten IBAN/BIC/Name, Member Contributions, Donations, Payment Providers, Receipts, Balance/Reconciliations. Ledger mit Income/Expense, Category, Timestamp, Member/Payer, Payment Reference. Donate → Betrag/Verwendungszweck → Provider → Pending → Cancelled/Failed/Confirmed → Ledger Entry. Warnung: Zahlungsbestätigung nicht allein vertrauen, serverseitig verifizieren. Beiträge mit Kategorie dürfen nicht automatisch als Donation gezählt werden. Finance-Permissions für Balance, Transaktionen, Kategorien, Belege, Bankkonto, Auszahlung.
**Dokumentabgleich:** Pflichtenheft v1.0 §8 und REQUIREMENTS §8 decken Grundmodelle und Verifizierung ab. Explizite Spenden-vs.-Beiträge-Kategorisierung und feingranulare Permission-Matrix fehlen oder sind nicht ausreichend präzise.
**Befund:** TEILWEISE; Ergänzungskandidat.

## 5 – IMG_4374.HEIC
**Thema:** PDF-Zahlungsbestätigung, Finanz-Audit und Retention.
**Sichtbar:** PDF-Felder Clanname, Zahler, Datum/Uhrzeit, Betrag, Transaktions-ID, Empfänger, Kategorie, Zahlungsstatus. Jede Transaktion hat eigenes Audit; bei falschem Betrag Korrektur statt stiller Änderung, mit Originalwert, Neuwert, Akteur, Zeitstempel und Begründung. Bestätigte Transaktionen nicht hart löschen, sondern Korrektur/Reversal; Retention Policy für Dokumenttypen.
**Dokumentabgleich:** Pflichtenheft v1.0 §8 und §11, REQUIREMENTS §8 enthalten PDF-Belege, unveränderliche bestätigte Buchungen und Korrekturaudit. Exaktes PDF-Feldschema, konkrete Aufbewahrungsfristen und Audit-Schema bleiben zu spezifizieren (OFF-06).
**Befund:** TEILWEISE; Ergänzungskandidat.

## Vorgehen
Für jeden weiteren Bildbeleg: Originalwortlaut soweit lesbar → aktuelle Dokumentfundstelle → neuere bestätigte Entscheidung → Befund → mögliche Ergänzung. Bei Konflikten keine automatische Überschreibung. OFF-01 bleibt offen, bis 50/50 Bilder bearbeitet sind.
