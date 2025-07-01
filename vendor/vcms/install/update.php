<?php
/*
This file is part of VCMS.

VCMS is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

VCMS is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with VCMS. If not, see <http://www.gnu.org/licenses/>.
*/

if(!is_object($libGlobal))
	exit();


function getColumns($table){
	global $libDb;

	$stmt = $libDb->prepare('SHOW COLUMNS FROM ' .$table);
	$stmt->execute();

	$result = array();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$result[] = $row['Field'];
	}

	return $result;
}

function getIndexes($table){
	global $libDb;

	$stmt = $libDb->prepare('SHOW INDEX FROM ' .$table);
	$stmt->execute();

	$result = array();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$result[] = $row['Key_name'];
	}

	return $result;
}

function renameStorageKey($moduleId, $oldArrayName, $newArrayName){
	global $libDb;

	$stmt = $libDb->prepare('UPDATE sys_genericstorage SET array_name=:new_array_name WHERE moduleid=:moduleid AND array_name=:old_array_name');
	$stmt->bindValue(':new_array_name', $newArrayName);
	$stmt->bindValue(':moduleid', $moduleId);
	$stmt->bindValue(':old_array_name', $oldArrayName);
	$stmt->execute();
}


/*
* Update base_veranstaltung
*/
$columnsBaseVeranstaltung = getColumns('base_veranstaltung');

if(!in_array('datum_ende', $columnsBaseVeranstaltung)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_veranstaltung';
	$libDb->query('ALTER TABLE base_veranstaltung ADD datum_ende DATETIME AFTER datum');
}

if(!in_array('fb_eventid', $columnsBaseVeranstaltung)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_veranstaltung';
	$libDb->query('ALTER TABLE base_veranstaltung ADD fb_eventid varchar(255)');
}

if(!in_array('intern', $columnsBaseVeranstaltung)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_veranstaltung';
	$libDb->query('ALTER TABLE base_veranstaltung ADD intern tinyint(1) NOT NULL default 0');
}

if(in_array('datum', $columnsBaseVeranstaltung)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_veranstaltung';
	$libDb->query("ALTER TABLE `base_veranstaltung` CHANGE `datum` `datum` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00'");
}


/*
* Update base_person
*/
$columnsBasePerson = getColumns('base_person');
$indexesBasePerson = getIndexes('base_person');

