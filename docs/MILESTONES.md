# MILESTONES – Headquarter / ClanIntern v1.4

## Verbindlicher technischer Zielstand v1.4 (22.11.2026)

**Diese Festlegung hat bei technischen Widersprüchen Vorrang vor sämtlichen älteren Abschnitten.** Die Dokumentationsversion 1.4 ist keine Software-Release-Version. Sämtliche bestehenden fachlichen Regeln, IDs, Statusmodelle, Zahlen, Ausnahmen, Entscheidungen, offenen Punkte und Abnahmeanforderungen gelten unverändert fort. Frühere .NET-Angaben sind ausschließlich historische Architekturentscheidungen und keine aktuelle Implementierungsvorgabe.

| Bereich | Verbindlicher Zielstack |
|---|---|
| Sprache / Laufzeit | PHP 8.5 (lokale Entwicklungsumgebung; Kompatibilität der eingesetzten Laravel-Version prüfen) |
| Backend | Laravel (kompatible, beim Projektstart festzulegende Version) |
| UI / serverseitige Interaktion | Livewire, Blade |
| Kleine Browserinteraktionen | Alpine.js |
| Styling | Tailwind CSS |
| Datenbank | PostgreSQL |
| ORM / Schema | Eloquent ORM, Laravel-Migrationen |
| Authentifizierung | Laravel-Authentifizierung mit Sessions, Guards, Middleware; konkrete Starter- und MFA-Lösung gesondert festlegen |
| Berechtigungen | Laravel Policies/Gates plus projektspezifische Permission-, Scope-, Mitgliedschafts-, Lizenz- und Step-up-Prüfungen |
| Architektur | Modularer Laravel-Monolith mit fachlichen Modulgrenzen, Services/Actions, Domain-Regeln und Infrastrukturadaptern |
| Betrieb | Composer, Artisan, npm/Vite, Git/GitHub; Queue, Scheduler, CI/CD und Hosting gemäß offenen Entscheidungen |

**Architekturübersetzung:** Historische `Domain`, `Application`, `Infrastructure`, `Web` bezeichnen weiterhin logische Verantwortlichkeiten, jedoch **keine verpflichtenden vier .NET-Projekte**. Laravel-Module werden innerhalb einer Anwendung organisiert. Razor/Blazor-Komponenten werden durch Blade/Livewire ersetzt; Blazor-Circuits durch serverpersistierte Laravel-Sessions und Livewire-Requests; ASP.NET Identity durch Laravel-Authentifizierung; EF Core/Npgsql durch Eloquent/PostgreSQL und Laravel-Migrationen; .NET-DI durch den Laravel-Service-Container. Für die interne Livewire-Kommunikation ist kein gesondertes REST-Backend vorgeschrieben.

**Umsetzungsnachweis:** Die zuvor dokumentierten .NET-Login-/Datenbanktests sind historischer Altprojektstand und **kein Nachweis** für die neue Laravel-Anwendung. Laravel-Installation, Authentifizierung, Logout, PostgreSQL-Migrationen, Autorisierung, Tests und Alpha-0.1-Abnahme müssen für den neuen Stack separat belegt werden. Keine fachliche Anforderung wird durch einen Frameworkwechsel automatisch erfüllt.

**Dokumentationsschutz:** Der komplette Wortlaut der Ausgangsversion 1.3 bleibt im nachfolgenden historischen Originalbestand enthalten. Er wird nicht als aktuelle technische Vorgabe ausgelegt. Fachliche Entscheidungen bleiben maßgeblich, soweit sie nicht durch einen ausdrücklich später bestätigten Fachbeschluss ersetzt wurden.

---

## Vollständig erhaltener Ausgangsbestand v1.3 (historisches Original; technische Stack-Angaben abgelöst)

# MILESTONES – Headquarter / ClanIntern v1.3

**Stand:** 22.11.2026 · **Dokumentationsversion:** 1.3 · **Produkt:** Headquarter / ClanIntern

