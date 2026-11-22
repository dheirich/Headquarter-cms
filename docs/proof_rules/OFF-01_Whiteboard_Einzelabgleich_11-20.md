# OFF-01 – Whiteboard-Einzelabgleich 11–20
Stand: 15.11.2026. Originalfotos visuell geprüft; Quervergleich mit Pflichtenheft v1.0, REQUIREMENTS v0.9, MILESTONES v0.9 und beschlossenen Onboarding-Regeln. **Originaldateien unverändert.** „Fehlt“ bedeutet nicht ausdrücklich spezifiziert, nicht automatisch fachlich verworfen.

## 11 – IMG_4385.HEIC – Account, Verifikation, Mitgliedschaft
**Whiteboard:** Datenmodelle `PLATFORM_ACCOUNT` (account_id, username, email, email_verified, account_status, created_at, updated_at), `EMAIL_VERIFICATION` (account_id, verification_token_hash, created_at, expires_at, verified_at, status), `CLAN_MEMBERSHIP` (account_id, clan_id, member_status [durchgestrichen], created_by, approved_by, joined_at, status), `CLAN_INVITATION` (clan_id, email/account_id, invited_by, created_at, expires_at, accepted_at, status), `CLAN_MEMBERSHIP_REQUEST` (clan_id, account_id, requested_by, requested_by_role, approved_by/at, rejected_by/at, status), `NEWSLETTER_SUBSCRIPTION` (account_id/email, subscribed_at, confirmed_at, unsubscribed_at, status). Accountstatus: PENDING_EMAIL_VERIFICATION, ACTIVE, LOCKED, SUSPENDED, DEACTIVATED. Mitgliedschaft: INVITED, PENDING_APPROVAL, ACTIVE, REJECTED, LEFT, REMOVED.
**Abgleich:** Pflichtenheft §§3a,5 und REQUIREMENTS §5 übernehmen Trennung und Status; das konkrete ER-Modell, Tokenhash, Einladungs-/Antrags- und Newsletterfelder sind nicht vollständig formalisiert. Die durchgestrichene Doppelung `member_status` ist nicht als zusätzliches Pflichtfeld zu übernehmen.
**Befund:** TEILWEISE; ER-Spezifikation/Constraints nötig. Eine ACTIVE-Mitgliedschaft je Account durchsetzen.

## 12 – IMG_4388.HEIC – Rollen- und Rechte-Trennung
**Whiteboard:** Plattformrolle SUPPORT_ADMIN (Recovery/Support, sensibler Zugriff, MFA/Step-up, Audit); Clanrollen CLAN_ADMIN/LEADER, SUBLEADER, TEAM_LEADER, MODERATOR, MEMBER. `PLATTFORM ≠ CLAN_MEMBERSHIP ≠ ROLE ≠ LICENCE`.
**Abgleich:** Pflichtenheft §§3a,4,5 und REQUIREMENTS §4 explizit abgedeckt. Späteres Modell differenziert zusätzlich PERMISSION/SCOPE/POLICY.
**Befund:** ÜBERNOMMEN; vollständige Delegationsmatrix OFF-02 weiterhin offen.

## 13 – IMG_4389.HEIC – Clan-Stammdaten
**Whiteboard:** Clanname, Tag, Logo, Gründungsdatum, Beschreibung, Country/Region (konkrete Länder oder international), Sprache, Zeitzone, Website, Erscheinungsbild Dark/Light. Für Stammdatenänderungen Step-up, nur ClanAdmin oder Subleader; sämtliche Änderungen auditieren.
**Abgleich:** Pflichtenheft §§3a,4,5,6 nennt Clan-Settings/Step-up/Audit allgemein; **konkreter Feldkatalog und feldbezogene Berechtigung fehlen**.
**Befund:** TEILWEISE. Präzisieren, welche Felder Step-up erfordern (Whiteboard-Pfeil auf Stammdatenblock, nicht eindeutig auf alle Anzeigeoptionen).

## 14 – IMG_4390.HEIC – 10 CLAN_SETTINGS-Permissions
**Whiteboard:** `CLAN_NAME_UPDATE`, `CLAN_TAG_UPDATE`, `CLAN_LOGO_UPDATE`, `CLAN_FOUNDING_DATE_UPDATE`, `CLAN_DESCRIPTION_UPDATE`, `CLAN_REGION_UPDATE`, `CLAN_LANGUAGE_UPDATE`, `CLAN_TIMEZONE_UPDATE`, `CLAN_WEBSITE_UPDATE`, `CLAN_THEME_UPDATE`; dazu `CLAN_SETTINGS_READ` für alle Clanmitglieder. ClanAdmin alle Änderungen, Subleader nur explizit delegierte Permissions; TeamLeader/Moderator/Member keine globalen Clan-Settings-Änderungsrechte. Step-up für rot markierten Stammdatenblock.
**Abgleich:** Pflichtenheft §4 und §5 regeln Delegation/Step-up grundsätzlich, konkrete zehn Permissions und Matrix fehlen.
**Befund:** TEILWEISE; OFF-02. Kein pauschales Update-Recht für Subleader ableiten.

