<?php
define("VALIDATION_ISBN",    "/^\d{3}\-\d{10}$/");
define("VALIDATION_ASIN",    "/^[A-Z0-9]+$/"); //半角大文字英数字
define("VALIDATION_PW0",    "/^[a-zA-Z0-9]+$/"); //半角大文字英数字
define("VALIDATION_PW0",    "/^[a-zA-Z0-9]+$/"); //半角大文字英数字
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
 $result = false;
 
 //全角英数→半角英数変換
 $num = mb_convert_kana($num,"a","UTF-8");
 
 //空入力チェック
 if($num == ""){
  //空欄許可チェック
  if($blank == 0){
   $result = true;
  }
 }
 else{
  //数値範囲チェック
  if($min <= $num and $num <= $max){
   if($decimal == 0){
    //マッチ判定（小数許可）
    if(ereg("[^0-9\.]",$num) == false){
     $result = true;
    }
   }
   else{
    //マッチ判定（小数不許可）
    if(ereg("[^0-9]",$num) == false){
     $result = true;
    }
   }
  }
 }
 return $result;
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
//日付入力確認
/////////////////////////////////////////////////
function inpDate(&$date){
    $ret = false;
    //全角英数→半角英数変換
    $date = mb_convert_kana($date,"n","UTF8");
 

      if(preg_match('/^\d{4}\/\d{1,2}\/\d{1,2}$/', $date)){
        $ret = true;
      }
    return $ret;
    
}

/////////////////////////////////////////////////
//IDチェック
/////////////////////////////////////////////////
function isID(&$ID,$max,$blank){
    $ret = false;
    //全角英数→半角英数変換
    $date = mb_convert_kana($ID,"r","UTF8");
    //変換後文字列長取得
   $len = strlen($ID);

   //タグ取り除き
   $str = Strip_Tags($ID);

   //変換後文字列長取得
   $len2 = strlen($ID);


   //入力チェック
   if($blank == 0){
    if(0 <= $len and $len <= $max){
        if(preg_match('/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/', $ID)){

        $ret = true;
           }
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
//passチェック
/////////////////////////////////////////////////
function isPW(&$PW,$max,$min,$blank){
    $ret = false;
    //全角英数→半角英数変換
    $date = mb_convert_kana($PW,"r","UTF8");
    //変換後文字列長取得
   $len = strlen($PW);

   //タグ取り除き
   $str = Strip_Tags($PW);

   //変換後文字列長取得
   $len2 = strlen($PW);


   //入力チェック
   if($blank == 0){
    if($min <= $len and $len <= $max){
        if(preg_match('/[a-zA-Z0-9:-@_.]/', $PW)){

        $ret = true;
           }
       }
   }
   else{
    if($min <= $len and $len <= $max){
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
//ISBNチェック
/////////////////////////////////////////////////
function is_Book(&$book,$max,$min,$blank){
    $ret = false;
    //全角英数→半角英数変換
    $date = mb_convert_kana($book,"r","UTF8");
    //変換後文字列長取得
   $len = strlen($PW);

   //タグ取り除き
   $str = Strip_Tags($PW);

   //変換後文字列長取得
   $len2 = strlen($PW);


   //入力チェック
   if($blank == 0){
    if($min < $len and $len <= $max){
        if(!preg_match("/^\d{3}\-\d{10}+$/", $book)){
        $ret = true;
           }
       }
   }
   else{
    if($min < $len and $len <= $max){
     $ret = true;
    }
   }

   //入力チェック
   if($len != $len2){
     $ret = false;
   }

    return $ret;
 }

