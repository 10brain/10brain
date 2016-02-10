<?php
	/****************************************************************************
	 * 妥当性チェック用アプリケーションクラス
	 *
	 * isZip         郵便番号チェック
	 * isPhone       電話番号チェック
	 * isMail        メールアドレスチェック
	 * isURL         URLチェック
	 * isDate        日付チェック(Y/m/d)
	 * isString      文字列書式チェック
	 * isNumeric     数値チェック
	 * isMatch       文字列書式チェック(正規表現)
	 * isSW_Digit    文字列書式チェック(半角数字)
	 * isDW_Hiragana 文字列書式チェック(全角ひらがな)
	 * isDW_Katakana 文字列書式チェック(全角カタカナ)
	 ****************************************************************************/
	//正規表現定義
	define("VALIDATION_ZIP",         "/^\d{3}\-\d{4}$/");
	define("VALIDATION_PHONE",       "/^0\d{1,4}-\d{1,4}-\d{4}$/");
	define("VALIDATION_PHONE_NO",    "/^0\d{8,10}$/");
	define("VALIDATION_MAIL",        "/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/");
	define("VALIDATION_URL",         "/^(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/");
	define("VALIDATION_DATE",        "/^\d{4}\/\d{1,2}\/\d{1,2}$/");
	define("VALIDATION_SW_SPACE",    "[ ]");               // 半角スペース
	define("VALIDATION_SW_DIGIT",    "[0-9]");             // 半角数字
	define("VALIDATION_SW_ULETTER",  "[A-Z]");             // 半角英字(大)
	define("VALIDATION_SW_LLETTER",  "[a-z]");             // 半角英字(小)
	define("VALIDATION_DW_SPACE",    "[　]");              // 全角スペース
	define("VALIDATION_DW_HIRAGANA", "[ぁ-ゞー]");         // 全角ひらがな
	define("VALIDATION_DW_KARAKANA", "[ァ-ヾー]");         // 全角カタカナ
	define("VALIDATION_DW_DIGIT",    "[０-９]");           // 全角数字
	define("VALIDATION_DW_ULETTER",  "[Ａ-Ｚ]");           // 全角英字(大)
	define("VALIDATION_DW_LLETTER",  "[ａ-ｚ]");           // 全角英字(小)

	class Validation
	{
		var $error_num;

		/****************************************************************************
		 *コンストラクタ
		 * 引数：無し
		 * 戻値：無し
		 ****************************************************************************/
		function Validation()
		{
			$this->init();
		}
		/****************************************************************************
		 *内部変数の初期化
		 * 引数：無し
		 * 戻値：無し
		 ****************************************************************************/
		function init()
		{
			$error_num = "";
		}
                /****************************************************************************
		 *E-Mailアドレスの書式チェックを行う
		 * 引数：$value   ：評価する値
		 * 　　：$require ：必須フラグ(真なら値必須)
		 * 戻値：         ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isMail($value = "", $require = false)
		{
			$ret = true;
			if (is_null($value) or $value == "")
			{
				//必須入力チェック
				if ($require)
				{
					$this->error_num = "必須の値が未入力";
					$ret = false;
				}
			}
			else
			{
				//E-Mailアドレス書式チェック
				if ($ret and (!preg_match(VALIDATION_MAIL, $value) or mb_strlen($value) > 320))
				{
					$err_num = "E-Mailアドレス書式と合致しない";
					$ret = false;
				}
			}
			return $ret;
		}
		/****************************************************************************
		 *URL(http/https)の書式チェックを行う
		 * 引数：$value   ：評価する値
		 * 　　：$require ：必須フラグ(真なら値必須)
		 * 戻値：         ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isURL($value = "", $require = false)
		{
			$ret = true;
			if (is_null($value) or $value == "")
			{
				//必須入力チェック
				if ($require)
				{
					$this->error_num = "必須の値が未入力";
					$ret = false;
				}
			}
			else
			{
				//URL書式チェック
				if ($ret and !preg_match(VALIDATION_URL, $value))
				{
					$err_num = "URL書式と合致しない";
					$ret = false;
				}
			}
			return $ret;
		}
		/****************************************************************************
		 *日付の書式チェックを行う(Y/m/d)
		 * 引数：$value   ：評価する値
		 * 　　：$require ：必須フラグ(真なら値必須)
		 * 戻値：         ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isDate($value = "", $require = false)
		{
			$ret = true;
			if (is_null($value) or $value == "")
			{
				//必須入力チェック
				if ($require)
				{
					$this->error_num = "必須の値が未入力";
					$ret = false;
				}
			}
			else
			{
				//日付書式チェック
				if ($ret and !preg_match(VALIDATION_DATE, $value))
				{
					$this->error_num = "日付書式と合致しない";
					$ret = false;
				}
				//有効日付チェック
				$date_value = split("/", $value);
				if ($ret and !checkdate((int)$date_value[1], (int)$date_value[2], (int)$date_value[0]))
				{
					$this->error_num = "日付書式と合致しない";
					$ret = false;
				}
			}
			return $ret;
		}
		/****************************************************************************
		 *文字列の書式チェックを行う
		 * 引数：$value  ：評価する値
		 * 　　：$require：必須フラグ(真なら値必須)
		 * 　　：$max    ：最大バイト数(0なら上限無し)
		 * 　　：$min    ：最小バイト数
		 * 　　：$enc_chk：文字エンコード(チェック時形式)
		 * 　　：$enc_sou：文字エンコード(ソースファイル)
		 * 　　：$mb     ：文字数チェックフラグ(falseならバイト数チェック)
		 * 戻値：        ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isString($value = "", $require = false, $max = 0, $min = 0, $enc_chk = "UTF-8", $enc_sou = "UTF-8",$mb = false)
		{
			$ret = true;
			if (is_null($value) or $value == "")
			{
				//必須入力チェック
				if ($require)
				{
					$this->error_num = "必須の値が未入力";
					$ret = false;
				}
			}
			else
			{
				//文字列評価チェック(文字列の場合は、文字列長を取得する)
				if ($ret and !is_string($value))
				{
					$err_num = "文字列として評価出来ない";
					$ret = false;
				}
				else
				{
					$value = mb_convert_encoding($value, $enc_chk, $enc_sou);
				}
				//最大長チェック
				if ($ret and $max != 0 and ((!$mb and strlen(bin2hex($value))/2 > $max) or ($mb and mb_strlen($value, $enc_chk) > $max))
				)
				{
					$err_num = "最大長超過";
					$ret = false;
				}
				//最小長チェック
				if ($ret and ((!$mb and strlen(bin2hex($value))/2 < $min) or ($mb and mb_strlen($value, $enc_chk) < $min)))
				{
					$err_num = "最小長未満";
					$ret = false;
				}
			}
			return $ret;
		}
		/****************************************************************************
		 *数値のチェックを行う
		 * 引数：$value   ：評価する値
		 * 　　：$require ：必須フラグ(真なら値必須)
		 * 　　：$max     ：最大値(0なら上限無し)
		 * 　　：$min     ：最小値
		 * 　　：$decimal ：小数可フラグ(真なら小数許可)
		 * 戻値：         ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isNumeric($value = "", $require = false, $max = 0, $min = 0, $decimal = false)
		{
			$ret = true;
			if (is_null($value) or $value == "")
			{
				//必須入力チェック
				if ($require)
				{
					$this->error_num = "必須の値が未入力";
					$ret = false;
				}
			}
			else
			{
				//数値評価チェック
				if ($ret and !is_numeric($value))
				{
					$err_num = "数値として評価出来ない";
					$ret = false;
				}
				//小数チェック
				if ($ret and $decimal and (float)$value != (int)$value)
				{
					$err_num = "小数不許可なのに小数";
					$ret = false;
				}
				//最大値チェック
				if ($ret and $max != 0 and $value > $max)
				{
					$err_num = "最大値超過";
					$ret = false;
				}
				//最小値チェック
				if ($ret and $value < $min)
				{
					$err_num = "最小値未満";
					$ret = false;
				}
			}
			return $ret;
		}
		/****************************************************************************
		 *文字列の書式チェックを行う(正規表現条件指定)
		 * 引数：$value  ：評価する値
		 * 　　：$require：必須フラグ(真なら値必須)
		 * 　　：$pattern：正規表現の合致パターン
		 * 　　：$max    ：最大バイト数(0なら上限無し)
		 * 　　：$min    ：最小バイト数
		 * 　　：$enc_chk：文字エンコード(チェック時形式)
		 * 　　：$enc_sou：文字エンコード(ソースファイル)
		 * 戻値：        ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isMatch($value = "", $require = false, $pattern = "", $max = 0, $min = 0, $enc_chk = "UTF-8", $enc_sou = "UTF-8")
		{
			$ret = true;
			if (is_null($value) or $value == "")
			{
				//必須入力チェック
				if ($require)
				{
					$this->error_num = "必須の値が未入力";
					$ret = false;
				}
			}
			else
			{
				//文字列汎用チェック
				if ($ret and !$this->isString($value, $require, $max, $min, $enc_chk, $enc_sou))
				{
					$ret = false;
				}
				//正規表現チェック
				if ($ret and preg_match($pattern, $value) != 1)
				{
					$this->error_num = "使用不可文字がある";
					$ret = false;
				}
			}
			return $ret;
		}
		/****************************************************************************
		 *文字列の書式チェックを行う(半角数字のみ)
		 * 引数：$value  ：評価する値
		 * 　　：$require：必須フラグ(真なら値必須)
		 * 　　：$max    ：最大バイト数(0なら上限無し)
		 * 　　：$min    ：最小バイト数
		 * 　　：$enc_chk：文字エンコード(チェック時形式)
		 * 　　：$enc_sou：文字エンコード(ソースファイル)
		 * 戻値：        ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isSW_Digit($value = "", $require = false, $max = 0, $min = 0, $enc_chk = "UTF-8", $enc_sou = "UTF-8")
		{
			$ret = true;
			if (!$this->isMatch($value, $require, "/^(".VALIDATION_SW_DIGIT.")+$/", $max, $min, $enc_chk, $enc_sou))
			{
				$ret = false;
			}
			return $ret;
		}
		/****************************************************************************
		 *文字列の書式チェックを行う(ひらがなのみ可)
		 * 引数：$value  ：評価する値
		 * 　　：$require：必須フラグ(真なら値必須)
		 * 　　：$max    ：最大バイト数(0なら上限無し)
		 * 　　：$min    ：最小バイト数
		 * 　　：$enc_chk：文字エンコード(チェック時形式)
		 * 　　：$enc_sou：文字エンコード(ソースファイル)
		 * 戻値：        ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isDW_Hiragana($value = "", $require = false, $max = 0, $min = 0, $enc_chk = "UTF-8", $enc_sou = "UTF-8")
		{
			$ret = true;
			if (!$this->isMatch($value, $require, "/^(".VALIDATION_DW_HIRAGANA."|".VALIDATION_DW_SPACE."|".VALIDATION_SW_SPACE.")+$/", $max, $min, $enc_chk, $enc_sou))
			{
				$ret = false;
			}
			return $ret;
		}
		/****************************************************************************
		 *文字列の書式チェックを行う(カタカナのみ可)
		 * 引数：$value  ：評価する値
		 * 　　：$require：必須フラグ(真なら値必須)
		 * 　　：$max    ：最大バイト数(0なら上限無し)
		 * 　　：$min    ：最小バイト数
		 * 　　：$enc_chk：文字エンコード(チェック時形式)
		 * 　　：$enc_sou：文字エンコード(ソースファイル)
		 * 戻値：        ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isDW_Katakana($value = "", $require = false, $max = 0, $min = 0, $enc_chk = "UTF-8", $enc_sou = "UTF-8")
		{
			$ret = true;
			if (!$this->isMatch($value, $require, "/^(".VALIDATION_DW_KARAKANA."|".VALIDATION_DW_SPACE."|".VALIDATION_SW_SPACE.")+$/", $max, $min, $enc_chk, $enc_sou))
			{
				$ret = false;
			}
			return $ret;
		}
                /****************************************************************************
		 *文字列の書式チェックを行う(半角英数字)
		 * 引数：$value  ：評価する値
		 * 　　：$require：必須フラグ(真なら値必須)
		 * 　　：$max    ：最大バイト数(0なら上限無し)
		 * 　　：$min    ：最小バイト数
		 * 　　：$enc_chk：文字エンコード(チェック時形式)
		 * 　　：$enc_sou：文字エンコード(ソースファイル)
		 * 戻値：        ：正規の値ならば真を、問題があれば偽を返す
		 ****************************************************************************/
		function isDW_SW($value = "", $require = false, $max = 0, $min = 0, $enc_chk = "UTF-8", $enc_sou = "UTF-8")
		{
			$ret = true;
			if (!$this->isMatch($value, $require, "/^(".VALIDATION_SW_LLETTER."|".ALIDATION_SW_DIGIT.")+$/", $max, $min, $enc_chk, $enc_sou))
			{
				$ret = false;
			}
			return $ret;
		}

	}








	function calculateDateString($date, $add = "")
	{
		$ret = "";
		$date = split("/", $date);
		if (count($date) == 3 and checkdate((int)$date[1], (int)$date[2], (int)$date[0]))
		{
			$ret = date("Y/m/d", strtotime($date[0]."/".$date[1]."/".$date[2]." ".$add));
		}
		return $ret;
	}

//echo calculateDateString("2005/01/01", "+10year +10month +10day")






?>
