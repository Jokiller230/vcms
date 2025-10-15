<?php
class LibConfig {
	public string $mysqlServer = '127.0.0.1';
	public string $mysqlUser = 'username';
	public string $mysqlPass = 'password';
	public string $mysqlDb = 'datenbankname';
	public string $mysqlPort = '';

	public string $verbindungName = 'K.St.V. Example';
	public string $verbindungDachverband = 'KV';

	public string $verbindungZusatz = '';
	public string $verbindungStrasse = 'Musterstr. 20';
	public string $verbindungPlz = '12345';
	public string $verbindungOrt = 'Musterstadt';
	public string $verbindungLand = '';
	public string $verbindungTelefon = '+49 251 123456789';

	public string $seiteBeschreibung = 'Katholischer Studentenverein Example im Kartellverband katholischer deutscher Studentenvereine (KV) zu Münster (Westf.)';
	public string $seiteKeywords = 'Studentenverbindung, Universität, Verbindung, Studentenverein, Student';
	public string $emailInfo = 'kontakt@example.net';
	public string $emailWebmaster = 'webmaster@example.net';

	public string $chargenSenior = 'x';
	public string $chargenJubelSenior = 'x';
	public string $chargenConsenior = 'vx';
	public string $chargenScriptor = 'xx';
	public string $chargenQuaestor = 'xxx';
	public string $chargenFuchsmajor = 'FM';
	public string $chargenFuchsmajor2 = 'FM 2';
	public string $chargenAHVSenior = 'AH-x';
	public string $chargenAHVConsenior = 'AH-vx';
	public string $chargenAHVKeilbeauftragter = 'K';
	public string $chargenAHVScriptor = 'AH-xx';
	public string $chargenAHVQuaestor = 'AH-xxx';
	public string $chargenHVVorsitzender = '';
	public string $chargenHVKassierer = '';
	public string $chargenArchivar = '';
	public string $chargenRedaktionswart = 'Red.';
	public string $chargenVOP = 'VOP';
	public string $chargenVVOP = 'VVOP';
	public string $chargenVOPxx = 'VOPxx';
	public string $chargenVOPxxx = 'VOPxxx';
	public string $chargenVOPxxxx = 'VOPxxxx';

	/**
	* Zeitzone, normalerweise unverändert
	* Valide Werte unter http://www.php.net/manual/de/timezones.php
	*/
	public string $timezone = 'Europe/Berlin';

	/**
	* optionale Anpassungen
	*/
	public string $defaultHome = 'home';

	/*
	* Standardmäßig liegt das Wintersemester im System von Oktober bis März und das Sommersemester von April bis Oktober.
	* Normalerweise sind Anpassungen nicht nötig, sodass die weitere Beschreibung nur für folgenden Spezialfälle gilt:
	* NUR FALLS SEMESTER IN ANDEREN MONATEN LIEGEN SOLLEN ODER ANDERE SEMESTER ALS WS & SS GEWÜNSCHT SIND,
	* kann durch Entfernen der folgenden // konfiguriert werden, welche Semester in welchen Monaten liegen:
	*
	* Im Beispiel liegt seit dem Jahr 0 das Sommersemester (SS) von Monat 4 (April) bis Monat 9 (September) und
	* das Wintersemester (WS) von Monat 10 (Oktober) bis Monat 3 (März), sowie seit dem Jahr 2008 der first term (FT)
	* von Monat 1 (Januar) bis Monat 6 (Juni) und der second term (ST) von Monat 7 (Juli) bis Monat 12 (Dezember).
	*
	* Das Beispiel kann abgeändert werden: Weitere Jahre können hinzugefügt werden;
	* Semesterpräfixe (SS, WS, FT, ST, ...) können geändert werden, dürfen aber nur aus GENAU 2 Zeichen aus a-z und A-Z
	* bestehen. Jedes Jahr muss zudem GENAU 12 Monate bzw. 12 Semesterpräfixe enthalten! Das Jahr 0 muss vorhanden sein.
	*/
	//public string $semestersConfig = array(
	//	0 		=> array('WS', 'WS', 'WS', 'SS', 'SS', 'SS', 'SS', 'SS', 'SS', 'WS', 'WS', 'WS'),
	//	2008 	=> array('FT', 'FT', 'FT', 'FT', 'FT', 'FT', 'ST', 'ST', 'ST', 'ST', 'ST', 'ST')
	//);
}