**Geltung:** Diese Datei ersetzt die bisherige gleichnamige Projektdokumentation. Bestehende bestätigte Fachbeschlüsse bleiben erhalten. Wo ältere, im übernommenen Quelltext enthaltene Angaben abweichen, gelten die ausdrücklich bestätigten Beschlüsse vom 16.11.2026 und die nachfolgende v1.3-Fortschreibung. Die Dokumentationsversion ist keine Software-Release-Version.

**Nachweisgrenze:** Der Implementierungsstatus beruht auf dem gemeinsam besprochenen Entwicklungsstand, nicht auf einem vollständigen aktuellen Repository-, CI- oder Testlauf. Nicht nachgewiesene Funktionen sind als offen zu behandeln.

## v1.3 – Verbindliche Fortschrittsbewertung (22.11.2026)

**Bewertungsgrundlage:** dokumentierter gemeinsamer Entwicklungsstand; ohne vollständigen aktuellen Repository-/CI-Abgleich. Kein Meilenstein wird allein wegen eines Screenshots oder einer erfolgreichen manuellen Anmeldung abgeschlossen.

| Alpha-0.1-Teilziel | Status | Nachweis / nächste Abnahme |
|---|---|---|
| Solution und Schichtenstruktur | IN_ARBEIT | Projektstruktur vorhanden; Architektur- und Buildprüfung nachführen |
| PostgreSQL / EF Core / Identity | MANUELL_GEPRÜFT | Lokale DB und Identity-Nutzer verwendet; reproduzierbare Migration/Startprüfung nachweisen |
| Formularbasierter Login | MANUELL_GEPRÜFT | Anmeldung im Entwicklungsprozess geprüft; positive/negative Integrationstests ergänzen |
| Logout und Cookie-Invalidierung | OFFEN | Logout und anschließenden Zugriffsschutz testen |
| Geschütztes Dashboard | IN_ARBEIT | Unangemeldete Requests, Redirects, Rollen-/Scope-Prüfung testen |
| Linke Sidebar / Navigation | IN_ARBEIT | Interaktive Navigation, Menümodell, Responsive- und Accessibility-Tests |
| Automatisierte Authentifizierungs-/Autorisierungstests | NICHT NACHGEWIESEN | Testfälle, Testlauf und Ergebnis dokumentieren |
| Alpha-0.1-Abnahme | OFFEN | Erst nach allen definierten Abnahmekriterien |

### Nächste Reihenfolge

1. Login/Logout, Auth-Cookies und geschützte Dashboard-Routen stabilisieren und automatisiert testen.
2. Sidebar-Navigation aus wiederverwendbaren Menüdaten aufbauen; responsive und barrierearme Bedienung prüfen.
3. CI-/Build-/Testnachweise dokumentieren; Alpha 0.1 erst dann abnehmen.
4. Anschließend fachliche Module gemäß vorhandener Milestone-Reihenfolge entwickeln; keine Lizenz-, Zahlungs- oder Berechtigungsfunktionen als fertig markieren.

**Abnahmeprinzip:** Fachlich beschlossen ≠ implementiert ≠ getestet ≠ abgenommen.

---

## Konsolidierter bestehender Fach- und Architekturstand


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

**Abhängigkeit:** Lizenz-Gate und sichere Wiederaufnahme des Gründungswizards sind vor dem produktiven Clan-Onboarding zu implementieren und zu testen. Alpha 0.1 bleibt das nächste technische Lieferziel; keine Änderung des Implementierungsstatus.

---

## Übernommener Ausgangsstand (historische Metadaten beachten)

> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die Originalformulierungen von LICENCE-038 bis 041 und LICENCE-054 bis 056 liegen hier nicht verlässlich vor; sie sind ausdrücklich zur Nachprüfung markiert. Vollständige Freigabe aller 56 Regeln ist deshalb noch ausstehend.

# Headquarter – Entwicklungsmeilensteine

