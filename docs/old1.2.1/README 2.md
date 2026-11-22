# README.md – konsolidierte Arbeitsfassung v1.2

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

**Dokumentensatz:** `REQUIREMENTS.md`, `DECISIONS.md`, `ARCHITECTURE.md`, `MILESTONES.md`, `Pflichtenheft_v1.2.md`, `CLAN_ONBOARDING.md` und `Entscheidungsprotokoll_v1.2.md`. Versionsnummer v1.2 ist Dokumentationsstand, nicht Software-Release.

---

## Übernommener Ausgangsstand (historische Metadaten beachten)

> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die Originalformulierungen von LICENCE-038 bis 041 und LICENCE-054 bis 056 liegen hier nicht verlässlich vor; sie sind ausdrücklich zur Nachprüfung markiert. Vollständige Freigabe aller 56 Regeln ist deshalb noch ausstehend.

# ClanIntern / Headquarter

**Dokumentversion:** 1.0 · **Stand:** 13.11.2026 · **Status:** In Entwicklung

ClanIntern ist die geplante Full-Stack-.NET-Implementierung von **Headquarter**, einer modularen Plattform zur Verwaltung und Kommunikation von Gaming-Clans. `clanhq.org` bezeichnet den übergeordneten Plattformkontext. Der derzeitige Lieferumfang konzentriert sich auf die technische Grundlage und **Alpha 0.1**.

> **Wichtig:** Zielarchitektur und tatsächlicher Implementierungsstand sind getrennt. Die Entscheidung für .NET 11 und PostgreSQL bedeutet nicht, dass der vorhandene Code bereits migriert wurde.

## Projektziel und Umfang

Geplante fachliche Bereiche: Mitglieder und Teams, Einladungen, Rollen und Berechtigungen, Sicherheitsrichtlinien, Inhalte und Forum, Chat, War-/Matchplanung, Game-/Voice-Server-Statusintegration, Clankasse, Datei- und Medienuploads, Benachrichtigungen, Lizenz-/Slotverwaltung und Audit-Logs.

Plattform-Account, Clanmitgliedschaft, organisatorische Rolle, Permission, Scope, Policy und Lizenz sind unterschiedliche Konzepte. Ein registrierter Plattform-Account besitzt nicht automatisch eine Clanmitgliedschaft oder Verwaltungsrechte. Nach bisherigem Fachstand gehört ein Benutzer höchstens einem Clan an; eine Claninstanz verwaltet genau einen Clan. Ein gemeinsamer Multi-Tenant-Betrieb für mehrere Clans ist nicht beschlossen.

## Beschlossener Zielstack

| Bereich | Ziel |
|---|---|
| Sprache und Laufzeit | C# / .NET 11 |
| Benutzeroberfläche | Blazor Web App, Razor Components, Interactive Server |
| Backend | ASP.NET Core, modularer Monolith |
| Authentifizierung | ASP.NET Core Identity |
| Persistenz | PostgreSQL, Entity Framework Core 11, Npgsql, EF-Core-Migrationen |
| Styling | Tailwind CSS 4 als Ziel; Bootstrap derzeit als Übergang |
| Entwicklungsprozess | Git/GitHub, Tests, Markdown-Dokumentation |
| Infrastruktur | Docker, CI/CD und Hosting noch zu konkretisieren |

Historische Dokumentstände mit .NET 10 / SQL Server oder früheren JavaScript-/C++-Stacks sind keine aktuellen Technologieentscheidungen. Die Migration des Codes, der Pakete, der Connection Strings und der EF-Core-Migrationen ist separat zu prüfen.

## Architektur

Der modulare Monolith umfasst vier bestehende .NET-Projekte:

```text
ClanIntern/
├── src/
│   ├── ClanIntern.Domain/          # Fachliche Modelle, Regeln, Invarianten
│   ├── ClanIntern.Application/     # Anwendungsfälle, Services, Schnittstellen
│   ├── ClanIntern.Infrastructure/  # Persistenz, Identity, Integrationen
│   └── ClanIntern.Web/             # Blazor-UI, Routing, ASP.NET-Core-Einstieg
└── docs/                           # Dokumentation (Pfad im Repository prüfen)
```

Die Darstellung zeigt die beabsichtigte Struktur; die tatsächlichen Pfade sind im Repository zu verifizieren. Fachliche Module sind keine eigenen Microservices oder zwingend eigene .NET-Projekte. Domain bleibt unabhängig; Application verwendet Domain; Infrastructure implementiert technische Schnittstellen; Web bindet die benötigten Dienste ein. Für die interne Kommunikation mit Blazor Interactive Server ist kein separates REST-Backend vorgeschrieben; APIs können für konkrete externe Integrationen ergänzt werden.

## Identität, Dashboard und Berechtigungen

