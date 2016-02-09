<?php
	/**********************************************************************
	 * ラジオボタンクラス
	 *
	 * ■宣言例（書式は【値:ラベル内表示//ラベル外表示[txt]】）
	 * $radio01 = new Radio("radio01", "01:あいう//えお,02:かきくけこ,03:さしす\,せそ,04:たち\:つてと//[txt],05:なにぬねの//[txt]", $io);
	 * ■値を設定
	 * $radio01->value = "01";
	 * ■入力表示例
	 * <?=$radio01->get_all_radios("<div class=\"classXX\">?</div>", true) ?>
	 * ■確認処理例
	 * if(!$radio01->is_regularly(true)) { ～
	 * ■確認表示例
	 * <?=$radio01->get_checked_text() ?>
	 * ■値取得例
	 * $radio01m = get_checked_text_main(false);	// get_checked_textのラベル部のみ取得
	 * $radio01s = get_checked_text_sub(false);		// get_checked_textのテキストボックス部のみ取得
	 **********************************************************************/
	class Radio
	{
		//パラメータ
		var $name       = "";
		var $options    = Array();
		var $value      = "";
		var $io         = null;
		
		//メソッド
		/**********************************************************************
		 * コンストラクタ
		 * 引数 $name    : name要素
		 * 　　 $options : 項目リスト文字列(項目はカンマ区切り、値と表示はコロン区切り。項目内でカンマやコロンを使用する場合は\,や\:と表記する)
		 * 　　 $io      :
		 * 戻値          : 無し
		 **********************************************************************/
		function Radio($name, $options, &$io)
		{
			$this->init($name, $options, $io);
		}
		/**********************************************************************
		 * クラスの初期化処理
		 * 引数 $name    : name要素
		 * 　　 $options : 項目リスト文字列(項目はカンマ区切り、値と表示はコロン区切り。項目内でカンマやコロンを使用する場合は\,や\:と表記する)
		 * 　　 $io      :
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
			$this->value = $io->get_param($name);
			$this->io = $io;
			return;
		}
		/************************************************************
		 *内部配列に登録されたパラメータを、radio型inputタグで一括出力する
		 * 引数 $base   : ベースとなる記述、この値の?をradio型inputタグ+labelタグで置換する
		 *      $enable : 入力可否
		 * 戻値 string  : 内部配列をradio型inputタグの形式で一括出力したもの
		 ************************************************************/
		function get_all_radios($base = "?", $enable = true)
		{
			$ret = "";
			if($base != "?") $base = $this->io->conv_from_output($base);
			foreach($this->options as $option)
			{
				$value    = $option[0];
				$id       = $this->name."_".$value;
				$text1    = $option[1][0];
				$text2    = $this->get_checks_text($id, $option[1][1]);
				$checked  = $value == $this->value ? " checked" : "";
				$disabled = !$enable ? " disabled" : "";
				
				$tag_radio = "<input type=\"radio\" class=\"radio\" name=\"".$this->name."\" id=\"".$id."\" value=\"".$value."\"".$checked.$disabled." />";
				$tag_label = "<label for=\"".$id."\">".$text1."</label>".$text2;
				$ret.= str_replace("?", $tag_radio.$tag_label, $base);
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
		 * 設定された値が通常取りうる正規の値かを判断する(チェックされたradioに付随するテキストがブランクならエラー)
		 * 引数 $require : 値必須チェックを行うなら真、行わないなら偽を指定する
		 * 戻値 boolean  : 設定された値が通常取りうる正規の値なら真、正規の値でないなら偽
		 **********************************************************************/
		function is_regularly($require = false)
		{
			$ret = false;
			if($this->value == "")
			{
				$ret = !$require;
			}
			else
			{
				$temporary = false;
				foreach($this->options as $option)
				{
					if($option[0] == $this->value)
					{
						if(strpos($option[1][1], "[txt]") === false)
						{
							$temporary = true;
							break;
						}
						else if($this->io->get_param($this->name."_".$option[0]."_txt") != "")
						{
							$temporary = true;
							break;
						}
						else
						{
							break;
						}
					}
				}
				$ret = $temporary;
			}
			return $ret;
		}
		/**********************************************************************
		 * 選択された項目の見出しテキストを取得する
		 * 引数 $conv  : html出力用変換フラグ
		 * 戻値 string : 選択された項目の見出しテキスト
		 **********************************************************************/
		function get_checked_text($conv = true)
		{
			$ret = "";
			if($this->value != "")
			{
				foreach($this->options as $option)
				{
					if($option[0] == $this->value)
					{
						$ret = $option[1][0];
						if(strpos($option[1][1], "[txt]") !== false)
						{
							$ret.= " : ".$this->io->conv_to_html($this->io->get_param($this->name."_".$option[0]."_txt"), false);
						}
						break;
					}
				}
				if($conv)
				{
					$ret = $this->io->conv_from_inner($ret);
				}
			}
			return $ret;
		}
		/**********************************************************************
		 * 選択された項目の見出しテキストを取得する(メインのラベル部のみ)
		 * 引数 $conv  : html出力用変換フラグ
		 * 戻値 string : 選択された項目の見出しテキスト(メインのラベル部のみ)
		 **********************************************************************/
		function get_checked_text_main($conv = true)
		{
			$ret = "";
			if($this->value != "")
			{
				foreach($this->options as $option)
				{
					if($option[0] == $this->value)
					{
						$ret = $option[1][0];
						break;
					}
				}
				if($conv)
				{
					$ret = $this->io->conv_from_inner($ret);
				}
			}
			return $ret;
		}
		/**********************************************************************
		 * 選択された項目の見出しテキストを取得する(サブのテキスト部のみ)
		 * 引数 $conv  : html出力用変換フラグ
		 * 戻値 string : 選択された項目の見出しテキスト(サブのテキスト部のみ)
		 **********************************************************************/
		function get_checked_text_sub($conv = true)
		{
			$ret = "";
			if($this->value != "")
			{
				foreach($this->options as $option)
				{
					if($option[0] == $this->value)
					{
						if(strpos($option[1][1], "[txt]") !== false)
						{
							$ret = $this->io->get_param($this->name."_".$option[0]."_txt");
						}
						break;
					}
				}
				if($conv)
				{
					$ret = $this->io->conv_from_inner($ret);
				}
			}
			return $ret;
		}
	}
?>