> Stand: 13.11.2026 · Version: 1.0 · Status: in Entwicklung
> Verbindlicher Zielstack: .NET 11 / C# / ASP.NET Core / Blazor Interactive Server / PostgreSQL / EF Core 11 / Npgsql.
> **Statusregel:** Nur nachweislich abgeschlossene Aufgaben werden als erledigt markiert. Bereits besprochener Code gilt nicht automatisch als getestet oder fertig.

## Projektziel
Entwicklung einer professionellen, sicheren und modularen Clan-Management-Plattform auf Basis des Headquarter-Pflichtenheftes.

## Arbeitsweise
Schrittweise Entwicklung mit Code-Reviews, Tests, Dokumentation und praktischen Lernbeispielen.

## Aktueller technischer Rahmen
- Sprache und Plattform: C# / .NET 11 / ASP.NET Core
- Weboberfläche: Blazor Web App mit interaktivem Server-Rendering (`InteractiveServer`)
- Struktur: Domain, Application, Infrastructure und `ClanIntern.Web` (beobachtete Projektstruktur)
- Datenzugriff: PostgreSQL mit EF Core 11 und Npgsql als **beschlossener Zielstack**. Historisches `UseSqlServer` im besprochenen Code muss überprüft und migriert werden; tatsächliche Umsetzung noch nicht verifiziert
- UI-Styling: Bootstrap 5.3.3 derzeit eingebunden; Tailwind CSS als geplante Umstellung
- Authentifizierung: ASP.NET Core Identity verbindlich bereits für Alpha 0.1; bisherige `LoginForm` prüft nach dokumentiertem Stand nur Modellvalidierung
- Git / GitHub, Docker und GitHub Actions für Versionsverwaltung und spätere Auslieferung

## Alpha 0.1 – Verbindliches erstes Lieferinkrement
**Status: Geplant / Implementierung nicht nachgewiesen**

Dieses Inkrement zieht die technisch notwendigen Teile aus M1, M2, M4 und M5 vor. Die späteren Meilensteine bleiben als Lern- und Ausbauphasen bestehen; erledigte Arbeiten werden dort nicht doppelt als offen behandelt.

- [ ] .NET-11-SDK, Solution-Build und Projekt-Referenzen verifizieren
- [ ] PostgreSQL, Npgsql, EF Core 11, Identity-Datenmodell und reproduzierbare Migration einrichten
- [ ] ASP.NET Core Identity mit echter Benutzeranmeldung und Abmeldung integrieren; keine simulierte Anmeldung
- [ ] Geschützte Dashboard-Route mit gemeinsamem Layout und minimaler berechtigungsabhängiger Navigation bereitstellen
- [ ] Identität, Clanmitgliedschaft, Clanrolle und Plattformverwaltungsrecht getrennt behandeln; Login allein verleiht keine Verwaltungsrechte
- [ ] Zugriff auf geschützte Seiten und Aktionen serverseitig prüfen; UI-Ausblendung allein reicht nicht
- [ ] Erfolgreichen/fehlgeschlagenen Login, Logout, anonymen Zugriff und unerlaubten Direktaufruf automatisiert oder nachvollziehbar testen
- [ ] Sicherheitsrelevante Login-Ereignisse ohne Klartext-Secrets protokollieren und Cookie-/CSRF-Schutz prüfen
- [ ] Releasegrenze für MFA, Step-up, Passwort-Reset und Ein-Session-Regel anhand des Pflichtenhefts explizit prüfen; nicht implementierte Baseline-Regeln verhindern eine ungesicherte produktive Freigabe
- [ ] Lokal startfähige Anwendung, Build, Datenbankmigration und Abnahmetests nachweisen und dokumentieren

**Abschlusskriterium:** Ein echter Account kann sich anmelden und abmelden, unberechtigte Personen erreichen weder geschützte Daten noch Aktionen, und das gemeinsame Dashboard zeigt nur erlaubte Funktionen. Der Nachweis erfolgt durch ausführbare Tests beziehungsweise dokumentierte Prüfschritte; das Inkrement ist keine produktive Sicherheitsfreigabe.