## 15 – IMG_4391.HEIC – Theme, Links, Kontakt
**Whiteboard:** `CLAN_THEME` (primary_color, secondary_color, accent_color, default_theme LIGHT/DARK/SYSTEM; Leader entscheidet; Farbe nur UI, nicht Content). `USER_THEME_PREFERENCE` LIGHT/DARK durch User selbst. `CLAN_THEME_UPDATE` ClanAdmin erlaubt, Subleader delegiert, übrige nicht; laut Bild **kein Step-up nötig**, aber Standardaudit. `CLAN_LINKS` (Website, Discord, YouTube, Twitch, Instagram, TikTok, X, Facebook, Steam Group, Others); `CLAN_CONTACT` (contact_email, contact_person_name, contact_role, contact_note; optional Teamspeak-Adresse/Discord-Invite); `CLAN_LINKS_READ/UPDATE`, `CLAN_CONTACT_READ/UPDATE`. Leader alles, Subleader explizit, übrige keine globalen Änderungen.
**Abgleich:** Pflichtenheft §§3a,4,5, Dashboard-Profile erwähnt Design, aber Datenmodell, getrennte Lese-/Schreibrechte, Links und Kontakt fehlen.
**Befund:** TEILWEISE. Theme-Änderung ohne Step-up ist **kein Widerspruch** zur Step-up-Pflicht für sensible Stammdaten, wenn Feldgruppen getrennt werden.

## 16 – IMG_4392.HEIC – Clan-Sichtbarkeit
**Whiteboard:** `CLAN_VISIBILITY` je Clanname, Tag, Logo, Gründungsdatum, Beschreibung, Country/Region, Website, Social Links, Kontakt-E-Mail, Member-Roster, Team-List, Server-List. Zustände PUBLIC, INTERNAL, HIDDEN; Leader/Subleader steuern. `CLAN_VISIBILITY_READ`, `CLAN_VISIBILITY_UPDATE`; sensible Daten nur mit Freigabe durch ClanAdmin bzw. berechtigten Subleader.
**Abgleich:** Pflichtenheft §§3a,4,7,9 erwähnt Sichtbarkeit/Scopes, aber **kein feldweises Sichtbarkeitsmodell**.
**Befund:** FEHLT IN DETAIL. PUBLIC nicht mit internen Server-Secrets oder Mitgliederdaten gleichsetzen; datenschutzrechtliche Einschränkungen sind zusätzlich erforderlich.

## 17 – IMG_4394.HEIC – Allgemeine Clan-Policies
**Whiteboard:** `MEMBER_MFA_POLICY` OPTIONAL/REQUIRED; `DEFAULT_PROFILE_VISIBILITY` PUBLIC/INTERNAL/HIDDEN; `DEFAULT_MEMBER_LANGUAGE` CLAN_DEFAULT/USER_CHOICE; `MEMBER_DISPLAY_NAME_CHANGE` und `MEMBER_AVATAR_CHANGE` ALLOWED/APPROVAL_REQUIRED/DISABLED. `INACTIVE_MEMBER_POLICIES` DISABLED/WARN_ONLY/AUTO_LOCK; `INACTIVE_MEMBER_DAYS` konfigurierbar, manuelle Freigabe möglich; `locked_by_clan_admin`, `locked_by_inactivity`. Inaktivitätswarnung per E-Mail/Notification vor Sperre, im Bild „10 Tage vorher“ als Vorschlag; `INACTIVITY_WARNING_DAYS_BEFORE` skizziert. Hinweis: Clan-Settings sind allgemeine Policies, keine Konfiguration aller Module.
**Abgleich:** Pflichtenheft §5 übernimmt MEMBER_MFA_POLICY, aber Profil-/Sprach-/Namens-/Avatar- und Inaktivitätsrichtlinien fehlen.
**Befund:** TEILWEISE; Warnfrist „10 Tage“ noch nicht als endgültiger Beschluss übernehmen. Datenschutz, legitime Accountaktivität und Reaktivierung spezifizieren.

