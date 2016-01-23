<?
define("DBNAME","10brain");
define("USERNAME","root");
define("PASSWORD","root");

define("MIDASIFONTSIZE1","7");
define("MIDASIFONTSIZE2","6");
define("MIDASIFONTSIZE3","5");
define("MIDASIFONTSIZE4","4");
define("MIDASIFONTSIZE5","3");

define("BODYIFONT1","5");
define("BODYIFONT2","4");
define("BODYIFONT3","3");
define("BODYIFONT4","2");
define("BODYIFONT5","1");

define("PAGEBACKCOL1","#CCFFFF");
define("PAGEBACKCOL2","#FFFFCC");
define("PAGEBACKCOL3","#FFCCFF");
define("PAGEBACKCOL4","#CCFFCC");

//******************************************************************************
//*	関数名	：SetConnection
//*	引数	：	$DBName				in	データベース名
//*			$UserID				in	データベースに接続するUserのID
//*			$Password			in	データベースに接続するUserのパスワード
//*			$DBConnectID		out	接続ID
//*
//*	説明	：	データベースの接続IDを作成する。
//*				1度作成されている場合は再利用する。
//******************************************************************************
Function SetConnection($DBName, $UserID, $Password, $DBConnectID) {

	if ($DBConnectID == Null) {
		$DBConnectID = pg_connect("dbname=". $DBName. " user=". $UserID);
	}
	return $DBConnectID;

}

//******************************************************************************
//*	関数名	：IncSaibanTBL
//*	引数	：	$ConID
//*				$TblCorde
//*
//*	説明	：
//******************************************************************************
Function IncSaibanTBL($ConID, $TblCorde) {

	$YYYYMM = date("Ym");
//******************************************************************************
//*	関数名	：SelectUMU
//*	引数	：	$nUmuCode			in
//*
//*	説明	：
//******************************************************************************
Function SelectUMU($nUmuCode) {

	if ($nUmuCode) {
		return "有";
	} else {
		return "無";
	}

}

//******************************************************************************
//*	関数名	：SelectKaHi
//*	引数	：	$nKaHiCode			in
//*
//*	説明	：
//******************************************************************************
Function SelectKaHi($nKaHiCode) {

	if ($nKaHiCode) {
		return "可";
	} else {
		return "否";
	}

}
//******************************************************************************
//*	関数名	：GetFieldData
//*	引数	：	$recData			in
//*				$FName				in
//*
//*	説明	：
//******************************************************************************
Function GetFieldData($recData, $FName) {

	if (count($recData) > 0) {
		if (next($recData) == false) {
			return "";
		} else {
			reset($recData);
			return $recData[$FName];
		}
	}

}

//******************************************************************************
//*	関数名	：CheckSex
//*	引数	：	$recData			in
//*				$FName				in
//*				$nSexCode			in
//*
//*	説明	：
//******************************************************************************
Function CheckSex($recData, $FName, $nSexCode) {
	
	if (GetFieldData($recData, $FName) == $nSexCode) {
		return "CHECKED";
	}

}

//******************************************************************************
//*	関数名	：SelectedText
//*	引数	：	$recData			in
//*				$FName				in
//*				$Prefec				in
//*
//*	説明	：
//******************************************************************************
Function SelectedText($recData, $FName, $Prefec) {

	if (GetFieldData($recData, $FName) == $Prefec) {
		return "SELECTED";
	}

}

?>