**Architekturregel:** Eine gemeinsame Dashboard-Struktur wird wiederverwendet. Plattform- und Clanverwaltung bleiben durch Zugriffsrechte und Kontext getrennt. Die konkrete Leader-Navigation ist noch offen und wird nicht vorweggenommen.

---

## M1 – Infrastruktur, Git und Dokumentation
**Status: In Bearbeitung**

- [x] Projektverzeichnis Headquarter erstellen (Altstand)
- [x] Git initialisieren, `.gitignore` konfigurieren und ersten Commit erstellen (Altstand)
- [x] Privates GitHub-Repository und SSH-Remote einrichten (Altstand)
- [ ] Installierte .NET-SDK-Version, Git und Entwicklungswerkzeuge prüfen und dokumentieren
- [ ] Solution und Projekte `Domain`, `Application`, `Infrastructure`, `ClanIntern.Web` sowie Referenzrichtungen überprüfen
- [ ] Architekturprinzipien und Dependency-Injection-Konfiguration dokumentieren
- [ ] Projektdokumentation fertigstellen
- [ ] Pflichtenheft v0.6 und Whiteboard-Policies übernehmen
- [ ] Änderungen committen und pushen
- [ ] M1-Lern-PDF erstellen

**Abschlusskriterium:** Repository, .NET-Projektstruktur, Dokumentation und Projektgrundlage sind nachvollziehbar eingerichtet und versioniert.

## M2 – Frontend: Blazor-Grundlagen
**Status: In Bearbeitung (Lernstand; Umsetzung nicht vollständig verifiziert)**

- [ ] Blazor Web App und Razor-Komponenten vollständig verstehen und lokal startfähig prüfen
- [x] `_Imports.razor`, `App.razor` und `Routes.razor` im Lernreview besprochen
- [x] `LoginForm.razor` im Lernreview begonnen
- [ ] Komponenten, Parameter, Events, Datenbindung und Lifecycle vertiefen
- [ ] `EditForm`, Data Annotations und Validierungsanzeigen testen
- [ ] `InteractiveServer`, Verbindungsabbruch und `ReconnectModal` nachvollziehen und testen
- [ ] Tailwind CSS einrichten; Bootstrap-Abhängigkeiten prüfen und gegebenenfalls ablösen
- [ ] Bestehendes Headquarter-Login-Design übertragen
- [ ] Responsive Design und Barrierefreiheit umsetzen
- [ ] Blazor-Komponententests einführen (z. B. bUnit)
- [ ] M2-Lern-PDF erstellen

**Abschlusskriterium:** Das Login-Design ist responsiv umgesetzt, die Blazor-Anwendung startet lokal und die wesentlichen Komponenten sind getestet.

## M3 – Anwendungsservices und bei Bedarf HTTP-APIs mit ASP.NET Core
**Status: Geplant**

- [ ] Verantwortlichkeiten von Domain, Application, Infrastructure und Web festlegen
- [ ] ASP.NET-Core-Endpunkte über Controller oder Minimal APIs bewusst auswählen
- [ ] Services, Interfaces und Dependency Injection verstehen und anwenden
- [ ] HTTP-/REST-Endpunkte für benötigte externe Zugriffe entwickeln
- [ ] Request-/Response-DTOs und serverseitige Eingabevalidierung einführen
- [ ] Fehlerbehandlung, ProblemDetails und strukturiertes Logging einrichten
- [ ] Authentifizierung und Autorisierung an Endpunkten berücksichtigen
- [ ] Unit- und Integrationstests schreiben
- [ ] M3-Lern-PDF erstellen

**Abschlusskriterium:** Erforderliche Anwendungsfälle sind über getestete Anwendungsservices erreichbar; HTTP-Endpunkte werden nur bei konkretem Bedarf bereitgestellt.