Ein **gemeinsames Dashboard-Shell** wird nach der Anmeldung verwendet. Navigation und Inhalte richten sich nach dem aktiven Plattform- bzw. Clan-Kontext und den jeweils ermittelten Berechtigungen. Es werden nicht für jede Rolle separate, fest verdrahtete Dashboards benötigt. Plattformverwaltung und Clanverwaltung bleiben fachlich getrennt.

Die Ausblendung von UI-Elementen ist keine Sicherheitsmaßnahme: Jede geschützte Aktion muss serverseitig auf Berechtigung, Scope, Mitgliedschaftsstatus, Policy und gegebenenfalls Lizenz geprüft werden. Weitere Grundsätze sind keine Selbstberechtigung, MFA für privilegierte Rollen, Step-up bei kritischen Aktionen, Auditierung und maximal eine aktive Session je Account. ASP.NET Core Identity stellt dafür Grundlagen bereit, setzt jedoch nicht alle projektspezifischen Regeln automatisch um.

## Alpha 0.1 – erstes Lieferziel

Alpha 0.1 soll eine echte, überprüfbare technische Basis liefern:

1. PostgreSQL-Anbindung und EF-Core-Datenmodell/Migrationen für die erforderliche Authentifizierung.
2. ASP.NET Core Identity mit tatsächlichem Login und Logout, nicht nur Formularvalidierung.
3. Geschützte Seiten und serverseitige Zugriffsprüfung.
4. Ein gemeinsames, nach Anmeldung erreichbares **allgemeines Plattform-Dashboard** als Einstieg; clanbezogene Module folgen schrittweise.
5. Tests für gültige/ungültige Anmeldung, Logout und unberechtigten Zugriff.

Der konkrete Umfang zusätzlicher Sicherheitsfunktionen in Alpha 0.1 und ihre Release-Gates wird in `MILESTONES.md` bzw. im Pflichtenheft abgestimmt. Eine Alpha-Demo darf nicht mit einer produktiv vollständig abgesicherten Freigabe verwechselt werden.

## Aktueller Implementierungsstand

Nach bisheriger Durchsicht existieren die vier Projekte, eine grundlegende Blazor-Anwendung, Routing und ein vorbereitetes Loginformular. **Ein produktiver Identity-Login, PostgreSQL-Migration und vollständige Sicherheitsfunktionen sind nicht als umgesetzt nachgewiesen.** Vorhandene ältere Code- und Dokumentstände können noch SQL Server/.NET 10 referenzieren. Der letzte bekannte Loginformular-Stand prüfte lediglich Eingaben.

## Lokale Entwicklung

Voraussetzungen für den **Zielstand**: .NET SDK 11, Git und eine konfigurierte PostgreSQL-Instanz. Ob der bestehende Code bereits mit diesem Stack baut, ist zu prüfen. Beispiel aus dem Repository-Stammverzeichnis:

```bash
dotnet --info
dotnet restore
dotnet build
dotnet run --project src/ClanIntern.Web --launch-profile https
```

Die konkrete Startkonfiguration ist anhand der `.csproj`-Dateien, `launchSettings.json`, Paketversionen und Datenbankkonfiguration zu validieren. Zugangsdaten gehören in User Secrets oder sichere Umgebungsvariablen, nicht ins Repository. Frühere lokale Kestrel-/TLS-Fehlerlogs belegen keine allgemeine Produktionsstörung und sind separat zu untersuchen.

## Dokumentation und Verbindlichkeit

- `REQUIREMENTS.md`: fachliche Anforderungen und offene Fragen.
- `DECISIONS.md`: akzeptierte und offene Architekturentscheidungen (ADRs).
- `ARCHITECTURE.md`: Zielarchitektur, Schichten und technische Leitplanken.
- `MILESTONES.md`: Entwicklungsreihenfolge, Status und Abnahmekriterien.
- `Pflichtenheft_v0.8.md`: bisheriger konsolidierter Fachentwurf; **v0.9 folgt**.
- Whiteboards/Mock-ups: Quellen für fachliche Prüfung; nicht jede dargestellte Funktion ist bereits freigegeben oder umgesetzt.

Bei Widersprüchen zwischen Dokumenten müssen Änderungen explizit abgestimmt werden. Die README ist ein Überblick und ersetzt keine fachliche Freigabe. Der vollständige Whiteboard-Abgleich und die Konsolidierung des Pflichtenhefts stehen noch aus.

## Lern- und Qualitätsprinzip

Schrittweise Entwicklung mit Code-Reviews, Tests, nachvollziehbaren Architekturentscheidungen und Dokumentation. Nach abgeschlossenen Meilensteinen sind Lern-PDFs vorgesehen; neue Konzepte werden mit Beschreibung, Begründung und dem Bauernhof-Beispiel mit Bauer Heinrich erklärt.

---

