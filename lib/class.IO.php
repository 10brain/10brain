<?php
/************************************************************
*入出力クラス
*
* ■宣言例
* Set $io = new IO("UTF-8", "UTF-8", "EUC-JP", "submit_x,submit_y", $key);
* $io->set_parameters($_POST);
* $io->set_parameters($_GET);
* ■値の未改変チェック
* if ($io->is_not_falsification())
* {
* 	//未改変(登録処理)
* }
* ■パラメータ一覧の出力
* <?=$io->get_all_params();?>
************************************************************/
class IO{
//パラメータ
var $enc_input    = "";      //前画面の文字コード
var $enc_output   = "";      //現画面の文字コード
var $enc_inner    = "";      //内部の文字コード
var $ignore_param = "";      //除外パラメータ(ハッシュ生成と一括出力から除外)
var $hash_key     = "";      //ハッシュ生成時のキー
var $values       = array(); //
var $hash         = "";      //

/************************************************************
 *IOクラスのコンストラクタ
 *文字コードは右より何れかを指定(ASCII,JIS,SJIS,EUC-JP,UTF-7,UTF-8,SJIS-win,eucJP-win,ISO-2022-JP)
 * 引数 : $enc_input    : 入力文字コード
 * 　　 : $enc_output   : 出力文字コード
 * 　　 : $enc_inner    : 内部文字コード
 * 　　 : $ignore_param : 一括出力やハッシュ生成から除外するパラメータ名(,区切りで複数指定可能)
 * 　　 : $hash_key     : ハッシュを作成する際の固定キー
 * 戻値 :               : 無し
 ************************************************************/
function IO($enc_input, $enc_output, $enc_inner, $ignore_param = "", $hash_key = ""){
        $this->init($enc_input, $enc_output, $enc_inner, $ignore_param, $hash_key);
}
/************************************************************
 *IOクラスの初期化を行う
 *文字コードは右より何れかを指定(ASCII,JIS,SJIS,EUC-JP,UTF-7,UTF-8,SJIS-win,eucJP-win,ISO-2022-JP)
 * 引数 : $enc_input    : 入力文字コード
 * 　　 : $enc_output   : 出力文字コード
 * 　　 : $enc_inner    : 内部文字コード
 * 　　 : $ignore_param : 一括出力やハッシュ生成から除外するパラメータ名(,区切りで複数指定可能)
 * 　　 : $hash_key     : ハッシュを作成する際の固定キー
 * 戻値 :               : 無し
 ************************************************************/
function init($enc_input, $enc_output, $enc_inner, $ignore_param = "", $hash_key = ""){
        $this->enc_input    = $enc_input;
        $this->enc_output   = $enc_output;
        $this->enc_inner    = $enc_inner;
        $this->ignore_param = $ignore_param;
        if($hash_key == "")
        {
                $this->hash_key = "vp6hDQubTnkLdreSBnoQAVwkRggbl0JPhHpOJr5plHjN9AWfV7YDBTzfQ5rKfnow";
        }
        else
        {
                $this->hash_key = $hash_key;
        }
}
/************************************************************
 *連想配列(主に$_POSTと$_GET)内のパラメータを内部変数へ登録する
 * 引数 : $params : 内部変数へ取り込む連想配列($_POSTや$_GET)
 * 戻値 :         : 無し
 ************************************************************/
function set_parameters($params){
        reset($params);
        while($param = each($params))
        {
                $para_name = $this->conv_from_input($param[0]);
                if($para_name == "hash")
                {
                        $this->hash = $this->conv_from_input($param[1]);
                }
                else if(!preg_match("/[<>\&\'\"\n\t]/", $para_name))
                {
                        if(!is_array($param[1]))
                        {
                                $this->values[$para_name] = $this->conv_from_input($param[1]);
                        }
                        else
                        {
                                $valstxt = "";
                                foreach($param[1] as $option)
                                {
                                        if($valstxt !== "") $valstxt.= ",";
                                        $valstxt.= $this->conv_from_input($option);
                                }
                                $this->values[$para_name] = explode(",", $valstxt);
                        }
                }
        }
}
/************************************************************
 *指定パラメータを内部変数へ登録する
 * 引数 : $name  : 内部変数へ登録するパラメータ名
 * 　　 : $value : 内部変数へ登録するパラメータ値
 * 戻値 :        : 無し
 ************************************************************/
function set_parameter($name, $value){
        $this->values[$name] = $value;
}
/************************************************************
 *指定パラメータを内部変数から削除する
 * 引数 : $name : 内部変数から削除するパラメータ名
 * 戻値 :       : 無し
 ************************************************************/
function unset_parameter($name){
        unset($this->values[$name]);
}
/************************************************************
 *magic_quotes_gpcが付与したエスケープ文字を削除する(magic_quotes_gpcが無効なら何もしない)
 * 引数 : $val : エスケープ文字を削除する文字列
 * 戻値 :      : エスケープ文字が削除された文字列
 ************************************************************/
function mq_stripslashes($val){
        $ret = $val;
        if (get_magic_quotes_gpc() == 1)
        {
                $ret = stripslashes($val);
        }
        return $ret;
}
/************************************************************
 *入力文字コードから内部文字コードへ変換
 * 引数 : $val : 変換元文字列
 * 戻値 :      : 変換済文字列
 ************************************************************/
function conv_from_input($val){
        return $this->mq_stripslashes(mb_convert_encoding($val, $this->enc_inner, $this->enc_input));
}
/************************************************************
 *出力文字コードから内部文字コードへ変換
 * 引数 : $val : 変換元文字列
 * 戻値 :      : 変換済文字列
 ************************************************************/
function conv_from_output($val){
        return mb_convert_encoding($val, $this->enc_inner, $this->enc_output);
}
/************************************************************
 *内部文字コードから出力文字コードへ変換
 * 引数 : $val : 変換元文字列
 * 戻値 :      : 変換済文字列
 ************************************************************/
function conv_from_inner($val){
        return mb_convert_encoding($val, $this->enc_output, $this->enc_inner);
}
/************************************************************
 *html出力への変換
 * 引数 : $str  : 変換元文字列
 * 　　 : $conv : 出力文字コードへの変換フラグ
 * 戻値 :       : 変換済文字列
 ************************************************************/
function conv_to_html($val, $conv = true){
        $ret = htmlspecialchars($val, ENT_QUOTES); //タグとクォートを無効化
        if ($conv)
        {
                $ret = $this->conv_from_inner($ret);
        }
        return $ret;
}
/************************************************************
 *html出力への変換(改行コードは改行タグへ変換)
 * 引数 : $str  : 変換元文字列
 * 　　 : $conv : 出力文字コードへの変換フラグ
 * 戻値 :       : 変換済文字列
 ************************************************************/
function conv_to_html_br($val, $conv = true){
        $ret = $this->conv_to_html($val, false);   //html出力への変換(文字コード変換はしない)
        $ret = nl2br($ret);                        //改行コード前に改行タグ(<br />)を挿入
        $ret = str_replace("\n", "", $ret);        //改行コードを削除
        if ($conv)
        {
                $ret = $this->conv_from_inner($ret);
        }
        return $ret;
}
/************************************************************
 *SQLクエリへの変換(エスケープ)(Postgres用)
 * 引数 : $val : 変換元文字列
 * 戻値 :      : 変換済文字列
 ************************************************************/
function conv_to_sql($val){
        return pg_escape_string($val);
}
/************************************************************
 *指定パラメータの値を取得
 * 引数 : $name : 取得するパラメータ名
 * 戻値 :       : 取得したパラメータ値
 ************************************************************/
function get_param($name){
        return $this->values[$name];
}
/************************************************************
 *指定パラメータの値をhtml出力変換して取得
 * 引数 : $name : 取得するパラメータ名
 * 戻値 :       : 取得したパラメータ値
 ************************************************************/
function get_param_html($name){
        return $this->conv_to_html($this->values[$name]);
}
/************************************************************
 *指定パラメータの値をhtml出力変換して取得(改行コードは改行タグへ変換)
 * 引数 : $name : 取得するパラメータ名
 * 戻値 :       : 取得したパラメータ値
 ************************************************************/
function get_param_html_br($name){
        return $this->conv_to_html_br($this->values[$name]);
}
/************************************************************
 *指定パラメータの値をSQL出力変換して取得
 * 引数 : $name : 取得するパラメータ名
 * 戻値 :       : 取得したパラメータ値
 ************************************************************/
function get_param_sql($name){
        return $this->conv_to_sql($this->values[$name]);
}
/************************************************************
 *内部配列にパラメータ名を指定してメッセージを登録
 * 引数 : $name    : エラーが発生したパラメータ名
 * 　　 : $message : エラーメッセージ
 * 戻値 :          : 無し
 ************************************************************/
function set_error($name, $message){
        $this->errors[$name] = $message;
}
/************************************************************
 *パラメータ名を指定し、内部配列に登録されたメッセージを取得
 * 引数 : $name  : エラーが発生したパラメータ名
 * 　　 : $conv  : 真ならHTML出力用変換を行い、偽ならそのまま出力
 * 戻値 :        : エラーメッセージ
 ************************************************************/
function get_error($name ,$conv = true){
        $ret = "";
        if ($conv == true)
        {
                $ret = $this->conv_to_html($this->errors[$name]);
        }
        else
        {
                $ret = $this->conv_from_inner($this->errors[$name]);
        }
        return $ret;
}
/************************************************************
 *パラメータ名を指定し、メッセージ登録の有無に応じて値を返す
 * 引数 : $name      : 有無を確認するパラメータ名
 * 　　 : $true_ret  : エラーが発生していた場合の戻値
 * 　　 : $false_ret : エラーが発生していなかった場合の戻値
 * 戻値 :            :
 ************************************************************/
function if_error($name, $true_ret = "", $false_ret = ""){
        if ($this->errors[$name] != "")
        {
                return $true_ret;
        }
        else
        {
                return $false_ret;
        }
}
/************************************************************
 *内部配列にエラーメッセージが登録されているか確認
 * 引数 :  : 無し
 * 戻値 :  : 登録済なら真、未登録なら偽
 ************************************************************/
function is_error(){
        $ret = true;
        if (count($this->errors) == 0)
        {
                $ret = false;
        }
        return $ret;
}
/************************************************************
 *内部配列に登録されたパラメータを、hidden型inputタグで一括出力する
 *(除外リストのパラメータは除く)
 * 引数 :  : 無し
 * 戻値 :  : 内部配列をhidden型inputタグの形式で一括出力したもの
 ************************************************************/
function get_all_params(){
        $ret = "";
        reset($this->values);
        while($value = each($this->values))
        {
                if(strpos(",$this->ignore_param,", ",$value[0],") === false)
                {
                        if(!is_array($value[1]))
                        {
                                $ret.= "<input type=\"hidden\" name=\"$value[0]\" value=\"".htmlspecialchars($value[1])."\">\n";
                        }
                        else
                        {
                                while($value2 = each($value[1]))
                                {
                                        $ret.= "<input type=\"hidden\" name=\"$value[0][]\" value=\"".htmlspecialchars($value2[1])."\">\n";
                                }
                        }
                }
        }
        return $this->conv_from_inner($ret);
}
/************************************************************
 *内部配列に登録されたパラメータを元にハッシュを生成し、内部配列に登録する
 *(元にするパラメータは、除外リストと当処理で登録するhashを除く)
 * 引数 :  : 無し
 * 戻値 :  : 無し
 ************************************************************/
function create_hash(){
        $key = $this->hash_key;
        reset($this->values);
        while($value = each($this->values))
        {
                if(strpos(",$this->ignore_param,hash,", ",$value[0],") === false)
                {
                        $key.= $value[1];
                }
        }
        $this->set_parameter("hash", md5($key));
}
/************************************************************
 *前画面から送られて来たhashと、前画面から送られて来たパラメータを元に生成したhashの合致チェックを行う
 * 引数 :  : 無し
 * 戻値 :  : 合致したら真、合致しなかったら偽
 ************************************************************/
function is_not_falsification(){
        $ret = false;
        $this->create_hash();
        if ($this->hash == $this->values["hash"])
        {
                $ret = true;
        }
        return $ret;
}
}
?>