## M4 – Datenbank und Datenmodell
**Status: Geplant**

- [ ] PostgreSQL-Verbindung und Npgsql-Konfiguration einrichten; historische SQL-Server-Konfiguration entfernen oder bewusst migrieren
- [ ] Entity Framework Core und `DbContext` / `AddDbContextFactory` nachvollziehen
- [ ] Fachliches ER-Diagramm erstellen
- [ ] Entitäten, Schlüssel, Relationen und Constraints modellieren
- [ ] Plattform-Accounts und Clan-Mitgliedschaften getrennt modellieren
- [ ] EF-Core-Migrationen erstellen, anwenden und testen
- [ ] Transaktionen, Concurrency und Datenintegrität testen
- [ ] Geheimnisse und Connection Strings sicher verwalten
- [ ] M4-Lern-PDF erstellen

**Abschlusskriterium:** Die grundlegenden Datenmodelle sind dokumentiert, migriert und getestet.

## M5 – Authentifizierung und Sicherheit (Grundfunktionalität bereits in Alpha 0.1)
**Status: Geplant**

- [ ] ASP.NET Core Identity und benötigtes Account-Modell einrichten
- [ ] Registrierung und E-Mail-Verifikation
- [ ] Tatsächlichen Login und Logout implementieren (Pflicht bereits für Alpha 0.1; hier Erweiterung und Härtung)
- [ ] Passwort-Hashing und Passwort-Reset
- [ ] Sichere Cookie-basierte Sessions und Schutz vor CSRF
- [ ] Rollen, Permissions, Scopes und Policies
- [ ] Serverseitige Autorisierung in Komponenten, Services und Endpunkten
- [ ] MFA und Step-up-Authentifizierung gemäß Pflichtenheft
- [ ] Rate Limiting und Account-Lockout
- [ ] Sicherheitsrelevante Audit-Logs
- [ ] Sicherheits- und Autorisierungstests
- [ ] M5-Lern-PDF erstellen

**Abschlusskriterium:** Der grundlegende Account- und Sicherheitsprozess funktioniert gemäß Pflichtenheft.

## M6 – Mitglieder, Teams und Onboarding
**Status: Geplant**

- [ ] Mitgliederverwaltung
- [ ] Clan-Einladungen und Aufnahmefreigaben
- [ ] Teamverwaltung und Teamzugehörigkeiten
- [ ] Delegierbare Berechtigungen
- [ ] Titel und Badges
- [ ] Clan-Einstellungen und Security-Policies
- [ ] Domain-/Application-Logik und Blazor-Oberflächen implementieren und testen
- [ ] M6-Lern-PDF erstellen

**Abschlusskriterium:** Mitglieder und Teams können regelkonform verwaltet werden.

## M7 – Kommunikation und Inhalte
**Status: Geplant**

- [ ] News, Ankündigungen und Umfragen
- [ ] Freigabe- und Veröffentlichungsworkflows
- [ ] Öffentliches, internes und teamspezifisches Forum
- [ ] Direkt-, Gruppen-, Clan- und Teamchat
- [ ] Echtzeitkommunikation im ASP.NET-Core-Umfeld evaluieren (z. B. SignalR); Blazor-Circuit nicht mit Chat-Infrastruktur gleichsetzen
- [ ] Moderation, Wortfilter und Spam-Schutz
- [ ] Benachrichtigungen
- [ ] M7-Lern-PDF erstellen

**Abschlusskriterium:** Inhalte und Kommunikation funktionieren gemäß Rollen und Sichtbarkeitsregeln.

## M8 – Clan-Funktionen und Integrationen
**Status: Geplant**

- [ ] Warplaner und Matchorganisation
- [ ] Game- und Voice-Server-Integrationen
- [ ] Sichere Datei- und Medienuploads
- [ ] Clankasse, Transaktionen und Belege
- [ ] Externe Integrationen über geeignete Infrastructure-Adapter anbinden
- [ ] M8-Lern-PDF erstellen

