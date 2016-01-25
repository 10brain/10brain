<?php
	/***************************************************************************************************
	 * 
	 * 
	 * 
	/***************************************************************************************************/
	
	/* 参照ライブラリ */
	/* 定数 */
	define("CONNECTSTR", "dbname=10baton user=root password=root");
	define("HTML_CODE", "UTF-8");
	define("KEY", "HxziiL1KOH3pRMnXR3WmwL3AtiCEghPOAYUeGYfx6ZF1z66Nh3iniWYohaaDppHk");
	/* 変数 */
	
	/* 関数 */
	/************************************************************
	 *引数$fields・$valuesに対し、$field・$valueを追記する
	 * 引数 : $fields   : フィールド名集合
	 *      : $values   : フィールド値集合
	 *      : $field    : 追加するフィールド名
	 *      : $value    : 追加するフィールド値
	 *      : $isString : 値へのsingle quote付加フラグ
	 * 戻値 : 無し
	 ************************************************************/
	function makeSqlParams(&$fields, &$values, $field, $value, $isString = false) {
		if ($field != "") {
			addString(&$fields, pg_escape_string($field), ",");
			if ($isString == true) {
				addString(&$values, "'".pg_escape_string(html_entity_decode($value, ENT_QUOTES))."'", ",", true);
			} else {
				addString(&$values, pg_escape_string(html_entity_decode($value, ENT_QUOTES)), ",", true);
			}
		}
	}
?>