## 18 – IMG_4395.HEIC – Relevante Aktivität
**Whiteboard:** `LAST_MEMBER_ACTIVITY_AT` als Referenz für Inaktivitätsregel. Relevante Events: SUCCESSFUL_LOGIN, FORUM_THREAD_CREATED, FORUM_POST_CREATED, CHAT_MESSAGE_SEND, PROFILE_UPDATED, TEAM_ACTION_PERFORMED, CONTENT_CREATED_OR_EDITED, WARPLANNER_ACTION, FINANCE_ACTION, SERVER_JOIN_ACTION. Beispiel letzte Aktivität 01.03.26, Fristablauf 05.03.26; Warnung per E-Mail/SMS/Notification, Standard E-Mail, Kanäle in User-Settings.
**Abgleich:** Pflichtenheft §5/§11 und REQUIREMENTS §5/§11 haben allgemeine Benachrichtigungen/Audit, **keinen Activity-Event-Katalog oder Auto-Lock-Mechanismus**.
**Befund:** FEHLT IN DETAIL; Event-Zeitstempel nur nach autorisierten, nachweisbaren Benutzeraktionen aktualisieren.

## 19 – IMG_4396.HEIC – Nicht zählende Aktivität
**Whiteboard:** Nicht zählen: BACKGROUND_JOBS, SERVER_POLLING, NOTIFICATION_SENT, EMAIL_SENT, SYSTEM_GENERATED_EVENT, TOKEN_REFRESH, SESSION_KEEP_ALIVE, PAGE_AUTO_REFRESH, API_BACKGROUND_REQUEST, AUTH_ACTION_ON_USER. `INACTIVITY_REFERENCE = max(last_successful_login_at, last_relevant_member_activity_at)`. Wenn Referenz älter als Schwellwert, AUTO_LOCK_INACTIVITY; Warnung `INACTIVITY_WARNING_DAYS_BEFORE`.
**Abgleich:** In REQUIREMENTS/Pflichtenheft nicht als Regel/Algorithmus ausgeführt.
**Befund:** FEHLT. Besonders wichtig: technische Hintergrundsignale dürfen die Inaktivität nicht künstlich zurücksetzen; Zeitzonen, Grenzzeitpunkt, Concurrency, Aufhebung einer Sperre und Unterschiede zu Lizenzslot/Account-Lock klären.

## 20 – IMG_4397.HEIC – Mitglied-Onboarding-Zustandsmaschine
**Whiteboard:** `MEMBER_ONBOARDING_STATUS`: OPEN (Mitglied angelegt/Prozess begonnen), INVITED (Einladung versandt), INVITED_ACCEPTED (angenommen), PENDING_APPROVAL (wartet auf ClanAdmin/berechtigten Subleader), COMPLETED (vollständig hinzugefügt), REJECTED (abgelehnt), CANCELLED (Aufnahme abgebrochen), REMOVED (später aus Clan entfernt). Beispielpfad OPEN→INVITED→INVITED_ACCEPTED→PENDING_APPROVAL→COMPLETED; Ablehnungs- und Entfernungszweige. Status nur intern, nicht auf öffentlicher clanhq.org-Plattform.
**Abgleich:** Pflichtenheft §5 und REQUIREMENTS §5 beschreiben INVITED→Annahme→PENDING_APPROVAL→ACTIVE sowie REJECTED/LEFT/REMOVED. **Wichtige Modellunterscheidung:** Onboarding-Prozessstatus `COMPLETED` ist nicht zwingend dasselbe wie Membershipstatus `ACTIVE`. `OPEN`, `INVITED_ACCEPTED`, `CANCELLED`, `COMPLETED` fehlen als eigene Onboardingstatuswerte.
**Befund:** TEILWEISE, potenzielle Modellvermischung; expliziten Workflow und Statusmapping spezifizieren. Nicht mit dem separaten Clan-Gründungs-Wizard verwechseln.

## Querschnittliche Entscheidungen zur späteren Freigabe
1. OFF-02: zehn Stammdaten-Permissions, Links/Kontakt, Visibility und Theme; Delegationsgrenzen und Step-up je Aktion.
2. OFF-05/06/07: Inaktivität ist eigenständige Sperrursache, nicht gleich Lizenzstatus, Session-Idle-Timeout oder automatisch eine frei werdende ACTIVE-Mitgliedschaft. Wirkung auf Slots muss beschlossen werden.
3. Mitglied-Onboarding: Prozessstatus und Membershipstatus als getrennte Konzepte modellieren; Übergänge, Einladungsablauf und Genehmigungen testen.
4. Datenmodell: Account/Invitation/Membership/Request/Newsletter, Clan-Settings, Links, Kontakte, Sichtbarkeiten, Policies, Inaktivitäts-Zeitstempel und Sperrursachen ergänzen.
5. Keine Originaldokumente geändert; alle Befunde sind **Abgleich**, nicht automatische Freigabe.
