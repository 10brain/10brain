<?php
	/**********************************************************************
	 * チェックボックスクラス
	 *
	 * ■宣言例（書式は【値:ラベル内表示//ラベル外表示[txt]】）
	 * $check01 = new Check("check01", "01:あいう//えお,02:かきくけこ,03:さしす\,せそ,04:たち\:つてと//[txt],05:なにぬねの//[txt]", $io);
	 * ■値を設定
	 * $check01->set_values("01,02,05");
	 * ■入力表示例
	 * <?=$check01->get_all_checks("<div class=\"classXX\">?</div>", true) ?>
	 * ■確認処理例
	 * if(!$check01->is_regularly(0, 1)) { ～
	 * ■確認表示例
	 * <?=$check01->get_checked_text("<div style=\"float:left; margin-right:1em;\">?</div>") ?>
	 **********************************************************************/
	class Check
	{
		//パラメータ
		var $name       = "";
		var $options    = Array();
		var $values     = Array();
		var $io         = null;

		//メソッド
		/**********************************************************************
		 * コンストラクタ
		 * 引数 $name    : name要素
		 * 　　 $options : 項目リスト文字列(項目はカンマ区切り、値と表示はコロン区切り。項目内でカンマやコロンを使用する場合は\,や\:と表記する)
		 * 　　 $io      :
		 * 戻値          : 無し
		 **********************************************************************/
		function Check($name, $options, &$io)
		{
			$this->init($name, $options, $io);
		}
		/**********************************************************************
		 * クラスの初期化処理
		 * 引数 $name    : name要素
		 * 　　 $options : 項目リスト文字列(項目はカンマ区切り、値と表示はコロン区切り。項目内でカンマやコロンを使用する場合は\,や\:と表記する)
		 * 　　 $io      : 入出力インスタンス
		 * 戻値          : 無し
		 **********************************************************************/
		function init($name, $options, &$io)
		{
			$this->name = $name;
			$options = explode("[,]", str_replace("\[,]", ",", str_replace(",", "[,]", $options)));
			foreach($options as $option)
			{
				$option = explode("[:]", str_replace("\[:]", ":", str_replace(":", "[:]", $option)));
				if(count($option) == 1)
				{
					$opt = explode("//", $option[0]);
					$val = $opt[0];
				}
				else if($option[0] == "")
				{
					$opt = explode("//", $option[1]);
					$val = $opt[1];
				}
				else
				{
					$opt = explode("//", $option[1]);
					$val = $option[0];
				}
				$this->options[] = Array($val, $opt);
			}
			$this->values = is_array($io->get_param($name)) ? $io->get_param($name) : Array($io->get_param($name));
			$this->io = $io;

			return;
		}
		/**********************************************************************
		 *チェックボックス郡の値を設定する
		 * 引数 $values : 配列、または配列化可能なカンマ区切りテキスト
		 * 戻値         : 無し
		 **********************************************************************/
		function set_values($values)
		{
			if(is_array($values))
				$this->values = $values;
			else
				$this->values = explode(",", $values);
		}
		/**********************************************************************
		 *内部配列に登録されたパラメータを、checkbox型inputタグで一括出力する
		 * 引数 $base     : ベースとなる記述、この値の?をcheckbox型inputタグ+labelタグで置換する
		 *      $enable   : 入力可否
		 *      $notarray : 非配列フラグ(パラメータ名から[]を削除、代わりに複数パラメータが有る場合は最初の1つしか出力されない)
		 * 戻値           : 内部配列をcheckbox型inputタグの形式で一括出力したもの
		 **********************************************************************/
		function get_all_checks($base = "?", $enable = true, $notarray = false)
		{
			$ret = "";
			if($base != "?") $base = $this->io->conv_from_output($base);
			foreach($this->options as $option)
			{
				$value    = $option[0];
				$id       = $this->name."_".$value;
				$text1    = $option[1][0];
				$text2    = $this->get_checks_text($id, $option[1][1]);
				$checked  = in_array($value, $this->values) ? " checked" : "";
				$disabled = !$enable ? " disabled" : "";

				$tag_check = "<input type=\"checkbox\" class=\"checkbox\" name=\"".$this->name."[]\" id=\"".$id."\" value=\"".$value."\"".$checked.$disabled." />";
				$tag_label = "<label for=\"".$id."\"><p>".$text1."</p></label>"/*.$text2*/;
				$ret.= str_replace("?", $tag_check.$tag_label, $base);

				if($notarray)
				{
					$ret = str_replace("[]", "", $ret);
					break;
				}
			}
			return $this->io->conv_from_inner($ret);
		}
		/**********************************************************************
		 * get_all_checks()のサブファンクション
		 * ラベル外表示内の[txt]をテキストボックスタグに置換した値を返す
		 * 引数 $id     : ラベル外表示の親となるチェックボックスのID(テキストボックスの名前で使用)
		 *      $text   : ラベル外表示
		 *      $enable : 入力可否
		 * 戻値         : 置換したラベル外表示
		 **********************************************************************/
		function get_checks_text($id, $text, $enable = true)
		{
			$ret = $text;
			if(strpos($text, "[txt]") !== false)
			{
				$value    = $this->io->conv_to_html($this->io->get_param($id."_txt"), false);
				$disabled = !$enable ? " disabled" : "";

				$tag_txtbx = "<input type=\"text\" name=\"".$id."_txt\" id=\"".$id."_txt\" value=\"".$value."\"".$disabled." />";
				$ret = str_replace("[txt]", $tag_txtbx, $text);
			}
			return $ret;
		}
		/**********************************************************************
		 * 設定された値が通常取りうる正規の値かを判断する(チェックされたcheckboxに付随するテキストがブランクならエラー)
		 * 引数 $max    : 最大チェック数(未指定(=0)なら上限無し)
		 *      $min    : 最小チェック数
		 * 戻値 boolean : 設定された値が通常取りうる正規の値なら真、正規の値でないなら偽
		 **********************************************************************/
		function is_regularly($max = 0, $min = 0)
		{
			$ret = false;
			$count = 0;
			foreach($this->options as $option)
			{
				if(in_array($option[0], $this->values))
				{
					if(strpos($option[1][1], "[txt]") === false)
					{
						$count++;
					}
					else if($io->get_param($this->name."_".$option[0]."_txt") != "")
					{
						$count++;
					}
					else
					{
						$count = -1;
						break;
					}
				}
			}
			if(($max == 1 || $max >= $count) && $min <= $count)
			{
				$ret = true;
			}
			return $ret;
		}
		/**********************************************************************
		 * 選択された項目の見出しテキストを取得する
		 * 引数 $base  : ベースとなる記述、この値の?をチェックされた項目のlabelテキストで置換する
		 * 　　 $conv  : html出力への変換フラグ
		 * 戻値 string : 選択された項目の見出しテキスト
		 **********************************************************************/
		function get_checked_text($base = "?", $conv = true)
		{
			$ret = "";
			if($base != "?" and $conv) $base = $this->io->conv_from_output($base);
			foreach($this->options as $option)
			{
				if(in_array($option[0], $this->values))
				{
					$text = $option[1][0];
					if(strpos($option[1][1], "[txt]") !== false)
					{
						$text.= " : ".$this->io->conv_to_html($this->io->get_param($this->name."_".$option[0]."_txt"), false);
					}
					$ret.= str_replace("?", $text, $base);
				}
			}
			if($conv)
			{
				$ret = $this->io->conv_from_inner($ret);
			}
			return $ret;
		}
	}
?>
