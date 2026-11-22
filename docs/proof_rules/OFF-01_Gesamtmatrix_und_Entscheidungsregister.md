# OFF-01 – Gesamte Whiteboard-Abdeckungs- und Entscheidungsmatrix
**Arbeitsfassung, 15. November 2026.** Konsolidiert die sechs vorhandenen Einzelprotokolle für die 50 eindeutigen Originalbilder und gleicht sie gegen die sieben ursprünglichen Projektdokumente, das Pflichtenheft v1.0 und die separat vorliegende Sieben-Regeln-Korrekturfassung ab. **Kein Quelltext und kein Originaldokument verändert.**

## 1. Prüfumfang und Methodik
- Quellen: `OFF-01_Whiteboard_Einzelabgleich_01-05.md`, `06-10.md`, `11-20.md`, `21-30.md`, `31-40.md`, `41-50.md`.
- Dokumente: `ARCHITECTURE_v0.9(1).md`, `DECISIONS_v0.9(1).md`, `MILESTONES_v0.9(1).md`, `Pflichtenheft_v0.9(2).md`, `README_v0.9(2).md`, `REQUIREMENTS_v0.9(1).md`, `Pflichtenheft_v1.0(1).md`.
- Zusätzlicher Änderungsbeleg: `Pflichtenheft_v1.0_nur_7_Regeln_korrigiert.md` liegt vor und enthält ausformulierte LICENCE-038–041 und -054–056. Seine inhaltliche Existenz ist nachweisbar; die **formale fachliche Freigabe und Übernahme in die maßgebliche v1.0** ist gesondert festzustellen.
- Befundkategorien bezeichnen Dokumentabdeckung, **nicht** Implementierung oder bestandene Tests. Fotos mit mehreren Regeln bleiben als ein Bildbeleg zusammengefasst; vollständige Einzeldetails stehen in den sechs Quellprotokollen.