**Abschlusskriterium:** Kernfunktionen und Integrationen sind sicher nutzbar und getestet.

## M9 – Plattform, Lizenzen und Administration
**Status: Geplant**

- [ ] Lizenzmodelle und Lizenzperioden
- [ ] Trial, Verlängerung und Reaktivierung
- [ ] Standard- und Unlimited-Slots
- [ ] Lizenzbasierte Funktionsfreischaltung
- [ ] Plattformadministration und kontrollierter Support-Zugriff
- [ ] Vollständige Auditierung
- [ ] M9-Lern-PDF erstellen

**Abschlusskriterium:** Lizenz- und Administrationsregeln werden serverseitig zuverlässig durchgesetzt.

## M10 – Qualität, Deployment und Release
**Status: Geplant**

- [ ] Docker-Umgebung für ASP.NET Core und Datenbank vervollständigen
- [ ] CI/CD mit GitHub Actions und `dotnet`-Build-/Test-/Publish-Schritten
- [ ] Automatisierte Tests, Dependency- und Security-Checks
- [ ] Performance, Monitoring, Logs und Health Checks
- [ ] Backup- und Recovery-Konzept
- [ ] HTTPS, Secrets und produktive Konfiguration absichern
- [ ] Deployment und Release-Vorbereitung
- [ ] M10-Lern-PDF erstellen

**Abschlusskriterium:** Headquarter kann reproduzierbar, überwacht und sicher bereitgestellt werden.

---

## Lern- und Dokumentationsregeln
Nach jedem abgeschlossenen Meilenstein wird eine Lern-PDF erstellt. Jeder relevante Terminalbefehl und jedes wichtige neue Konzept wird nach diesem Schema erklärt:

1. **Befehl / Konzept:** Bezeichnung
2. **Beschreibung:** Was bedeutet es und was passiert technisch?
3. **Warum:** Weshalb benötigen wir es?
4. **Anwendungsbeispiel Bauernhof:** Anschauliches Beispiel aus dem Alltag von Bauer Heinrich.

Zusätzlich dokumentieren wir Architekturentscheidungen, Änderungen an Anforderungen und wichtige Erkenntnisse in Markdown-Dateien.

## Grundsatz
Die Meilensteine definieren die Reihenfolge der Entwicklung, nicht den vollständigen Funktionsumfang. Maßgeblich bleiben das Pflichtenheft und die vereinbarten Whiteboard-Policies. Offene Anforderungen werden nicht stillschweigend gestrichen; sie werden vor ihrer Umsetzung fachlich konkretisiert.

## Migrationshinweis
Diese Fassung ersetzt technologiespezifische Aufgaben aus der ursprünglichen Next.js-/NestJS-/Prisma-/PostgreSQL-Planung. Fachliche Ziele und Meilensteinreihenfolge bleiben erhalten. Nicht vorliegende Architektur- und Entscheidungsdokumente werden nicht als bereits geprüft ausgegeben.


## Abhängigkeiten und offene Festlegungen (Stand 13.11.2026)

- Die Reihenfolge M1–M10 ist eine Lern- und Themenstruktur, **keine** harte technische Sperre: Alpha 0.1 benötigt bereits Datenbank und Identity aus späteren Meilensteinen.
- Die vollständige Rollen-/Permission-/Scope-Matrix, Sonderzugriffe, Registrierung und Leader-Navigation sind vor den jeweiligen erweiterten Funktionen fachlich zu entscheiden.
- `DECISIONS.md` v0.9 und `REQUIREMENTS.md` v0.9 definieren die bestätigten Grundlagen. Der Repository-Code ist separat auf .NET 11, PostgreSQL und Npgsql zu migrieren.
- Bestehende Checklisten bleiben offen, solange keine Ausführung, Tests oder Commits nachgewiesen sind.
- Die Whiteboard-Policies und das Pflichtenheft v0.8 bleiben fachliche Referenzen; offene Konflikte sind vor Umsetzung zu klären.

