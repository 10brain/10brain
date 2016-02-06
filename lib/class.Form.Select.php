<?php
	/**********************************************************************
	 *セレクトボックスクラス
	 *
	 * ■宣言例（書式は【値:オプション内表示】）
	 * $select01 = new Select("select01", ":選択してください,01:あいうえお,02:かきくけこ,03:さしす\,せそ,04:たち\:つてと,05:なにぬねの", $io);
	 * ■値を設定
	 * $select01->value = "01";
	 * ■入力表示例
	 * <?=$select01->get_all_options() ?>
	 * ■確認処理例
	 * if(!$select01->is_regularly(true)) { ～
	 * ■確認表示例
	 * <?=$select01->get_selected_text() ?>
	 *
	 **********************************************************************/
	class Select
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
		function Select($name, $options, &$io)
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
					$opt = $option[0];
					$val = $option[0];
				}
				else
				{
					$opt = $option[1];
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
		 * 引数        : 無し
		 * 戻値 string : 内部配列をoptionタグの形式で一括出力したもの
		 ************************************************************/
		function get_all_options()
		{
			$ret = "";
			if($base != "?") $base = $this->io->conv_from_output($base);
			foreach($this->options as $option)
			{
				$value      = $option[0];
				$text       = $option[1];
				$selected   = $value == $this->value ? " selected" : "";
				
				$tag_option = "<option value=\"$value\"$selected>$text</option>";
				$ret.= $tag_option;
			}
			return $this->io->conv_from_inner($ret);
		}
		/**********************************************************************
		 * 設定された値が通常取りうる正規の値かを判断する
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
						$temporary = true;
						break;
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
		function get_selected_text($conv = true)
		{
			$ret = "";
			if($this->value != "")
			{
				foreach($this->options as $option)
				{
					if($option[0] == $this->value)
					{
						$ret = $option[1];
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