## 2. Vollständige Bild-zu-Anforderungs-Matrix
| Bild | Original | Kernaussage aus Einzelprotokoll | Dokumentreferenz | Bewertung | Entscheidungskreis |
|---:|---|---|---|---|---|
| 01 | `DFF42987-4F93-43FD-A8BE-51E646391657.JPG` | Lizenzzustände. | §§4, 6–8, 10–12; LICENCE-007–009 | Teilweise / Detail | OFF-02/03/06/09 |
| 02 | `IMG_4371.HEIC` | Teamleiter-Kompetenzen, Rollen, Permission-Delegation, Audits. | §§4, 6–8, 10–12; LICENCE-007–009 | Teilweise / Detail | OFF-02/03/06/09 |
| 03 | `IMG_4372.HEIC` | Content, Forum, Chat. | §§4, 6–8, 10–12; LICENCE-007–009 | Teilweise / Detail | OFF-02/03/06/09 |
| 04 | `IMG_4373.HEIC` | Clankasse, Spenden, Ledger, Zahlungsstatus. | §§4, 6–8, 10–12; LICENCE-007–009 | Teilweise / Detail | OFF-02/03/06/09 |
| 05 | `IMG_4374.HEIC` | PDF-Zahlungsbestätigung, Finanz-Audit und Retention. | §§4, 6–8, 10–12; LICENCE-007–009 | Teilweise / Detail | OFF-02/03/06/09 |
| 06 | `IMG_4377.HEIC` | SERVER | §§1, 3a, 5, 9, 11 | Klärung / Lücke | OFF-02/07/10 |
| 07 | `IMG_4381.HEIC` | SECURITY-Datenmodell | §§1, 3a, 5, 9, 11 | Teilweise / Detail | OFF-02/07/10 |
| 08 | `IMG_4382.HEIC` | RISK SIGNAL & SECURITY AUDIT | §§1, 3a, 5, 9, 11 | Teilweise / Detail | OFF-02/07/10 |
| 09 | `IMG_4383.HEIC` | SERVER-PERMISSIONS | §§1, 3a, 5, 9, 11 | Teilweise / Detail | OFF-02/07/10 |
| 10 | `IMG_4384.HEIC` | PLATTFORMACCOUNT | §§1, 3a, 5, 9, 11 | Teilweise / Detail | OFF-02/07/10 |
| 11 | `IMG_4385.HEIC` | Account, Verifikation, Mitgliedschaft | §§3a–6, 11, 15 | Teilweise / Detail | OFF-02/05/06/07 |
| 12 | `IMG_4388.HEIC` | Rollen- und Rechte-Trennung | §§3a–6, 11, 15 | Klärung / Lücke | OFF-02/05/06/07 |
| 13 | `IMG_4389.HEIC` | Clan-Stammdaten | §§3a–6, 11, 15 | Teilweise / Detail | OFF-02/05/06/07 |
| 14 | `IMG_4390.HEIC` | 10 CLAN_SETTINGS-Permissions | §§3a–6, 11, 15 | Teilweise / Detail | OFF-02/05/06/07 |
| 15 | `IMG_4391.HEIC` | Theme, Links, Kontakt | §§3a–6, 11, 15 | Klärung / Lücke | OFF-02/05/06/07 |
| 16 | `IMG_4392.HEIC` | Clan-Sichtbarkeit | §§3a–6, 11, 15 | Klärung / Lücke | OFF-02/05/06/07 |
| 17 | `IMG_4394.HEIC` | Allgemeine Clan-Policies | §§3a–6, 11, 15 | Teilweise / Detail | OFF-02/05/06/07 |
| 18 | `IMG_4395.HEIC` | Relevante Aktivität | §§3a–6, 11, 15 | Klärung / Lücke | OFF-02/05/06/07 |
| 19 | `IMG_4396.HEIC` | Nicht zählende Aktivität | §§3a–6, 11, 15 | Klärung / Lücke | OFF-02/05/06/07 |
| 20 | `IMG_4397.HEIC` | Mitglied-Onboarding-Zustandsmaschine | §§3a–6, 11, 15 | Teilweise / Detail | OFF-02/05/06/07 |
| 21 | `IMG_4399.HEIC` | Konkreter Einladungsfall: Player, PENDING_APPROVAL, Einladung durch TeamLeader Max, Zeitstempel für Einladung und Annahme, noch offene Freigabe, Zielteam CS2 Main. | §§5–6; ARCHITECTURE; M3/M4 | Teilweise / Detail | OFF-02/05 |
| 22 | `IMG_4400.HEIC` | Clan-Policies: Einladungsgültigkeit; Genehmigung ON/OFF; Defaultrolle MEMBER; Wiederbeitritt ALLOWED/APPROVAL_REQUIRED/BLOCKED; Resend-Limit und Cooldown. TeamLeader kann Aufnahme  | §§5–6; ARCHITECTURE; M3/M4 | Klärung / Lücke | OFF-02/05 |
| 23 | `IMG_4401.HEIC` | MEMBER_INVITATION_EXPIRATION_DAYS konfigurierbar (7/14/30 nur Beispiele); MEMBER_APPROVAL_REQUIRED ON; TEAM_ASSIGNMENT_REQUIRED OFF; DEFAULT_MEMBER_ROLE MEMBER, nicht konfigurierba | §§5–6; ARCHITECTURE; M3/M4 | Teilweise / Detail | OFF-02/05 |
| 24 | `IMG_4402.HEIC` | Zweites Foto derselben Tafel wie Nr. 23, mit zusätzlicher roter Schlussbemerkung: optionale Zielteamwahl erhält Flexibilität. | §§5–6; ARCHITECTURE; M3/M4 | Teilweise / Detail | OFF-02/05 |
| 25 | `IMG_4459.HEIC` | SOLID: Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, Dependency Inversion. | §§5–6; ARCHITECTURE; M3/M4 | Teilweise / Detail | OFF-02/05 |
| 26 | `IMG_4482.HEIC` | MEMBER_MFA_POLICY OPTIONAL/REQUIRED nur für normale Member; privilegierte Rollen immer MFA. Konfigurierbare Login-Sperrversuche, Sperrdauer, Failed-Login-Warnung, genau eine Sessio | §§4–5, 11; REQ-ACCESS-001 | Übernommen / prüfen | OFF-02/07 |
| 27 | `IMG_4483.HEIC` | NON_CONFIGURABLE_SECURITY_BASELINE: MAX_ACTIVE_SESSIONS=1, PRIVILEGED_ROLE_MFA REQUIRED, PASSWORD_RESET_RATE_LIMIT REQUIRED, RECOVERY_CODES ONE_TIME_USE, STEP_UP_FOR_CRITICAL_ACTIO | §§4–5, 11; REQ-ACCESS-001 | Klärung / Lücke | OFF-02/07 |
| 28 | `IMG_4484.HEIC` | ACCOUNT_SECURITY_POLICIES: Member-MFA, Lock-Schwelle und -Dauer, New-Device-Challenge, Suspicious-Location-Challenge, Idle-Timeout. Nicht abschaltbar zusätzlich: New-Device-Notific | §§4–5, 11; REQ-ACCESS-001 | Übernommen / prüfen | OFF-02/07 |
| 29 | `IMG_4485.HEIC` | Defaultwerte: Member-MFA OPTIONAL, 5 Fehlversuche im 15-Minuten-Fenster, 30-Minuten-Sperre, New-Device/Suspicious-Location-Challenge ON, 60-Minuten-Idle. Nicht abschaltbare Baselin | §§4–5, 11; REQ-ACCESS-001 | Übernommen / prüfen | OFF-02/07 |
| 30 | `IMG_4488.HEIC` | Permissions `CLAN_SECURITY_POLICY_READ`, `_UPDATE`, `_RESET_DEFAULT`; ClanAdmin alle drei, Subleader READ und UPDATE/RESET nur mit expliziter Delegation, TeamLeader/Moderator/Membe | §§4–5, 11; REQ-ACCESS-001 | Teilweise / Detail | OFF-02/07 |
| 31 | `IMG_4489.HEIC` | Ergänzung `FAILED_LOGIN_WINDOW_MINUTES=15`; Step-up für Member-MFA, Login-Lock-Schwelle/-Dauer/-Fenster, Geräte-/Standort-Challenge, Idle-Timeout und Security-Policy-Reset. Ablauf: | §§4–5, 11; REQ-ACCESS-001 | Teilweise / Detail | OFF-02/07 |
| 32 | `IMG_4491.HEIC` | `SECURITY_POLICY_CHANGED` mit clan-id, actor-user-id, policy-name, old/new-value, changed-at, step-up-verified; Reset-Ereignis `SECURITY_POLICY_RESET_TO_DEFAULT`; UPDATE-Permission | §§4–5, 11; REQ-ACCESS-001 | Teilweise / Detail | OFF-02/07 |
| 33 | `IMG_4492.HEIC` | ClanAdmin darf delegieren; Subleader darf delegierte Berechtigung nutzen, nicht weiterdelegieren. | §§4–5, 11; REQ-ACCESS-001 | Übernommen / prüfen | OFF-02/07 |
| 34 | `IMG_4538.HEIC` | Historische Lizenzmodelle: Trial 7 Tage, Paid 30/90/180/360 Tage, gleiche Funktionen/Slots, Unterschied Laufzeit/Preis; bezahlte Lizenz nach verifizierter Zahlung aktiv; bei Ablauf | §§3a–5, 10; LICENCE-007–010, 026–033 | Teilweise / Detail | OFF-02/03/06 |
| 35 | `IMG_4539.HEIC` | Lizenzierung getrennt von Login-Sicherheit; `PLATFORM_ACCOUNT ≠ CLAN_MEMBERSHIP ≠ ROLE ≠ LICENCE`; Kauf ordnet Lizenz dem Plattformaccount zu, aktiviert Clan, Gründer wird ClanAdmi | §§3a–5, 10; LICENCE-007–010, 026–033 | Teilweise / Detail | OFF-02/03/06 |
| 36 | `IMG_4540.HEIC` | SupportAdmin kann kontrollierten Clan-/ClanAdmin-Transfer durchführen, mit Step-up und Security-Audit; Plattformaccount bleibt unabhängig vom Clanstatus. Beispiel Account → Licence | §§3a–5, 10; LICENCE-007–010, 026–033 | Teilweise / Detail | OFF-02/03/06 |
| 37 | `IMG_4541.HEIC` | `LICENCE_STATUS` und `LICENCE_TYPE` trennen. Trial als siebentägige Phase, ACTIVE nach bestätigter Zahlung bis expires_at, EXPIRED ohne Nutzungsrecht, aber Clan/Daten nicht automat | §§3a–5, 10; LICENCE-007–010, 026–033 | Klärung / Lücke | OFF-02/03/06 |
| 38 | `IMG_4542.HEIC` | One-time trial/account, 7 Tage; Anti-Missbrauch durch Doppelaccounts; Paid 30/90/180/360 Tage; Beispiel Status ACTIVE, Dauer 90, Start/Expiry; Status, Laufzeit, Slots strikt getren | §§3a–5, 10; LICENCE-007–010, 026–033 | Teilweise / Detail | OFF-02/03/06 |
| 39 | `IMG_4543.HEIC` | Trial-Conversion: bezahlte Lizenz während laufender Trial kaufen; Zahlung bestätigen, Paid-Entitlement für nach Trial-Ende planen, Trial-Resttage nicht verfallen lassen; Beispiel ` | §§3a–5, 10; LICENCE-007–010, 026–033 | Klärung / Lücke | OFF-02/03/06 |
| 40 | `IMG_4627.HEIC` | Zustandsdiagramme `NO_LICENCE → START_TRIAL → TRIAL(7 Tage) → EXPIRED`; Paid `PURCHASE → PENDING_ACTIVATION → ACTIVE`; Kauf während Trial führt zu SCHEDULED, `CURRENT_ENTITLEMENT=T | §§3a–5, 10; LICENCE-007–010, 026–033 | Klärung / Lücke | OFF-02/03/06 |
| 41 | `IMG_4628.HEIC` | `TRIAL_EXPIRED_AT` → Trial endet → bereits bezahlte `SCHEDULED LICENCE` → `ACTIVE`; Beispiel: Kauf und Zahlungsbestätigung während Trial, Laufzeit beginnt nach Trial-Ende. Unten al | §§3a–5, 10; LICENCE-007–010, 026–033 | Klärung / Lücke | OFF-02/03/06 |
| 42 | `IMG_4629.HEIC` | Aktuelle Lizenz bleibt während geplanter Verlängerung aktiv; `CURRENT ACTIVE expires` → scheduled renewal → ACTIVE. Reaktivierung abgelaufener Lizenz: `EXPIRED → REACTIVATE/PURCHAS | §§3a–5, 10; LICENCE-007–010, 026–033 | Teilweise / Detail | OFF-02/03/06 |
| 43 | `IMG_4630.HEIC` | Gesamtmodell `NO_LICENCE`: Trial-Pfad und direkter Kauf-Pfad; Kauf im Trial → `PENDING_ACTIVATION → PAYMENT_CONFIRMED → SCHEDULED → ACTIVE`; Verlängerung während ACTIVE → SCHEDULED | §§3a–5, 10; LICENCE-007–010, 026–033 | Klärung / Lücke | OFF-02/03/06 |
| 44 | `IMG_4631.HEIC` | `LICENCE` gehört zu `ACCOUNT_ID`; separate `LICENCE_PERIODE` für Trial, bezahlte Periode, zukünftige bezahlte Periode und weitere Verlängerungen. Eine Lizenzkennung kann mehrere Pe | §§3a–5, 10; LICENCE-007–010, 026–033 | Teilweise / Detail | OFF-02/03/06 |
| 45 | `IMG_4632.HEIC` | STANDARD mit Slotlimit (auf der Skizze als Variable `X`), UNLIMITED unbegrenzt; Slot zählt aktive Clanmitgliedschaft, nicht Plattformaccount; `ACTIVE` belegt Slot, `INVITED`, `REJE | §10; LICENCE-001–007, 028, 033 | Übernommen / prüfen | OFF-03/04/05 |
| 46 | `IMG_4633.HEIC` | Sonderfall Clan mit 73 Mitgliedern, Downgrade UNLIMITED→STANDARD (im Foto beispielhaft 50 Slots); Überhang wird nicht gelöscht, Bestand bleibt, neue Mitgliedschaften/Slots gesperrt | §10; LICENCE-001–007, 028, 033 | Übernommen / prüfen | OFF-03/04/05 |
| 47 | `IMG_4634.HEIC` | Wiederholt Sonderfall 73→STANDARD, nun mit **25 Slots**; aktive Mitgliedschaft zählt unabhängig von Rolle (ClanAdmin, Subleader, TeamLeader, Moderator, Member je 1). | §10; LICENCE-001–007, 028, 033 | Übernommen / prüfen | OFF-03/04/05 |
| 48 | `IMG_4668.HEIC` | Upgrade STANDARD(25)→UNLIMITED: Kauf → `PENDING_ACTIVATION` → `PAYMENT_CONFIRMED`; TRIAL ebenfalls maximal 25 Slots. | §10; LICENCE-001–007, 028, 033 | Übernommen / prüfen | OFF-03/04/05 |
| 49 | `IMG_4669.HEIC` | STANDARD 25; alle Rollen je ein Slot; TRIAL 25; Upgrade nach verifizierter Zahlung, bestehendes `EXPIRES_AT` bleibt laut Skizze unverändert; Downgrade UNLIMITED→STANDARD `SCHEDULED | §10; LICENCE-001–007, 028, 033 | Klärung / Lücke | OFF-03/04/05 |
| 50 | `IMG_4670.HEIC` | Downgrade UNLIMITED→STANDARD zum Periodenende; `ACTIVE_MEMBERS <= 25` Normalbetrieb, bei `>25` 30 Tage `SLOT_GRACE_PERIOD`, vorhandene Mitglieder bleiben nutzbar, neue Aktivierunge | §10; LICENCE-001–007, 028, 033 | Übernommen / prüfen | OFF-03/04/05 |

**Leseregel:** Die Zeilen referenzieren jeweils das detaillierte Originalprotokoll. „Übernommen“ bedeutet fachlich dokumentiert, nicht technisch umgesetzt. „Klärung“ bedeutet keine automatische Ablehnung historischer Anforderungen.

## 3. Konsolidierte Entscheidungs- und Konfliktmatrix
| ID | Thema / Bildbelege | Bestätigter Stand | Noch zu entscheiden / zu ergänzen | Priorität |
|---|---|---|---|---|
| D-01 | Trial→Paid, 39–43 | Trial 7 Kalendertage; Zahlung verifizieren; Resttage sollen erhalten bleiben | Beginnt die bezahlte Periode nach Trialende oder ab Zahlung? `starts_at`, `expires_at`, Anzeige-Entitlement und parallele Zahlungen eindeutig festlegen | **Blocker Lizenzautomat** |
| D-02 | Lizenzperioden, 1, 34, 37–44 | `PENDING_ACTIVATION`, `SCHEDULED`, `ACTIVE`, `EXPIRED` fachlich unterscheidbar | Lizenz vs. Lizenzperiode, Status- und Entitlementautomat, Eindeutigkeit aktiver Periode, Renewal und Reaktivierung als Constraints/Tests | **Blocker Datenmodell** |
| D-03 | Upgrade-Laufzeit, 48–49 | Upgrade nur nach verifizierter Zahlung | Ob `EXPIRES_AT` beim sofortigen Upgrade unverändert bleibt und wie Preis-/Laufzeitanteile verrechnet werden | Hoch |
| D-04 | Einladungen unter Locks, 22–24, 45, 49–50 | Volle Slots: Einladung erlaubt, Aktivierung gesperrt (LICENCE-004). Zahlungssperre: Einladung und Aktivierung gesperrt (LICENCE-028) | Verhalten in Downgrade-Grace, `SLOT_LIMIT_LOCKED` und geplantem Downgrade einzeln in Aktionsmatrix bestätigen | **Blocker Zugriffslogik** |
| D-05 | Clan- und Mitglied-Onboarding, 10–11, 20–24 | Clanmodule erst nach verifizierter Lizenz und abgeschlossenem Clan-Wizard; Logout verwirft Wizard-Entwurf; Verbindungsverlust erlaubt 30 Min. Wiederaufnahme | Mitglied-Onboarding-Status getrennt von Membershipstatus; Approval-ON/OFF, Einladungsgültigkeit und Resend-Limits entscheiden | Hoch |
| D-06 | Rollen/Leader-Transfer, 2, 9, 12–16, 30–33, 35–36 | Leader mit Plattformverwaltung, SupportAdmin nur auditiertes Recovery; keine freie Weiterdelegation | Vollständige Role×Permission×Scope-Matrix, konkrete Delegations- und Transferfreigaben, Einzigkeit Leader | **Blocker Autorisierung** |
| D-07 | Security-Reset, 7–8, 26–33 | MFA für privilegierte Rollen, Step-up, eine Session, Baseline nicht abschwächbar | `SECURITY_POLICY_RESET_TO_DEFAULT` separat auditieren; Ereignisschema, risikobasierte Challenges und Passwort-Reset-Freigaben konkretisieren | Hoch |
| D-08 | Inaktivität, 17–19 | 60-Minuten-Session-Idle ist beschlossen; keine Gleichsetzung mit Inaktivität des Clanmitglieds | Relevante vs. Hintergrundaktivität, Warnfrist, Auto-Lock, Entsperrung und Slotwirkung entscheiden | Hoch |
| D-09 | Clan-Settings/Visibility, 13–17 | Serverautorisierung, Clan-/Team-Scopes und Baseline gelten | Zehn feldbezogene Permissions, Links/Kontakte, PUBLIC/INTERNAL/HIDDEN und Datenschutzregeln ausarbeiten | Mittel |
| D-10 | Finanzen/Belege, 4–5 | Serververifizierte Zahlung, Korrekturbuchungen, Audit | Spende vs. Beitrag, PDF-Felder, Retention, Auszahlungs- und Bankdatenpermissions spezifizieren | Hoch |
| D-11 | Server, 6, 9 | Status/Join-Capabilities, 60-Sekunden-Poll, Secrets schützen | OFF-10: Dashboard zeigt Neustart/Backup, Fachstand verbietet Remote-Administration. Keine Remote-Steuerung ohne neuen Beschluss | Hoch |
| D-12 | Slots/Downgrade, 45–50 | STANDARD/TRIAL je 25 ACTIVE inkl. Leader; UNLIMITED unbegrenzt; 30-Tage-Grace, keine Löschung | Warnzeitpunkte, erlaubte Aktionen in Grace/Slot-Lock und Concurrency-Testmatrix präzisieren; historisches Beispiel „50 Slots“ nicht übernehmen | Hoch |
| D-13 | Refunds, 34–44 und Regelregister | Sieben-Regeln-Korrekturfassung enthält vollständige Refund-/Supporttexte | LICENCE-038–041, -054–056 gegen Beschlussprotokoll verifizieren und in freigegebene v1.0 überführen; keine Doppelzählung | **Dokumentenfreigabe** |
| D-14 | Dashboard, alle Bereiche | **OFF-11 ist später entschieden:** integriertes gemeinsames Dashboard, Clanmodule nach Lizenz und abgeschlossenem Setup | Veraltete „offen“-Aussagen in v0.9/v1.0/ADR/Requirements nach Freigabe korrigieren | Dokumentationskonflikt |

## 4. Sieben korrigierte Lizenzregeln – Quellenbefund
Die maßgebliche Datei `Pflichtenheft_v1.0(1).md` hat **sieben** Platzhalter (038, 039, 040, 041, 054, 055, 056), nicht acht. Die separat vorliegende Datei `Pflichtenheft_v1.0_nur_7_Regeln_korrigiert.md` enthält für alle sieben **konkrete Regeltexte**:
- **LICENCE-038** — HIGH-Zahlungsticket: Fehlt binnen drei Werktagen eine qualifizierte menschliche Erstreaktion, automatische Eskalation an die Plattformadministration und Benachrichtigung des Leaders über verifizierte Kanäle ohne vertrauliche Ticketdetails; Audit. Die Frist betrifft die Erstreaktion, nicht die Lösung.
- **LICENCE-039** — Für HIGH-Zahlungstickets ist innerhalb von sieben Werktagen eine abschließende Entscheidung vorgesehen. Bei Fristüberschreitung automatische Eskalation und Benachrichtigung des Leaders ohne vertrauliche Details; Audit.
- **LICENCE-040** — Bei Zahlungsproblemen verpflichtend im Dashboard und per E-Mail vor parallelen bzw. erneuten Zahlungsversuchen warnen; Versand und Anzeige auditieren.
- **LICENCE-041** — Jeder abgeschlossene Zahlungssupportfall erhält eine verpflichtende, datensparsame Ergebnis-/Abschlusszusammenfassung; Bereitstellung und Kenntnisnahme-/Bestätigungsstatus werden nachvollziehbar erfasst.
- **LICENCE-054** — Nach vom Zahlungsanbieter bestätigter vollständiger Rückerstattung die betroffene Lizenz automatisch einschränken; Clan-Daten erhalten, Lizenzverwaltung und Support weiter zugänglich lassen, keine automatische Löschung; Zustandswechsel auditieren.
- **LICENCE-055** — Eine bestätigte teilweise Rückerstattung verändert den Lizenzstatus nicht; Rückerstattung mit der Zahlung verknüpfen und auditieren. Bei Widersprüchen Supportfall im bestehenden Sachverhalts-Ticket eröffnen bzw. wiederaufnehmen; nur vollständige Rückerstattung löst LICENCE-054 aus.
- **LICENCE-056** — Bei technisch fehlgeschlagener oder unklarer Rückerstattung bleibt der Lizenzstatus unverändert, bis der Anbieter die Rückerstattung bestätigt. Automatisch einen HIGH-Supportfall im sachverhaltsbezogenen Ticket anlegen bzw. wiederöffnen; Leader sieht Status, Support wird benachrichtigt; Audit und Idempotenz verhindern doppelte Rückerstattungen und Lizenzübergänge.

**Prüfentscheidung:** „Text nicht auffindbar“ ist nach Sichtung der Korrekturfassung nicht mehr zutreffend. **Noch offen ist der formale Nachweis**, dass genau diese Texte die gemeinsam bestätigten Beschlüsse wiedergeben und als maßgebliche Fassung gelten. Der ursprüngliche v1.0-Prüfvermerk „48 vorhanden, acht offen“ ist rechnerisch falsch; in der unveränderten Originaldatei stehen 49 ausformulierte und sieben Platzhalter.

## 5. Dokumentübergreifende Korrekturliste (ohne Originaländerung)
| Dokument | Fundstelle | Problem / Korrekturvorschlag |
|---|---|---|
| `Pflichtenheft_v1.0(1).md` | Kopf, §3a, §10, §16, Regelregister | Versionskopf noch v0.9/Datum 13.11; OFF-11 fälschlich offen; frühere „Trial offen“-Aussage widerspricht sieben Tagen; sieben Platzhalter trotz separater Korrekturfassung |
| `REQUIREMENTS_v0.9(1).md` | REQ-UI-001, §10 | Leader-Navigation fälschlich offen; Trialdauer veraltet; Onboarding-Lizenzgate und Recovery ergänzen |
| `DECISIONS_v0.9(1).md` | ADR-015 / OFF-11 | Integriertes Dashboard als bestätigt nachführen; Rechtekontexte weiterhin getrennt |
| `ARCHITECTURE_v0.9(1).md` | Dashboard / Modulgrenzen | OFF-11 nachziehen; SUPPORT_TICKET und persistente Scheduler-/Recovery-Komponenten einordnen |
| `MILESTONES_v0.9(1).md` | M4, M6, M9 | Lizenzgate und Clan-Wizard sind Voraussetzungen für Clan-Onboarding; daher benötigte M9-Teile vorziehen; Perioden-/Jobmodelle in M4 ergänzen |
| `README_v0.9(2).md` | Dokumentationsliste | Verweis auf v0.8 als aktuelle Referenz überholt; v1.0/Korrekturfassung und Status benennen |
| `Pflichtenheft_v0.9(2).md` | §9 / §3a / OFF-11 | Historische Ausgangsfassung belassen, aber als überholt markieren; SERVER-Konflikt OFF-10 offen halten |

## 6. Abnahme- und Implementierungsfolgen
- **Alpha 0.1:** echter Identity-Login, geschütztes allgemeines Dashboard, Datenbankmigration, serverseitige Autorisierung, Tests. Keine Behauptung vollständiger Produktionsreife.
- **Vor Clan-Wizard und M6:** Lizenzkauf-Verifikation, Setup-State serverseitig, Logout-Verwerfen, 30-Minuten-Recovery ab tatsächlichem Verbindungsverlust und 60-Minuten-Session-Idle separat testen.
- **Vor Lizenz-Release:** Testfälle für 25./26. Aktivierung unter Parallelität, Trial→Paid, Renewal, Upgrade, Downgrade 73→25, Grace-Ende, kombinierte Payment-/Slot-Locks, Refunds, Job-Retries und Restore.
- **Vor privilegierten Aktionen:** Rollen-/Scope-Matrix, MFA/Step-up, Security-Audit inklusive Reset, SUPPORT_ADMIN-Recovery und Transfer mit unabhängiger Freigabe.
- **Vor Datenlöschung:** Recheck aller Bedingungen, verschlüsseltes und verifiziertes Backup, begrenzte Retention, Restore-Integritätsprüfung und idempotenter Scheduler.

## 7. Abschlussstatus
**Erledigt:** 50/50 eindeutige Whiteboard-Fotos in sechs Einzelprotokollen erfasst; zusammengeführte Bildmatrix und Entscheidungsregister vorhanden; die separate Fassung mit sieben korrigierten Regeln identifiziert.
**Nicht erledigt:** offene Fachentscheidungen D-01 bis D-13 verbindlich beschließen; formale Freigabe der sieben Regeltexte; vollständige feingranulare Regel-/Permission-Abnahmematrix; Aktualisierung der Originaldokumente nach ausdrücklicher Genehmigung.
**OFF-01:** Quellenabgleich dokumentiert, **fachliche Gesamtfreigabe noch offen**. Keine Originaldatei geändert.