if(in_array('username', $indexesBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Index auf Tabelle base_person';
	$libDb->query('DROP INDEX username ON base_person');
}

if(!in_array('geburtsname', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD geburtsname varchar(255)');
}

if(in_array('austritt_grund', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person DROP austritt_grund');
}

if(in_array('password_salt', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person DROP password_salt');
}

if(in_array('icq', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person DROP icq');
}

if(in_array('msn', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person DROP msn');
}

if(in_array('jabber', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person DROP jabber');
}

if(in_array('vita_letzterautor', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person DROP vita_letzterautor');
}

if(in_array('username', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person DROP username');
}

if(!in_array('email', $indexesBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Index auf Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD UNIQUE email (email)');
}

if(!in_array('studium', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD studium varchar(255)');
}

if(!in_array('linkedin', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD linkedin varchar(255)');
}

if(!in_array('xing', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD xing varchar(255)');
}

if(!in_array('datenschutz_erklaerung_unterschrieben', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD datenschutz_erklaerung_unterschrieben tinyint(1) NOT NULL default 0');
}

if(!in_array('iban', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD iban varchar(255)');
}

if(!in_array('einzugsermaechtigung_erteilt', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD einzugsermaechtigung_erteilt tinyint(1) NOT NULL default 0');
}





if(!in_array('studium', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD studium varchar(255)');
}

if(!in_array('linkedin', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD linkedin varchar(255)');
}

if(!in_array('xing', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD xing varchar(255)');
}

if(!in_array('datenschutz_erklaerung_unterschrieben', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD datenschutz_erklaerung_unterschrieben tinyint(1) NOT NULL default 0');
}

if(!in_array('iban', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD iban varchar(255)');
}

if(!in_array('einzugsermaechtigung_erteilt', $columnsBasePerson)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_person';
	$libDb->query('ALTER TABLE base_person ADD einzugsermaechtigung_erteilt tinyint(1) NOT NULL default 0');
}





/*
* Update base_semester
*/
$columnsBaseSemester = getColumns('base_semester');

if(!in_array('vop', $columnsBaseSemester)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_semester';
	$libDb->query('ALTER TABLE base_semester ADD vop int(11)');
}

if(!in_array('vvop', $columnsBaseSemester)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_semester';
	$libDb->query('ALTER TABLE base_semester ADD vvop int(11)');
}

if(!in_array('vopxx', $columnsBaseSemester)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_semester';
	$libDb->query('ALTER TABLE base_semester ADD vopxx int(11)');
}

if(!in_array('vopxxx', $columnsBaseSemester)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_semester';
	$libDb->query('ALTER TABLE base_semester ADD vopxxx int(11)');
}

if(!in_array('vopxxxx', $columnsBaseSemester)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_semester';
	$libDb->query('ALTER TABLE base_semester ADD vopxxxx int(11)');
}

if(!in_array('datenpflegewart', $columnsBaseSemester)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle base_semester';
	$libDb->query('ALTER TABLE base_semester ADD datenpflegewart int(11)');
}


/*
* Update mod_chargierkalender_veranstaltung
*/
$columnsModChargierkalenderVeranstaltung = getColumns('mod_chargierkalender_veranstaltung');

if(in_array('datum', $columnsModChargierkalenderVeranstaltung)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle mod_chargierkalender_veranstaltung';
	$libDb->query("ALTER TABLE `mod_chargierkalender_veranstaltung` CHANGE `datum` `datum` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00'");
}


/*
* Update mod_internethome_nachricht
*/
$columnsModInternethomeNachricht = getColumns('mod_internethome_nachricht');

if(in_array('startdatum', $columnsModInternethomeNachricht)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle mod_internethome_nachricht';
	$libDb->query("ALTER TABLE `mod_internethome_nachricht` CHANGE `startdatum` `startdatum` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00'");
}

if(in_array('verfallsdatum', $columnsModInternethomeNachricht)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle mod_internethome_nachricht';
	$libDb->query("ALTER TABLE `mod_internethome_nachricht` CHANGE `verfallsdatum` `verfallsdatum` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00'");
}


/*
* Update mod_news_news
*/
$columnsModNewsNews = getColumns('mod_news_news');

if(in_array('eingabedatum', $columnsModNewsNews)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle mod_news_news';
	$libDb->query("ALTER TABLE `mod_news_news` CHANGE `eingabedatum` `eingabedatum` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00'");
}


/* Update mod_reservierung_reservierung
*/
$columnsModReservierungReservierung = getColumns('mod_reservierung_reservierung');

if(in_array('datum', $columnsModReservierungReservierung)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle mod_reservierung_reservierung';
	$libDb->query("ALTER TABLE `mod_reservierung_reservierung` CHANGE `datum` `datum` DATE NOT NULL DEFAULT '1970-01-01'");
}


/*
* Update sys_log_intranet
*/
$columnsSysLogIntranet = getColumns('sys_log_intranet');

if(in_array('datum', $columnsSysLogIntranet)){
	$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle sys_log_intranet';
	$libDb->query("ALTER TABLE `sys_log_intranet` CHANGE `datum` `datum` DATETIME NOT NULL DEFAULT '1970-01-01 00:00:00'");
}


/*
* Drop mod_forum_comment
*/
$libGlobal->notificationTexts[] = 'Entferne Tabelle mod_forum_comment';
$libDb->query('DROP TABLE IF EXISTS mod_forum_comment');


/*
* Drop mod_forum_thread
*/
$libGlobal->notificationTexts[] = 'Entferne Tabelle mod_forum_thread';
$libDb->query('DROP TABLE IF EXISTS mod_forum_thread');


/*
* Drop mod_kvnetz_autologin
*/
$libGlobal->notificationTexts[] = 'Entferne Tabelle mod_kvnetz_autologin';
$libDb->query('DROP TABLE IF EXISTS mod_kvnetz_autologin');


/*
* Drop mod_rpc_nachricht_empfangen
*/
$libGlobal->notificationTexts[] = 'Entferne Tabelle mod_rpc_nachricht_empfangen';
$libDb->query('DROP TABLE IF EXISTS mod_rpc_nachricht_empfangen');


/*
* Drop mod_rpc_nachricht_versendet
*/
$libGlobal->notificationTexts[] = 'Entferne Tabelle mod_rpc_nachricht_versendet';
$libDb->query('DROP TABLE IF EXISTS mod_rpc_nachricht_versendet');


/*
* Drop mod_rpc_verbindungen
*/
$libGlobal->notificationTexts[] = 'Entferne Tabelle mod_rpc_verbindungen';
$libDb->query('DROP TABLE IF EXISTS mod_rpc_verbindungen');


/*
* Update base_semester
*/
$libGlobal->notificationTexts[] = 'Aktualisiere Tabelle sys_genericstorage';

renameStorageKey('base_core', 'brandXs', 'brand_xs');
renameStorageKey('base_core', 'deleteAusgetretene', 'delete_ausgetretene');
renameStorageKey('base_core', 'eventBannedTitles', 'event_banned_titles');
renameStorageKey('base_core', 'eventGalleryMaxPublicSemesters', 'event_public_gallery_semesters');
renameStorageKey('base_core', 'eventPreselectIntern', 'event_preselect_intern');
renameStorageKey('base_core', 'fbAppId', 'facebook_appid');
renameStorageKey('base_core', 'fbSecretKey', 'facebook_secret_key');
renameStorageKey('base_core', 'imagemanipulator', 'image_lib');
renameStorageKey('base_core', 'siteUrl', 'site_url');
renameStorageKey('base_core', 'smtpHost', 'smtp_host');
renameStorageKey('base_core', 'smtpPassword', 'smtp_password');
renameStorageKey('base_core', 'smtpUsername', 'smtp_username');

renameStorageKey('base_internet_login', 'sslProxyUrl', 'ssl_proxy_url');

renameStorageKey('base_intranet_home', 'checkFilePermissions', 'check_file_permissions');
renameStorageKey('base_intranet_home', 'passwordICalendar', 'icalendar_password');
renameStorageKey('base_intranet_home', 'userNameICalendar', 'icalendar_username');
renameStorageKey('base_intranet_home', 'showReservations', 'show_reservations');

renameStorageKey('base_intranet_personen', 'showGroupY', 'show_group_y');

renameStorageKey('mod_internet_home', 'fb_url', 'facebook_url');
renameStorageKey('mod_internet_home', 'wp_url', 'wikipedia_url');
renameStorageKey('mod_internet_home', 'showFbPagePlugin', 'show_facebook_plugin');

renameStorageKey('mod_internet_kontakt', 'showHaftungshinweis', 'show_haftungshinweis');
renameStorageKey('mod_internet_kontakt', 'showSenior', 'show_senior');
renameStorageKey('mod_internet_kontakt', 'showJubelsenior', 'show_jubelsenior');
renameStorageKey('mod_internet_kontakt', 'showConsenior', 'show_consenior');
renameStorageKey('mod_internet_kontakt', 'showFuchsmajor', 'show_fuchsmajor');
renameStorageKey('mod_internet_kontakt', 'showFuchsmajor2', 'show_fuchsmajor2');
renameStorageKey('mod_internet_kontakt', 'showQuaestor', 'show_quaestor');
renameStorageKey('mod_internet_kontakt', 'showScriptor', 'show_scriptor');

renameStorageKey('mod_intranet_download', 'rightsPreselection', 'preselect_rights');

renameStorageKey('mod_intranet_rundbrief', 'preselectInteressierteAHAH', 'preselect_int_ahah');
