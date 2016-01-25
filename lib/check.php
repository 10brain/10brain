<?php
/////////////////////////////////////////////////
//日付取得
//	変数に今日の日付を返す
//	$YMD_flg         返すデータを指定
//	                 　"Y"    "yyyy"       
//	                 　"M"    "MM"         
//	                 　"D"    "dd"         
//	                 　"YMD"  "yyyy/MM/dd" を返す
/////////////////////////////////////////////////
function NowYMD($YMD_flg){
 $Now = getdate();
 
 switch($YMD_flg){
  case "Y":
  case "y":
   $ret = sprintf("%04d",$Now["year"]);
   break;
  case "M":
  case "m":
   $ret = sprintf("%02d",$Now["mon"]);
   break;
  case "D":
  case "d":
   $ret = sprintf("%02d",$Now["mday"]);
   break;
  case "YMD":
  case "ymd":
   $ret = sprintf("%04d/%02d/%02d",$Now["year"],$Now["mon"],$Now["mday"]);
   break;
 }
 return $ret;
}

/////////////////////////////////////////////////
//文字列チェック（半カナ→全カナ）
//	$str		チェック対象
//	$max		最大バイト数
//	$blank		空欄チェック（0:許可 1:不許可）
/////////////////////////////////////////////////
function ckStr(&$str,$max,$blank){
 $ret = false;
 
 //半角カナ→全角カナ変換
 //$str = mb_convert_kana($str,"KV","SJIS");
 
 //変換後文字列長取得
 $len = strlen($str);

 //タグ取り除き
 $str = Strip_Tags($str);
 
 //変換後文字列長取得
 $len2 = strlen($str);
 

 //入力チェック
 if($blank == 0){
  if(0 <= $len and $len <= $max){
   $ret = true;
  }
 }
 else{
  if(0 < $len and $len <= $max){
   $ret = true;
  }
 }

 //入力チェック
 if($len != $len2){
   $ret = false;
 }

 return $ret;

}

/////////////////////////////////////////////////
//数値チェック（全英数→半英数）
//	$num		チェック対象
//	$min		最小値
//	$max		最大値
//	$blank		空欄チェック（0:許可 1:不許可）
//	$decimal	小数チェック（0:許可 1:不許可）
/////////////////////////////////////////////////
function ckNum(&$num,$min,$max,$blank,$decimal){
 $ret = false;
 
 //全角英数→半角英数変換
 $num = mb_convert_kana($num,"a","UTF-8");
 
 //空入力チェック
 if($num == ""){
  //空欄許可チェック
  if($blank == 0){
   $ret = true;
  }
 }
 else{
  //数値範囲チェック
  if($min <= $num and $num <= $max){
   if($decimal == 0){
    //マッチ判定（小数許可）
    if(ereg("[^0-9\.]",$num) == false){
     $ret = true;
    }
   }
   else{
    //マッチ判定（小数不許可）
    if(ereg("[^0-9]",$num) == false){
     $ret = true;
    }
   }
  }
 }
 return $ret;
}

/////////////////////////////////////////////////
//日付チェック
//	$year      年
//	$month     月
//	$day       日
//	$blank     空欄チェック（0:許可 1:不許可）
//	$timing    現在日比較（0:制限無し 1:過去日付不可）
/////////////////////////////////////////////////
function ckDay(&$year,&$month,&$day,$blank,$timing){
 $chk = false;
 $ret = false;
 
 if($blank == 0){
  if($year == "" and $month == "" and $day == ""){
   $ret = true;
  }
 }else{
  if(ckNum($year,1754,9999,1,1) == true){
   if(ckNum($month,1,12,1,1) == true){
    switch($month){
     case 1:
     case 3:
     case 5:
     case 7:
     case 8:
     case 10:
     case 12:
      //1-31日の月
      if(ckNum($day,1,31,1,1)){
       $chk = true;
      }break;
     case 4:
     case 6:
     case 9:
     case 11:
      //1-30日の月
      if(ckNum($day,1,30,1,1)){
       $chk = true;
      }break;
     case 2:
      //2月うるう年チェック
      if($year % 400 == 0 or ($year % 4 == 0 and $year % 100 != 0)){
       //うるう年
       if(ckNum($day,1,29,1,1)){
        $chk = true;
       }
      }else{
       //平年(1-28日)
       if(ckNum($day,1,28,1,1)){
        $chk = true;
       }
      }break;
    }
   }
  }
  if($chk == true){
   //日付文字列取得
   $YMD = sprintf("%04d/%02d/%02d",$year,$month,$day);    //引数生成
   $NowYMD = NowYMD("ymd");                               //現在日付
   
   if($timing == 0){
    $ret = true;
   }else if($timing == 1){      //過去禁止
    if($NowYMD <= $YMD){
     $ret = true;
    }
   }
  }
 }
 return $ret;
}

/////////////////////////////////////////////////
//Web出力変換
/////////////////////////////////////////////////
function cvWeb($str){
 $str = ereg_replace("&","&amp;",$str);     // &    → &amp;
 $str = ereg_replace("<","&lt;",$str);      // <    → &lt;
 $str = ereg_replace(">","&gt;",$str);      // >    → &gt;
 $str = ereg_replace("\"","&quot;",$str);   // "    → &quot;
 $str = ereg_replace("\r\n","<br>",$str);   // <br> → \r\n
 
 return $str;
}

/////////////////////////////////////////////////
//MSSQL出力変換
/////////////////////////////////////////////////
function cvSql($str){
 $str = ereg_replace("'", "''", $str);        // '    → ''
 $str = ereg_replace(";", ":", $str);         // ;    → :
 $str = ereg_replace("--", "__", $str);       // --   → __
 $str = ereg_replace("<br>","\r\n",$str);     // \r\n → <br>
 
 return $str;
}