## Dokumentationsstand v1.0 (15.11.2026)
Diese Fassung konsolidiert den v0.9-Bestand mit den im Gespräch festgelegten Lizenz- und Supportprozessen. Neu im fachlichen Zielumfang sind unter anderem STANDARD/TRIAL-Slotgrenzen, UNLIMITED-Upgrades, Downgrade- und Zahlungsfristen, persistente Jobs, Backup/Restore und das eigenständige Modul `SUPPORT_TICKET`.

**Wichtig:** Dokumentationsversion v1.0 ist **keine Softwareversion 1.0** und kein Nachweis implementierter Funktionen. Alpha 0.1 bleibt das nächste technische Lieferziel. Der vollständige Wortlaut von acht der 56 besprochenen Regelnummern und die Einzelprüfung der Whiteboards sind noch offen.

Die fachlichen Detailregeln stehen im Pflichtenheft und im Regelregister der REQUIREMENTS; technische Konsequenzen in ARCHITECTURE/DECISIONS; Umsetzungsschritte in MILESTONES.

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

---

## Fortschreibung 17.11.2026 – Sitzungs- und Inaktivitäts-Policies

**Geltung:** Diese bestätigten fachlichen Vorgaben haben bei Widersprüchen Vorrang vor älteren Aussagen zum Sitzungsmanagement. Sie sind **Soll-Anforderungen**, kein Nachweis bereits implementierter Funktionen.

- **SEC-SESSION-001 – Eine Sitzung:** Pro Plattformaccount ist zu jedem Zeitpunkt höchstens **eine aktive authentifizierte Sitzung** erlaubt (`MAX_ACTIVE_SESSIONS = 1`, nicht deaktivierbar). Die Durchsetzung erfolgt serverseitig und geräte-/browserübergreifend. Ein zweiter erfolgreicher Login muss atomar eine eindeutige aktive Sitzung bestimmen und die bisherige Sitzung widerrufen; konkurrierende Logins dürfen nicht zu zwei gültigen Sitzungen führen.
- **SEC-SESSION-002 – Wirksamer Widerruf:** Eine widerrufene Sitzung darf trotz vorhandenen Identity-Cookies oder offener Blazor-Interactive-Server-Verbindung keine geschützten Daten oder Aktionen mehr erhalten. Sitzungszustand und Berechtigungen werden serverseitig geprüft. Logout und sicherheitsrelevante Account-Ereignisse invalidieren die jeweils betroffenen Sitzungen.
- **SEC-IDLE-001 – Session-Idle-Policy:** Für authentifizierte Sitzungen sind als konfigurierbare Inaktivitätsgrenzen **15, 30 oder 45 Minuten** vorgesehen. Vor dem automatischen Sitzungsende wird **30 Sekunden** vorher gewarnt. Der endgültige Ablauf ist serverseitig durchzusetzen; die Browserwarnung allein ist keine Sicherheitskontrolle.
- **SEC-IDLE-002 – Policy-Änderungen:** Wird die Inaktivitätsgrenze administrativ geändert, gilt die neue Regel unmittelbar für bestehende aktive Sitzungen; deren Inaktivitätszähler beginnt mit dem wirksamen Änderungszeitpunkt neu. Änderungen benötigen geeignete Permission, Step-up und Audit. Ein bereits abgelaufener oder widerrufener Zugang darf dadurch nicht reaktiviert werden.
- **SEC-IDLE-003 – Aktivität:** Nur überprüfbare echte Benutzeraktivität zählt; automatische Polling-, Heartbeat- oder Blazor-Verbindungsereignisse dürfen den Timeout nicht unbegrenzt verlängern. Die genaue serverseitig verifizierbare Aktivitätsdefinition ist vor Umsetzung festzulegen.
- **Abgrenzung:** Session-Idle (Minuten), Clanmitglieds-Inaktivität (30–365 Tage, Default 90 Tage; `DISABLED`/`WARN_ONLY`/`AUTO_LOCK`) und Onboarding-Wiederaufnahme (30 Minuten nach Verbindungsabbruch) sind **drei unabhängige Regelwerke**.
- **Offene technische Präzisierungen:** Default der neuen 15/30/45-Minuten-Auswahl (historisch 60 Minuten), Warnungs-/Reconnection-Verhalten, Ablauf bei parallelen Anmeldungen und genaue Prüfintervalle. Keine stillschweigende Default-Festlegung.

**Verbindliche Abnahmefälle:** Zweiter Login widerruft ersten; zwei parallele Logins erzeugen höchstens eine aktive Sitzung; ein widerrufenes Cookie und ein offener Blazor-Circuit ermöglichen keinen Zugriff; Warnung erfolgt 30 Sekunden vor Timeout; Änderung der Idle-Policy wirkt sofort und startet den Zähler neu; Hintergrund-Polling verlängert keine Sitzung; Clanmitglieds-Inaktivität und Onboarding-Frist bleiben unabhängig.
