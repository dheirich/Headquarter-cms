# OFF-01 – Einzelabgleich Whiteboards 6–10
Stand: 15.11.2026. Originalbilder visuell geprüft. Keine Ursprungsdokumente geändert.

## 06 – IMG_4377.HEIC – SERVER
**Bildbeleg:** Game-Server: Status, Servername, Spiel, Adresse/IP, Current Map, Spieleranzahl, Spielerliste (sofern API verfügbar), Join-Button. Voice-Server: Status, Servername, Adresse/IP, Online-User, Channel Overview, User pro Channel, Join-Button. Dedizierte Server-APIs mit unterschiedlichen Capabilities: CS2 Status/Player Count/Player List/Current Map/Join; Voice Status/User List/Channel List/Join; andere Server entsprechend API. Scope: CLAN.
**Abgleich:** Pflichtenheft v1.0 §9 und REQUIREMENTS §9 enthalten die Capability-Liste, 60-Sekunden-Polling, Join und Clan-Sichtbarkeit. Details der Felder/Capability-abhängigen Darstellung fehlen.
**Status:** T. Das Bild belegt Status/Join, keine Remote-Neustarts; OFF-10 bleibt getrennt offen.

## 07 – IMG_4381.HEIC – SECURITY-Datenmodell
**Bildbeleg:** Device-ID, Browser, OS, IP, Uhrzeit; IP-Ausland → Prüfungsmail an Admin → Freigabe. Skizzierte Tabellen: AuthCredentials (UserID, PasswordHash, Änderungszeit, CredentialUpdated, AccountLocked, LockedUntil); MFAConfiguration (UserID, Enabled, Typ Authenticator/Email/SMS, verschlüsseltes Secret, Aktivierungs- und Verifizierungszeit); RecoveryCode (nur Hash, Ausgabe-/Nutzungszeit); PasswordResetRequest (Token-Hash, Requested/Expires, Attempts, ApprovedBy/At, Status REQUESTED/APPROVED/VERIFIED/COMPLETED/EXPIRED/LOCKED); LoginAttempt; UserSession (SessionID, DeviceID, IP, Created/LastActivity/Expires/Terminated, Reason, Active); UserDevice; LoginHistory; LoginSecurityChallenge; StepUpAuthentication (UserID, SessionID, Purpose, Requested/Verified/Expires, Method, Successful). Hinweis: eine Session pro Account; Reset mit Admin-/Subleaderfreigabe, Einmallink, neue Passwort-Session beendet; 3 Versuche → 15-Minuten-Cooldown.
**Abgleich:** Pflichtenheft §§5,12,15 und REQUIREMENTS §§5,12 enthalten Sicherheitsbaseline, MFA, Session, Reset und Audit; konkrete Tabellen-/Feldmodelle und vollständiger Reset-Freigabefluss fehlen. E-Mail/SMS als MFA-Methode ist historische Skizze, nicht automatisch freigegebene technische Empfehlung.
**Status:** T / K-Prüfpunkt: Admin-/Subleader-Freigabe des Passwort-Resets und Auslands-IP-Prozess müssen gegen moderne Sicherheits-/Datenschutzanforderungen sowie spätere Entscheidungen geprüft werden. Nicht blind übernehmen.

## 08 – IMG_4382.HEIC – RISK SIGNAL & SECURITY AUDIT
**Bildbeleg:** Erkennung neuer Geräte und auffälliger Logins; Security-Mail, MFA-/E-Mail-Bestätigung, Login freigeben oder ablehnen. Nicht jeder Gerätewechsel erzwingt eine Challenge; Risikobewertung u.a. anhand Land/Standort. Audit-Events: LOGIN_SUCCESS, LOGIN_FAILED, NEW_DEVICE_LOGIN, SUSPICIOUS_LOCATION_LOGIN, PASSWORD_RESET_REQUESTED, PASSWORD_RESET_COMPLETED, MFA_ENABLED, MFA_DISABLED, RECOVERY_CODE_USED, SESSION_TERMINATED, STEP_UP_SUCCESS, STEP_UP_FAILED.
**Abgleich:** Pflichtenheft §§5,11 und REQUIREMENTS §5 definieren Risikoerkennung, Pflichtwarnungen, Step-up und Audit, aber keinen vollständigen Ereigniskatalog, keine Risk-Signal-Entscheidungslogik und keine Freigabe-/Ablehnungs-Zustandsmaschine.
**Status:** T. Wichtig: Bild fordert risikobasierte statt pauschal bei jedem Gerätewechsel ausgelöste Challenge; Abgleich mit Default NEW_DEVICE_ADDITIONAL_CHALLENGE=ON erforderlich, ohne Baseline abzuschwächen.

## 09 – IMG_4383.HEIC – SERVER-PERMISSIONS
**Bildbeleg:** ClanMember, TeamLeader, Moderator und Subleader haben SERVER_READ, SERVER_JOIN. Subleader zusätzlich evtl. Verwaltungsrechte. Nur ClanLeader und Subleader dürfen Server hinzufügen/API nutzen (wörtliche Whiteboard-Aussage); Server-DB-Rechte: SERVER_READ, SERVER_JOIN, SERVER_CREATE, SERVER_UPDATE, SERVER_DELETE, SERVER_CREDENTIAL_MANAGEMENT, SERVER_API_KEY_MANAGEMENT, SERVER_STATUS_REFRESH. API-Keys nie Klartext; Audit nur, wer ein Secret geändert hat; Aktualisierung im 60-Sekunden-Intervall via Polling/Scheduling.
**Abgleich:** Pflichtenheft §9 und REQUIREMENTS §9 erwähnen separate Berechtigungen, Secrets und Polling, nicht aber vollständige Matrix. „Nur Leader und Subleader“ ist mit frei delegierbaren Scopes/Permissions abzugleichen.
**Status:** T / K-Prüfpunkt OFF-02: Rolle versus konkrete Permission und Subleader-Delegationsgrenze festlegen. Kein Beleg für Remote-Neustart.

## 10 – IMG_4384.HEIC – PLATTFORMACCOUNT
**Bildbeleg:** Normaler Benutzer darf Newsletter abonnieren und öffentliche Foren nutzen. Zukünftiger Clanleader darf Lizenz erwerben und eigenen Clan aufbauen. Beitritt zu bestehendem Clan ist über clanhq.org nicht möglich.
**Abgleich:** Pflichtenheft v1.0 §§1,3a,5 und REQUIREMENTS §§1,5 beschreiben Trennung Account/Clanmitgliedschaft, öffentliche Foren/Newsletter und kein Self-Join. Neuere beschlossene Clan-Gründung: erst verifizierter Lizenzerwerb, dann vollständig abgeschlossener Wizard; 30-Minuten-Recovery bei Verbindungsabbruch, expliziter Logout verwirft Entwurf.
**Status:** V für die hier sichtbaren Grundsätze; spätere Onboarding-Konkretisierung ist ergänzend und nicht widersprüchlich.

## Querschnitt
- 06/09 zusammen: SERVER ist API-/Capability-basierte Status-/Join-Integration; Mock-up-Konflikt zu Remote-Administration bleibt OFF-10.
- 07/08: SECURITY-Datenmodell und Eventkatalog müssen spezifiziert werden, bevor man Implementierung als abgeschlossen bewertet.
- 10: Bestehender Clanbeitritt nicht über die Plattform; Aufnahme erfolgt clan-intern via Einladung/Freigabe.
- Keine fachlichen Entscheidungen stillschweigend überschrieben; keine Originaldokumente verändert.