---

## v1.0 – Zusätzliche geplante Lieferpakete
**Status sämtlicher nachfolgender Aufgaben: Geplant, nicht als umgesetzt nachgewiesen.**

### M-LIC – Lizenz- und Slotkern
- [ ] Lizenzperioden, Statusmodell, Mitgliedschaftsslots und transaktionale Aktivierung
- [ ] Trial-/Downgrade-/Zahlungsfristen und Sperrregeln
- [ ] Serververifizierte Zahlungen, Idempotenz und Konfliktbehandlung
- [ ] Grenzwert-, Parallelitäts- und Zustandswechseltests

### M-JOB – Scheduler, Benachrichtigung und Audit
- [ ] PostgreSQL-persistente Jobs mit 5-Minuten-Takt
- [ ] Retry-/Review-/Eskalationspfade und manuelle Freigaben
- [ ] E-Mail/SMS/WhatsApp-Adapter mit Einwilligungs- und Fehlerbehandlung
- [ ] Integrations- und Zeitzonentests

### M-SUPPORT – Support-Tickets
- [ ] Separates Modul, Leader-/Supportberechtigungen und Dashboards
- [ ] Priorität HIGH, Erstreaktionsfristen, Ticketwiedereröffnung
- [ ] Sichere Uploads mit 25-MB-/10-Dateien-Grenzen
- [ ] 14-Tage-Anhanglöschung, 24-Stunden-Warnung und Audit
- [ ] Berechtigungs-, Upload- und Eskalationstests

### M-RECOVERY – Löschung und Restore
- [ ] Löschvorprüfung mit allen Sperr-/Fristbedingungen
- [ ] Verschlüsselte, integritätsgeprüfte Backups mit Aufbewahrungsregeln
- [ ] Autorisierter Restore mit RESTORING-Sperre und Validierungsbericht
- [ ] Fehlerszenarien und Wiederanlauftests

### M-DOC – Fachliche Freigabe
- [ ] Originalwortlaut LICENCE-038 bis 041 und 054 bis 056 abgleichen
- [ ] Fachliche Konflikte zwischen Altbestand und neuen Regeln auflösen
- [ ] Whiteboard-Einzelbildabgleich abschließen
- [ ] Dokumente v1.0 nach Prüfung fachlich freigeben

**Reihenfolge:** Alpha 0.1 bleibt erstes Lieferinkrement. Neue Pakete bauen auf Identity, Datenmodell, Autorisierung und Auditgrundlagen auf; ihre Aufnahme in die Roadmap bedeutet keine vorgezogene Implementierung.

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

### Zusätzliche Abnahmepakete (alle offen bis Testnachweis)
- [ ] Rollen-/Scope-/Widerrufs- und Exporttests
- [ ] Einladungs-/Leader-Freigabe- und Inaktivitätstests
- [ ] Lizenzperioden-, Idempotenz-, Downgrade-/Slot-Race-Tests
- [ ] MFA-, Session-, Reset-, Step-up- und Audit-Tests
- [ ] Warplanner-/Finanz-/Benachrichtigungs- und Uploadtests
- [ ] Restore-/Migration-/Monitoring-/Release-Gates

---

### Ergänzende Sicherheits-Abnahmeschritte (noch nicht als erledigt markieren)

1. Sitzungsmodell, atomare Login-Übernahme und serverseitigen Widerruf spezifizieren.
2. Session-Idle-Auswahl (15/30/45 Minuten), Warnung (30 Sekunden), echte Aktivität und sofortige Policy-Übernahme umsetzen.
3. Integrations- und Concurrency-Tests einschließlich paralleler Logins, alter Cookies, offener Blazor-Circuits und Policy-Wechsel ausführen.
4. Vor produktiver Freigabe Sicherheitsprüfung dokumentieren.

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
