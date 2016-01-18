<?
//****************************************************************************/
//*
//* 関数名 ：GetLogin
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で物件及び件数の集計を行う
//*
//****************************************************************************/
Function GetLogin($ActType, $Key1, $Key3, $Key4, &$dspOwnLogin) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "コネクションの確立OK";
//  echo $RetCode;


    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Login2($Key1, $Key3, $Key4, $dspOwnLogin, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }



//  echo "入力キー項目から物件情報を取得し認証するOK";
//  echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：GetLogin2
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で物件及び件数の集計を行う
//*
//****************************************************************************/
Function GetLogin2($ActType, $Key1, $Key2, $Key3, $Key4, &$dspOwnLogin) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "コネクションの確立OK";
//  echo $RetCode;

    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Login2($Key1, $Key2, $Key3, $Key4, $dspOwnLogin, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

  //echo " 入力キー項目からオーナー情報を取得し認証する";
  //echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：GetReport
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetReport($ActType, $Key1, $Key3, $Key4, &$dspReport) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "コネクションの確立OK";
//  echo $RetCode;


    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Report($Key1, $Key3, $Key4, $dspReport, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }



//  echo "入力キー項目から物件情報を取得し認証するOK";
//  echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}
//****************************************************************************/
//*
//* 関数名 ：GetReport
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetReportS($ActType, $Key1, $Key3, $Key4, $Key20, &$dspReportS) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

  //echo "コネクションの確立OK";
//  echo $RetCode;


    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_ReportS($Key1, $Key3, $Key4, $Key20, $dspReportS, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }





  //echo "入力キー項目から情報を取得し認証するOK";
//  echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}
//****************************************************************************/
//*
//* 関数名 ：GetReport
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetReport00($ActType, $Key1, $Key3, $Key4, $Key20, $Key21, &$dspReportS, &$dspReportM) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

  //echo "コネクションの確立OK";
//  echo $RetCode;


    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_ReportS($Key1, $Key3, $Key4, $Key20, $dspReportS, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_ReportM($Key3, $Key21, $dspReportM, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }




//  echo "入力キー項目から情報を取得し認証するOK";
//  echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：GetReport
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetReportU($ActType, $Key1, $Key3, $Key20) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

  //echo "コネクションの確立OK";
//  echo $RetCode;



    $Ret = Get_ReportU($Key1, $Key3, $Key20, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }





  //echo "入力キー項目から情報を取得し認証するOK";
//  echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：GetPay
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetPay($ActType, $Key1, $Key3, $Key4, &$dspPay) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

 // echo "アクションタイプのチェックOK";
 // echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "コネクションの確立OK";
//  echo $RetCode;

    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Pay($Key1, $Key3, $Key4, $dspPay, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

//echo " 入力キー項目からオーナー情報を取得し認証する";
//echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：GetPay
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetRec01($ActType, $Key1, $Key3, $Key4, &$dspRec01) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "コネクションの確立OK";
//  echo $RetCode;

    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Rec01($Key1, $Key3, $Key4, $dspRec01, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

//echo " 入力キー項目からオーナー情報を取得し認証する";
//echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}
//****************************************************************************/
//*
//* 関数名 ：GetPay
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetRec02($ActType, $Key1, $Key3, $Key4, &$dspRec02) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

  echo "アクションタイプのチェックOK";
 echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

  echo "コネクションの確立OK";
  echo $RetCode;

    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Rec02($Key1, $Key3, $Key4, $dspRec02, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

//echo " 入力キー項目からオーナー情報を取得し認証する";
//echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}
//****************************************************************************/
//*
//* 関数名 ：GetPay
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetRec03($ActType, $Key1, $Key3, $Key4, $Key20, &$dspRec03) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

  echo "アクションタイプのチェックOK";
 echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

  echo "コネクションの確立OK";
  echo $RetCode;

    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Rec03($Key1, $Key3, $Key4, $Key20, $dspRec03, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

//echo " 入力キー項目からオーナー情報を取得し認証する";
//echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}


//****************************************************************************/
//*
//* 関数名 ：Get_Login
//* 引数   ：$Key1           物件番号
//*        ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspOwnLogin     オーナー情報取得）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で物件の検索を行う
//*
//****************************************************************************/
Function Get_Login($Key1, $Key3, $Key4, &$dspOwnLogin, $ID) {
    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select tenrusu05.bid, tenrusu00.control, tenrusu05.ownercd";
			$strSQL = $strSQL. " From tenrusu00, tenrusu05";
			$strSQL = $strSQL. " Where tenrusu05.bid = tenrusu00.bid";
	}
	
    if (is_null($Key1) == True) {
        //$strSQL = $strSQL. " Where ThingNum IS NULL";
        $strSQL = $strSQL. " And tenrusu05.bid IS NULL";
    } else {
        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
        $strSQL = $strSQL. " And tenrusu05.bid = '". $Key1. "'";

    }

    if (is_null($Key4) == True) {
        //$strSQL = $strSQL. " And HopeLentName Is NULL";
        $strSQL = $strSQL. " And tenrusu05.ownercd Is NULL";
    } else {
					//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
        $strSQL = $strSQL. " And tenrusu05.ownercd = '". $Key4. "'";
    }

    // SQL実行
    // echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // データ取得
            $array = pg_fetch_array($sqlID);

            if ($array == False) {
                // システムエラー
                $RetCode = 2;
            } else {
                // 表示用データの収集
                $dspOwnLogin[0] = $array["bid"];
                //$dspOwnLogin[1] = $array["control"];
                //$dspOwnLogin[2] = $array["ownercd"];
               // $dspOwnLogin[1] = array_merge($array["control"], $array["ownercd"]);
            }
        }

        // 開放
        pg_freeresult($sqlID);
    }

    return $RetCode;

}
//****************************************************************************/
//*
//* 関数名 ：Get_Login2
//* 引数   ：$Key1           物件番号
//*        ：$Key2           パスワード
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナーコード)
//*        ：$dspOwnLogin     オーナー情報取得）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で物件の検索を行う
//*
//****************************************************************************/
Function Get_Login2($Key1, $Key2, $Key3, $Key4, &$dspOwnLogin, $ID) {
    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select * From tenrusu05";
	}
	
	if (is_null($Key1) == True) {
		//$strSQL = $strSQL. " Where ThingNum IS NULL";
		$strSQL = $strSQL. " Where bid IS NULL";
	} else {
	//$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
	$strSQL = $strSQL. " Where bid = '". $Key1. "'";

	}

	if (is_null($Key4) == True) {
		//$strSQL = $strSQL. " And HopeLentName Is NULL";
		$strSQL = $strSQL. " And ownercd Is NULL";
	} else {
		//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
		$strSQL = $strSQL. " And ownercd = '". $Key4. "'";
	}

	// SQL実行
//	echo $strSQL;
	$sqlID = pg_exec($ID, $strSQL);

	if ($sqlID == False) {
		// システムエラー
		$RetCode = 2;
	} else {
		if (pg_num_rows($sqlID) == 0) {
			// 認証エラー
			$RetCode = 1;
		} else {
			// データ取得
			$array = pg_fetch_array($sqlID);

			if ($array == False) {
				// システムエラー
				$RetCode = 2;
			} else {
				// 表示用データの収集
				$dspOwnLogin[0] = $array["bid"];
				$dspOwnLogin[1] = $array["ownercd"];
				$dspOwnLogin[2] = $array["owner"];
			}
		}

		// 開放
		pg_freeresult($sqlID);

	}

//	echo "tenrusu05";
	//echo $RetCode;

	// 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
		$strSQL = "Select * From tenrusu00";
	}
	
	if (is_null($Key1) == True) {
		//$strSQL = $strSQL. " Where ThingNum IS NULL";
		$strSQL = $strSQL. " Where bid IS NULL";
	} else {
		//$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
		$strSQL = $strSQL. " Where bid = '". $Key1. "'";
	}

	// SQL実行
	//echo $strSQL;
	$sqlID = pg_exec($ID, $strSQL);

	if ($sqlID == False) {
		// システムエラー
		$RetCode = 2;
	} else {
		if (pg_num_rows($sqlID) == 0) {
			// 認証エラー
			$RetCode = 1;
		} else {
			// データ取得
			$array = pg_fetch_array($sqlID);

			if ($array == False) {
				// システムエラー
				$RetCode = 2;
			} else {
				// 表示用データの収集
				$dspOwnLogin[3] = $array["control"];
				$dspOwnLogin[4] = $array["add"];
				$dspOwnLogin[5] = $array["bname"];
			}
		}

		// 開放
		pg_freeresult($sqlID);
	}


	return $RetCode;

}
//****************************************************************************/
//*
//* 関数名 ：GetTrans
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告情報を取得
//*
//****************************************************************************/
Function GetTrans($ActType, $Key1, $Key3, $Key4, &$dspTrans, &$dspTrans00, &$dspTrans02, &$dspTrans03, &$dspTransL, &$dspTransL00, &$dspTransL02, &$dspTransL03) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "コネクションの確立OK";
//  echo $RetCode;


    $Ret = Get_Trans($Key1, $Key3, $Key4, $dspTrans, $dspTrans00, $dspTrans02, $dspTrans03, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

    $Ret = Get_TransL($Key1, $Key3, $Key4, $dspTransL, $dspTransL00, $dspTransL02, $dspTransL03, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

//  echo "入力キー項目から物件情報を取得し認証するOK";
//  echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}


//****************************************************************************/
//*
//* 関数名 ：GetThingInfo
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key2           地域(東京・大阪)
//*        ：$Key3           
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//*        ：$dspActCnt      当月件数（参照渡し）
//*        ：$dspOldCnt      過去件数（参照渡し）
//*        ：$dspOwnPro      案内結果（参照渡し）
//*        ：$dspOwnGui      ご提案　（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で物件及び件数の集計を行う
//*
//****************************************************************************/
Function GetThingInfo($ActType, $Key1, $Key2, $Key3, $Key4, &$dspOwnInfo, &$dspActCnt, &$dspOldCnt, &$dspOwnPro, &$dspOwnGui) {

    // 初期値設定
    $RetCode = 0;
    $Type = "";

//    $Type = SubStr($Key4,0,1);    //東京:1　大阪:2
    $Type = $Key2;    //東京:1　大阪:2
    //echo $Type;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//echo "アクションタイプのチェックOK";
//echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//echo "コネクションの確立OK";
//echo $RetCode;

//  echo " Key1 : ";
//  echo $Key1;
//  echo " Key3 : ";
//  echo $Key3;
//  echo " Key4 : ";
//  echo $Key4;

    // 入力キー項目から物件情報を取得し認証する
    $Ret = Get_ThingData($Key1, $Key3, $Key4, $dspOwnInfo, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

//echo "入力キー項目から物件情報を取得し認証するOK";
//echo $RetCode;

    $Key5 = $dspOwnInfo[21];

//echo $Key5;
//echo $Type;

    if ($RetCode == 0) {
        // 物件番号から当月の件数を取得し認証する
	$Ret = Get_CountAct4($Key5, $Type, $dspActCnt, $ID);
        if ($Ret != 0) {
            if ($Ret == 1) {
                // 認証エラー
                $RetCode = 1;
            } else {
                // システムエラー
                $RetCode = 2;
            }
        }
    }

//echo "物件番号から当月の件数を取得し認証するOK";
//echo $RetCode;

    if ($RetCode == 0) {
        // 物件番号から過去の件数を取得し認証する
       $Ret = Get_CountOld3($Key5, $Key3, $Type, $dspOldCnt, $ID);
        if ($Ret != 0) {
            if ($Ret == 1) {
                // 認証エラー
                $RetCode = 1;
            } else {
                // システムエラー
                $RetCode = 2;
            }
        }
    }

//echo "物件番号から過去の件数を取得し認証するOK";
//echo $RetCode;


//    echo $dspOldCnt[0][0];
//    echo $dspOldCnt[0][1];
//    echo $dspOldCnt[0][2];
//    echo $dspOldCnt[1][0];
//    echo $dspOldCnt[1][1];
//    echo $dspOldCnt[1][2];


    // DBクローズ
    pg_close($ID);

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：GetThingInfo2
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Key4           オーナー番号
//*        ：$dspOwnInfo     物件情報（参照渡し）
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で物件及び件数の集計を行う
//*
//****************************************************************************/
Function GetThingInfo2($ActType, $Key1, $Key3, $Key4, &$dspOwnInfo) {

    // 初期値設定
    $RetCode = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "アクションタイプのチェックOK";
//  echo $RetCode;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $RetCode = 2;
        return $RetCode;
    }

//  echo "コネクションの確立OK";
//  echo $RetCode;


    // 入力キー項目から物件情報を取得し認証する
    $Ret = Get_ThingData($Key1, $Key3, $Key4, $dspOwnInfo, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $RetCode = 1;
        } else {
            // システムエラー
            $RetCode = 2;
        }
    }

//  echo "入力キー項目から物件情報を取得し認証するOK";
//  echo $RetCode;

    // DBクローズ
    pg_close($ID);

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：Get_ThingData
//* 引数   ：$Key1           物件番号
//*        ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspOwnInfo     物件情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で物件の検索を行う
//*
//****************************************************************************/
Function Get_ThingData($Key1, $Key3, $Key4, &$dspOwnInfo, $ID) {

    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
		if ($Key3 == "Tokyo") {
			$strSQL = "Select * From VJ301_ThingInfo";
		} else if ($Key3 == "Osaka") {
			$strSQL = "Select * From VJ401_ThingInfo";
		} else if ($Key3 == "RISE") {
			$strSQL = "Select * From VJ501_ThingInfo";
		} else {
			// システムエラー
			$RetCode = 2;
			return $RetCode;
		}
	}
	
    if (is_null($Key1) == True) {
        $strSQL = $strSQL. " Where ThingNum IS NULL";
    } else {
        $strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";

    }

    if (is_null($Key4) == True) {
        $strSQL = $strSQL. " And HopeLentName Is NULL";
    } else {
	$abc = SubStr($Key4,0,7);
	$strSQL = $strSQL. " And HopeLentName like '%". $abc. "%'";
    }

    // SQL実行
    //echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            //$RetCode = 1;
            $RetCode = 0;

        } else {
            // データ取得
            $array = pg_fetch_array($sqlID);

            if ($array == False) {
                // システムエラー
                $RetCode = 2;
            } else {
                // 表示用データの収集
                $dspOwnInfo[0] = $array["owname"];
                $dspOwnInfo[1] = $array["thingaddr"];
                $dspOwnInfo[2] = $array["staline"];
                $dspOwnInfo[3] = $array["staname"];
								$dspOwnInfo[4] = $array["houserent"];
								$dspOwnInfo[5] = $array["houseserv"];
                $dspOwnInfo[6] = $array["housereward"];
                $dspOwnInfo[7] = $array["housedeposit"];
                $dspOwnInfo[8] = $array["systemname"];
                $dspOwnInfo[9] = $array["lentterm"];
                $dspOwnInfo[10] = $array["yearform"];
                $dspOwnInfo[11] = $array["hopelentname"];


								$dspOwnInfo[12] = $array["rehome"];
								$dspOwnInfo[13] = $array["smoke"];
								$dspOwnInfo[14] = $array["child"];
								$dspOwnInfo[15] = $array["dog"];


                //****************************************************************************/
                //*　物件名　部屋番号　表示用
                //****************************************************************************/
                $dspOwnInfo[16] = $array["thingname"];
                $dspOwnInfo[17] = $array["roomno"];
                $dspOwnInfo[18] = $array["piano"];
                $dspOwnInfo[19] = $array["keika"];
                $dspOwnInfo[20] = $array["cangeday"];
                $dspOwnInfo[21] = $array["thingnum"];
                if ($array["owkana"] == 0) {
                    $dspOwnInfo[22] = "不可";
                } else {
                    $dspOwnInfo[22] = "可";
                }
            }
        }

        // 開放
        pg_freeresult($sqlID);
    }
//echo $dspOwnInfo[1];
//echo $dspOwnInfo[16];

    return $RetCode;

}

//****************************************************************************/
//*
//* 関数名 ：Get_CountAct2
//* 引数   ：$Key1           物件番号
//*        ：$dspActCnt      件数情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で当月件数の集計を行う(大阪)
//*
//****************************************************************************/
Function Get_CountAct2($Key1, &$dspActCnt, $ID) {

    // 初期値設定
    $RetCode = 0;

    // 初期化
    for($i=0; $i<=1; $i++) {
        for($j=0; $j<=5; $j++) {
            if ($i == 0) {
                $dspActCnt[$i][$j] = "0";
            } else {
                $dspActCnt[$i][$j] = 0;
            }
        }
    }

    // SQL条件文作成
    if (is_null($Key1) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key1. "'";
    }

    // 日付（先月末）取得
    if ( Date("d") == "01" ) {
      $tempdate = mktime(0, 0, 0, (Date("m") - 1), 0, Date("Y"));
    } else {
      $tempdate = mktime(0, 0, 0, Date("m"), 0, Date("Y"));
    }

      $strWhSQL2 = $strWhSQL. " And CntDate > '". Date("Y/m/d", $tempdate). "' And CntDate < '". Date("Y/m/d"). "'";
    $strWhSQL3 = $strWhSQL. " And FrCntDate > '". Date("Y/m/d", $tempdate). "' And FrCntDate < '". Date("Y/m/d"). "'";

    // 反響紹介数SQL生成
    $strSQL = "Select * From J411_RespCnt". $strWhSQL2;

    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 反響紹介数の収集
            while($array = pg_fetch_array($sqlID)) {
                // Nullチェック
                if ($array["cntdate"] == Date("Y/m/d", strtotime("-1 day"))) {
                    if (is_null($array["respcnt"]) == True) {
                        $dspActCnt[0][3] = "0";
                    } else {
                        $dspActCnt[0][3] = $array["respcnt"];
                    }

                    if (is_null($array["introcnt"]) == True) {
                        $dspActCnt[0][4] = "0";
                    } else {
                        $dspActCnt[0][4] = $array["introcnt"];
                    }
                }

                if (is_null($array["respcnt"]) == True) {
                    $dspActCnt[1][3] = $dspActCnt[1][3] + "0";
                } else {
                    $dspActCnt[1][3] = $dspActCnt[1][3] + $array["respcnt"];
                }

                if (is_null($array["introcnt"]) == True) {
                    $dspActCnt[1][4] = $dspActCnt[1][4] + "0";
                } else {
                    $dspActCnt[1][4] = $dspActCnt[1][4] + $array["introcnt"];
                }

                if (is_null($array["prescnt"]) == True) {
                    $dspActCnt[1][5] = $dspActCnt[1][5] + "0";
                } else {
                    $dspActCnt[1][5] = $dspActCnt[1][5] + $array["prescnt"];
                }
            }

            // 開放
            pg_freeresult($sqlID);

		}
	}

    // インターネット数（ISIZE）SQL生成
    $strSQL = "Select * From J413_IsizeCnt". $strWhSQL2;

    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
		// システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
    	    // 認証エラー
            $RetCode = 0;
        } else {
            // ISIZE数の収集
            while($array = pg_fetch_array($sqlID)) {
        	    if ($array["cntdate"] == Date("Y/m/d", strtotime("-1 day"))) {
					if (is_null($array["hitcnt"]) == True) {
						$dspActCnt[0][0] = "0";
					} else {
						$dspActCnt[0][0] = $array["hitcnt"];
					}
					
					if (is_null($array["hitcnt2"]) == True) {
						$dspActCnt[0][1] = "0";
					} else {
						$dspActCnt[0][1] = $array["hitcnt2"];
					}
					
					if (is_null($array["mailcnt"]) == True) {
						$dspActCnt[0][2] = "0";
					} else {
						$dspActCnt[0][2] = $array["mailcnt"];
					}
                }
				
				if (is_null($array["hitcnt"]) == True) {
					$dspActCnt[1][0] = $dspActCnt[1][0] + "0";
				} else {
					$dspActCnt[1][0] = $dspActCnt[1][0] + $array["hitcnt"];
				}
				
				if (is_null($array["hitcnt2"]) == True) {
					$dspActCnt[1][1] = $dspActCnt[1][1] + "0";
				} else {
					$dspActCnt[1][1] = $dspActCnt[1][1] + $array["hitcnt2"];
				}
				
				if (is_null($array["mailcnt"]) == True) {
					$dspActCnt[1][2] = $dspActCnt[1][2] + "0";
				} else {
					$dspActCnt[1][2] = $dspActCnt[1][2] + $array["mailcnt"];
				}
            }

            // 開放
            pg_freeresult($sqlID);

		}
	}

    return $RetCode;

}


//****************************************************************************/
//*
//* 関数名 ：Get_CountAct3
//* 引数   ：$Key1           物件番号
//*        ：$dspActCnt      件数情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で当月件数の集計を行う(新東京)
//*
//****************************************************************************/
Function Get_CountAct3($Key1, &$dspActCnt, $ID) {

    // 初期値設定
    $RetCode = 0;

    // 初期化
    for($i=0; $i<=1; $i++) {
        for($j=0; $j<=5; $j++) {
            if ($i == 0) {
                $dspActCnt[$i][$j] = "0";
            } else {
                $dspActCnt[$i][$j] = 0;
            }
        }
    }


    $InitDate = Date("Y/m/d");


    $work1 = SubStr($InitDate, 0, 4);
    $work2 = SubStr($InitDate, 5, 2);
    $work3 = SubStr($InitDate, 8, 2);
    $tempdate2 = mktime(0, 0, 0, $work2, (Date("$work3") + 7), $work1);

//  echo $work1;
//  echo $work2;
//  echo $work3;
//  echo Date("Y/m/d", $tempdate2);


    // SQL条件文作成
    if (is_null($Key1) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key1. "'";
    }

    $strWhSQL2 = $strWhSQL. " And CntDate like '". $work1 ."/". $work2 ."%'";

    // 反響紹介数SQL生成
    $strSQL = "Select * From J311_RespCnt". $strWhSQL2;


//  echo $strSQL;


    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 反響紹介数の収集
            while($array = pg_fetch_array($sqlID)) {
                // Nullチェック

                if (is_null($array["respcnt"]) == True) {
                    $dspActCnt[0][3] = $dspActCnt[0][3] + "0";
                } else {
                    $dspActCnt[0][3] = $dspActCnt[0][3] + $array["respcnt"];
                }

                if (is_null($array["introcnt"]) == True) {
                    $dspActCnt[0][4] = $dspActCnt[0][4] + "0";
                } else {
                    $dspActCnt[0][4] = $dspActCnt[0][4] + $array["introcnt"];
                }

                if (is_null($array["prescnt"]) == True) {
                    $dspActCnt[0][5] = $dspActCnt[0][5] + "0";
                } else {
                    $dspActCnt[0][5] = $dspActCnt[0][5] + $array["prescnt"];
                }
            }

            // 開放
            pg_freeresult($sqlID);

		}
	}


//  echo $dspActCnt[0][3];
//  echo $dspActCnt[0][4];
//  echo $dspActCnt[0][5];
//  echo $RetCode;


    // インターネット数（ISIZE）SQL生成
    $strSQL = "Select * From J313_IsizeCnt". $strWhSQL2;


//  echo $strSQL;


    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
		// システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
    	    // 認証エラー
            $RetCode = 0;
        } else {
            // ISIZE数の収集
            while($array = pg_fetch_array($sqlID)) {
				
				if (is_null($array["hitcnt"]) == True) {
					$dspActCnt[0][0] = $dspActCnt[0][0] + "0";
				} else {
					$dspActCnt[0][0] = $dspActCnt[0][0] + $array["hitcnt"];
				}
				
				if (is_null($array["hitcnt2"]) == True) {
					$dspActCnt[0][1] = $dspActCnt[0][1] + "0";
				} else {
					$dspActCnt[0][1] = $dspActCnt[0][1] + $array["hitcnt2"];
				}
				
				if (is_null($array["mailcnt"]) == True) {
					$dspActCnt[0][2] = $dspActCnt[0][2] + "0";
				} else {
					$dspActCnt[0][2] = $dspActCnt[0][2] + $array["mailcnt"];
				}
            }

            // 開放
            pg_freeresult($sqlID);

		}
	}


//  echo $dspActCnt[0][0];
//  echo $dspActCnt[0][1];
//  echo $dspActCnt[0][2];
//  echo $RetCode;


//    // SQL条件文作成
//    if (is_null($Key1) == True) {
//        $strWhSQL = " Where ThingNum IS NULL";
//    } else {
//        $strWhSQL = " Where ThingNum = '". $Key1. "'";
//    }

//    // 日付（先月末）取得
//    if ( Date("d") == "01" ) {
//      $tempdate = mktime(0, 0, 0, (Date("m") - 1), 0, Date("Y"));
//    } else {
//      $tempdate = mktime(0, 0, 0, Date("m"), 0, Date("Y"));
//    }

//    $strWhSQL2 = $strWhSQL. " And CntDate > '". Date("Y/m/d", $tempdate). "' And CntDate < '". Date("Y/m/d"). "'";
//    $strWhSQL3 = $strWhSQL. " And FrCntDate > '". Date("Y/m/d", $tempdate). "' And FrCntDate < '". Date("Y/m/d"). "'";

//    // 反響紹介数SQL生成
//    $strSQL = "Select * From J311_RespCnt". $strWhSQL2;

//    // SQL実行
//    $sqlID = pg_exec($ID, $strSQL);

//    if ($sqlID == False) {
//        // システムエラー
//        $RetCode = 2;
//    } else {
//        if (pg_num_rows($sqlID) == 0) {
//            // 認証エラー
//            $RetCode = 0;
//        } else {
//            // 反響紹介数の収集
//            while($array = pg_fetch_array($sqlID)) {

//                if (is_null($array["respcnt"]) == True) {
//                    $dspActCnt[1][3] = $dspActCnt[1][3] + "0";
//                } else {
//                    $dspActCnt[1][3] = $dspActCnt[1][3] + $array["respcnt"];
//                }

//                if (is_null($array["introcnt"]) == True) {
//                    $dspActCnt[1][4] = $dspActCnt[1][4] + "0";
//                } else {
//                    $dspActCnt[1][4] = $dspActCnt[1][4] + $array["introcnt"];
//                }

//                if (is_null($array["prescnt"]) == True) {
//                    $dspActCnt[1][5] = $dspActCnt[1][5] + "0";
//                } else {
//                    $dspActCnt[1][5] = $dspActCnt[1][5] + $array["prescnt"];
//                }
//            }

//            // 開放
//            pg_freeresult($sqlID);

//		}
//	}

//    // インターネット数（ISIZE）SQL生成
//    $strSQL = "Select * From J313_IsizeCnt". $strWhSQL2;

//    // SQL実行
//    $sqlID = pg_exec($ID, $strSQL);

//    if ($sqlID == False) {
//		// システムエラー
//        $RetCode = 2;
//    } else {
//        if (pg_num_rows($sqlID) == 0) {
//    	    // 認証エラー
//            $RetCode = 0;
//        } else {
//            // ISIZE数の収集
//            while($array = pg_fetch_array($sqlID)) {
//				
//				if (is_null($array["hitcnt"]) == True) {
//					$dspActCnt[1][0] = $dspActCnt[1][0] + "0";
//				} else {
//					$dspActCnt[1][0] = $dspActCnt[1][0] + $array["hitcnt"];
//				}
//				
//				if (is_null($array["hitcnt2"]) == True) {
//					$dspActCnt[1][1] = $dspActCnt[1][1] + "0";
//				} else {
//					$dspActCnt[1][1] = $dspActCnt[1][1] + $array["hitcnt2"];
//				}
//				
//				if (is_null($array["mailcnt"]) == True) {
//					$dspActCnt[1][2] = $dspActCnt[1][2] + "0";
//				} else {
//					$dspActCnt[1][2] = $dspActCnt[1][2] + $array["mailcnt"];
//				}
//            }

//            // 開放
//            pg_freeresult($sqlID);

//		}
//	}

    return $RetCode;

}


//****************************************************************************/
//*
//* 関数名 ：Get_CountAct4
//* 引数   ：$Key5           物件番号
//*        ：$Type           地域(東京:1・大阪:2)
//*        ：$dspActCnt      件数情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で当月件数の集計を行う(新東京)
//*
//****************************************************************************/
Function Get_CountAct4($Key5, $Type, &$dspActCnt, $ID) {

    // 初期値設定
    $RetCode = 0;

    // 初期化
    for($i=0; $i<=1; $i++) {
        for($j=0; $j<=5; $j++) {
            if ($i == 0) {
                $dspActCnt[$i][$j] = "0";
            } else {
                $dspActCnt[$i][$j] = 0;
            }
        }
    }


    $InitDate = Date("Y/m/d");


    $work1 = SubStr($InitDate, 0, 4);
    $work2 = SubStr($InitDate, 5, 2);
    $work3 = SubStr($InitDate, 8, 2);
    $tempdate2 = mktime(0, 0, 0, $work2, (Date("$work3") + 7), $work1);

//  echo $work1;
//  echo $work2;
//  echo $work3;
//  echo Date("Y/m/d", $tempdate2);


    // SQL条件文作成
    if (is_null($Key5) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key5. "'";
    }

    $strWhSQL = $strWhSQL. " And Area = '". $Type. "'";
    $strWhSQL2 = $strWhSQL. " And CntDate like '". $work1 ."/". $work2 ."%'";

    // 反響紹介数SQL生成
    $strSQL = "Select * From J501_DayCnt". $strWhSQL2;


//echo $strSQL;


    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 反響紹介数の収集
            while($array = pg_fetch_array($sqlID)) {
                // Nullチェック

                if (is_null($array["respcnt"]) == True) {
                    $dspActCnt[0][3] = $dspActCnt[0][3] + "0";
                } else {
                    $dspActCnt[0][3] = $dspActCnt[0][3] + $array["respcnt"];
                }

                if (is_null($array["introcnt"]) == True) {
                    $dspActCnt[0][4] = $dspActCnt[0][4] + "0";
                } else {
                    $dspActCnt[0][4] = $dspActCnt[0][4] + $array["introcnt"];
                }

//                if (is_null($array["prescnt"]) == True) {
//                    $dspActCnt[0][5] = $dspActCnt[0][5] + "0";
//                } else {
//                    $dspActCnt[0][5] = $dspActCnt[0][5] + $array["prescnt"];
//                }
            }

            // 開放
            pg_freeresult($sqlID);

		}
	}


//  echo $dspActCnt[0][3];
//  echo $dspActCnt[0][4];
//  echo $dspActCnt[0][5];
 // echo $RetCode;


    return $RetCode;

}


//****************************************************************************/
//*
//* 関数名 ：Get_CountOld
//* 引数   ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspOldCnt      件数情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で過去件数の集計を行う
//*
//****************************************************************************/
Function Get_CountOld($Key1, $Key3, &$dspOldCnt, $ID) {

    // 初期値設定
    $RetCode = 0;

    // 日付取得（6ヶ月前）
    $dtWorkDate = Date("Y/m/d", strtotime("-6 month"));

    // 年取得（1ヶ月前）
    $year = Substr(Date("Y/m/d", strtotime("-1 month")), 0, 4);

    for($i=0; $i<=5; $i++) {
        if ($year == Substr($dtWorkDate, 0, 4)) {
            $dspOldCnt[0][$i] = Substr($dtWorkDate, 0, 4). "年";
        } else {
            $dspOldCnt[0][$i] = Substr($dtWorkDate, 0, 4). "年/". Date("Y"). "年";
        }

        $tempdate = mktime(0, 0, 0, Substr($dtWorkDate, 5, 2) + $i, Substr($dtWorkDate, 8, 2), Substr($dtWorkDate, 0, 4));
        $dspOldCnt[1][$i] = Date("m", $tempdate);
    }

    for($i=2; $i<=7; $i++) {
        for($j=0; $j<=5; $j++) {
            $dspOldCnt[$i][$j] = "0";
        }
    }

    // SQL条件文作成
    if (is_null($Key1) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key1. "'";
    }

    $strWhSQL = $strWhSQL. " And CntDate >= '". Substr($dtWorkDate, 0, 7). "/01'";
    $strWhSQL = $strWhSQL. " And CntDate < '". Date("Y/m"). "/01'";

    // 月次カウント数SQL生成
	if ($Key3 == "Tokyo") {
		$strSQL = "Select * From J321_MonthCnt". $strWhSQL. " Order by ThingNum, CntDate";
	} else if($Key3 == "Osaka") {
		$strSQL = "Select * From J421_MonthCnt". $strWhSQL. " Order by ThingNum, CntDate";
	} else {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	}
	
    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 月次カウント数の収集
            while($array = pg_fetch_array($sqlID)) {
                for($i=0; $i<=5; $i++) {
                    // Nullチェック
                    if (Substr($array["cntdate"], 5, 2) == $dspOldCnt[1][$i]) {
                        if (is_null($array["respcnt"]) == True) {
                            $dspOldCnt[2][$i] = "0";
                        } else {
                            $dspOldCnt[2][$i] = $array["respcnt"];
                        }

                        if (is_null($array["introcnt"]) == True) {
                            $dspOldCnt[3][$i] = "0";
                        } else {
                            $dspOldCnt[3][$i] = $array["introcnt"];
                        }

                        if (is_null($array["guidecnt"]) == True) {
                            $dspOldCnt[4][$i] = "0";
                        } else {
                            $dspOldCnt[4][$i] = $array["guidecnt"];
                        }

                        if (is_null($array["ihitcnt"]) == True) {
                            $temp = "0";
                        } else {
                            $temp = $array["ihitcnt"];
                        }

                        if (is_null($array["ahitcnt"]) == True) {
                            $temp2 = "0";
                        } else {
                            $temp2 = $array["ahitcnt"];
                        }

                        $dspOldCnt[5][$i] = (int) $temp + (int) $temp2;

                        if (is_null($array["imailcnt"]) == True) {
                            $temp = "0";
                        } else {
                            $temp = $array["imailcnt"];
                        }

                        if (is_null($array["amailcnt"]) == True) {
                            $temp2 = "0";
                        } else {
                            $temp2 = $array["amailcnt"];
                        }

                        $dspOldCnt[6][$i] = (int) $temp + (int) $temp2;

                        if (is_null($array["ihitcnt2"]) == True) {
                            $dspOldCnt[7][$i] = "0";
                        } else {
                            $dspOldCnt[7][$i] = $array["ihitcnt2"];
                        }
                    }
                }
            }
        }
    }

    return $RetCode;

}




//****************************************************************************/
//*
//* 関数名 ：Get_CountOld2
//* 引数   ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspOldCnt      件数情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で過去件数の集計を行う
//*
//****************************************************************************/
Function Get_CountOld2($Key1, $Key3, &$dspOldCnt, $ID) {

    // 初期値設定
    $RetCode = 0;


    // 年月取得（1ヶ月前）
    $work1 = Substr(Date("Y/m/d", strtotime("-1 month")), 0, 7);
//    echo $work1;
    // 年月取得（2ヶ月前）
    $work2 = Substr(Date("Y/m/d", strtotime("-2 month")), 0, 7);
//    echo $work2;


    for($i=0; $i<=1; $i++) {
        for($j=0; $j<=2; $j++) {
            $dspOldCnt[$i][$j] = "0";
        }
    }

    // SQL条件文作成
    if (is_null($Key1) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key1. "'";
    }

    $strWhSQL = $strWhSQL. " And CntDate = '". $work1 . "/01'";

    // 月次カウント数SQL生成
	if ($Key3 == "Tokyo") {
		$strSQL = "Select * From J321_MonthCnt". $strWhSQL ;
	} else {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	}
	


//  echo $strSQL;


    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 月次カウント数の収集
            while($array = pg_fetch_array($sqlID)) {
                if (is_null($array["respcnt"]) == True) {
                    $dspOldCnt[0][0] = "0";
                } else {
                    $dspOldCnt[0][0] = $array["respcnt"];
                }

                if (is_null($array["introcnt"]) == True) {
                    $dspOldCnt[0][1] = "0";
                } else {
                    $dspOldCnt[0][1] = $array["introcnt"];
                }

                if (is_null($array["ihitcnt2"]) == True) {
                    $temp1 = "0";
                } else {
                    $temp1 = $array["ihitcnt2"];
                }

                if (is_null($array["ahitcnt"]) == True) {
                    $temp2 = "0";
                } else {
                    $temp2 = $array["ahitcnt"];
                }

                $dspOldCnt[0][2] = (int) $temp + (int) $temp2;

            }
        }
    }


//    echo $dspOldCnt[0][0];
//    echo $dspOldCnt[0][1];
//    echo $dspOldCnt[0][2];


    // SQL条件文作成
    if (is_null($Key1) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key1. "'";
    }

    $strWhSQL = $strWhSQL. " And CntDate = '". $work2 . "/01'";

    // 月次カウント数SQL生成
	if ($Key3 == "Tokyo") {
		$strSQL = "Select * From J321_MonthCnt". $strWhSQL ;
	} else {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	}
	


//  echo $strSQL;


    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 月次カウント数の収集
            while($array = pg_fetch_array($sqlID)) {
                if (is_null($array["respcnt"]) == True) {
                    $dspOldCnt[1][0] = "0";
                } else {
                    $dspOldCnt[1][0] = $array["respcnt"];
                }

                if (is_null($array["introcnt"]) == True) {
                    $dspOldCnt[1][1] = "0";
                } else {
                    $dspOldCnt[1][1] = $array["introcnt"];
                }

                if (is_null($array["ihitcnt2"]) == True) {
                    $temp1 = "0";
                } else {
                    $temp1 = $array["ihitcnt2"];
                }

                if (is_null($array["ahitcnt"]) == True) {
                    $temp2 = "0";
                } else {
                    $temp2 = $array["ahitcnt"];
                }

                $dspOldCnt[1][2] = (int) $temp + (int) $temp2;

            }
        }
    }


//    echo $dspOldCnt[1][0];
//    echo $dspOldCnt[1][1];
//    echo $dspOldCnt[1][2];


    return $RetCode;

}




//****************************************************************************/
//*
//* 関数名 ：Get_CountOld3
//* 引数   ：$Key5           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$Type           地域(東京:1・大阪:2)
//*        ：$dspOldCnt      件数情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件情報検索で過去件数の集計を行う
//*
//****************************************************************************/
Function Get_CountOld3($Key5, $Key3, $Type, &$dspOldCnt, $ID) {

    // 初期値設定
    $RetCode = 0;


    // 年月取得（1ヶ月前）
    $work1 = Substr(Date("Y/m/d", strtotime("-1 month")), 0, 7);
//    echo $work1;
    // 年月取得（2ヶ月前）
    $work2 = Substr(Date("Y/m/d", strtotime("-2 month")), 0, 7);
//    echo $work2;


    for($i=0; $i<=1; $i++) {
        for($j=0; $j<=2; $j++) {
            $dspOldCnt[$i][$j] = "0";
        }
    }

    // SQL条件文作成
    if (is_null($Key5) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key5. "'";
    }

    $strWhSQL = $strWhSQL. " And Area = '". $Type. "'";
    $strWhSQL = $strWhSQL. " And CntDate = '". $work1 . "/01'";

    // 月次カウント数SQL生成
	if ($Key3 == "RISE") {
		$strSQL = "Select * From J521_MonthCnt". $strWhSQL ;
	} else {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	}
	


//  echo $strSQL;


    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 月次カウント数の収集
            while($array = pg_fetch_array($sqlID)) {
                if (is_null($array["respcnt"]) == True) {
                    $dspOldCnt[0][0] = "0";
                } else {
                    $dspOldCnt[0][0] = $array["respcnt"];
                }

                if (is_null($array["introcnt"]) == True) {
                    $dspOldCnt[0][1] = "0";
                } else {
                    $dspOldCnt[0][1] = $array["introcnt"];
                }

//                if (is_null($array["ihitcnt2"]) == True) {
//                    $temp1 = "0";
//                } else {
//                    $temp1 = $array["ihitcnt2"];
//                }

//                if (is_null($array["ahitcnt"]) == True) {
//                    $temp2 = "0";
//                } else {
//                    $temp2 = $array["ahitcnt"];
//                }

//                $dspOldCnt[0][2] = (int) $temp + (int) $temp2;

            }
        }
    }


//    echo $dspOldCnt[0][0];
//    echo $dspOldCnt[0][1];
//    echo $dspOldCnt[0][2];


    // SQL条件文作成
    if (is_null($Key5) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key5. "'";
    }

    $strWhSQL = $strWhSQL. " And CntDate = '". $work2 . "/01'";

    // 月次カウント数SQL生成
	if ($Key3 == "RISE") {
		$strSQL = "Select * From J521_MonthCnt". $strWhSQL ;
	} else {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	}
	


//  echo $strSQL;


    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 月次カウント数の収集
            while($array = pg_fetch_array($sqlID)) {
                if (is_null($array["respcnt"]) == True) {
                    $dspOldCnt[1][0] = "0";
                } else {
                    $dspOldCnt[1][0] = $array["respcnt"];
                }

                if (is_null($array["introcnt"]) == True) {
                    $dspOldCnt[1][1] = "0";
                } else {
                    $dspOldCnt[1][1] = $array["introcnt"];
                }

//                if (is_null($array["ihitcnt2"]) == True) {
//                    $temp1 = "0";
//                } else {
//                    $temp1 = $array["ihitcnt2"];
//                }

//                if (is_null($array["ahitcnt"]) == True) {
//                    $temp2 = "0";
//                } else {
//                    $temp2 = $array["ahitcnt"];
//                }

//                $dspOldCnt[1][2] = (int) $temp + (int) $temp2;

            }
        }
    }


//    echo $dspOldCnt[1][0];
//    echo $dspOldCnt[1][1];
//    echo $dspOldCnt[1][2];


    return $RetCode;

}


//****************************************************************************/
//*
//* 関数名 ：Get_Proposal
//* 引数   ：$Key1           物件番号
//*        ：$dspOwnPro      提案情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件毎の提案状況を取得する
//*
//****************************************************************************/
Function Get_Proposal($ActType, $Key1, $Key3, $Key4, &$dspOwnPro, $ID) {

    // 初期値設定
    $RetCode = 0;

    // 初期化
    for($i=0; $i<=4; $i++) {
        for($j=0; $j<=3; $j++) {
            $dspOwnPro[$i][$j] = "";
        }
    }

    // SQL条件文作成
    if (is_null($Key1) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key1. "' ORDER BY prodate DESC";
    }

    // 提案SQL生成
    $strSQL = "Select * From J331_Proposal". $strWhSQL;

    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 提案内容の収集
	    $i = 0;
            while($array = pg_fetch_array($sqlID)) {
	        $dspOwnPro[$i][0] = $array["thingnum"];
	        $dspOwnPro[$i][1] = $array["prodate"];
	        $dspOwnPro[$i][2] = $array["proposal"];
	        $dspOwnPro[$i][3] = $array["proname"];
		$i=$i+1;
            }
	}
    }

    // 開放
    pg_freeresult($sqlID);

    return $RetCode;

}


//****************************************************************************/
//*
//* 関数名 ：Get_Guide
//* 引数   ：$Key1           物件番号
//*        ：$dspOwnGui      案内情報（参照渡し）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：物件毎の案内状況を取得する
//*
//****************************************************************************/
Function Get_Guide($Key1, &$dspOwnGui, $ID) {

    // 初期値設定
    $RetCode = 0;

    // 初期化
    for($i=0; $i<=4; $i++) {
        for($j=0; $j<=3; $j++) {
            $dspOwnGui[$i][$j] = "";
        }
    }

    // SQL条件文作成
    if (is_null($Key1) == True) {
        $strWhSQL = " Where ThingNum IS NULL";
    } else {
        $strWhSQL = " Where ThingNum = '". $Key1. "' ORDER BY guidate DESC";
    }

    // 提案SQL生成
    $strSQL = "Select * From J332_Guide". $strWhSQL;

    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // 提案内容の収集
	    $i = 0;
            while($array = pg_fetch_array($sqlID)) {
	        $dspOwnGui[$i][0] = $array["thingnum"];
	        $dspOwnGui[$i][1] = $array["guidate"];
	        $dspOwnGui[$i][2] = $array["guians"];
	        $dspOwnGui[$i][3] = $array["guicom"];
		$i=$i+1;
            }
	}
    }

    // 開放
    pg_freeresult($sqlID);

    return $RetCode;

}



//*****************************************************************************/
//* 関数名 ：GetReport
//* 引数   ：$Key1           物件番号
//*       ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspReport      報告情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告一覧の情報を取得する
//*
//****************************************************************************/
Function Get_Report($Key1, $Key3, $Key4, &$dspReport, $ID) {
    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select * From tenrusu10";
	}
	
	if (is_null($Key1) == True) {
		//$strSQL = $strSQL. " Where ThingNum IS NULL";
		$strSQL = $strSQL. " Where bid IS NULL";
	} else {
		//$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
		$strSQL = $strSQL. " Where bid = '". $Key1. "'";
	}
	//$strSQL = $strSQL. " And owneron = 0 ";
	$strSQL = $strSQL. " Order by tenrusu10.keisaidate desc";

//echo $strSQL;

    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {

		// 提案内容の収集
		$i = 0;

		while($array = pg_fetch_assoc($sqlID)) {
			$dspReport[$i][0] = $array["id"];
			$dspReport[$i][1] = $array["keisaidate"];
			$dspReport[$i][2] = $array["kenmei"];
			$dspReport[$i][3] = $array["pdf"];
			$dspReport[$i][4] = $array["syounin"];
			$dspReport[$i][5] = $array["code"];
			$dspReport[$i][6] = $array["genkeidate"];
			$dspReport[$i][7] = $array["itakuno"];
			$dspReport[$i][8] = $array["ownerdate"];
			$i=$i+1;
			
		}

	}
    }

    // 開放
    pg_freeresult($sqlID);


//echo $dspReport[0][0];
//echo $dspReport[0][1];
//echo $dspReport[0][2];
//echo $dspReport[0][3];
//echo $dspReport[0][8];
//echo $dspReport[1][0];
//echo $dspReport[1][1];
//echo $dspReport[1][2];
//echo $dspReport[1][3];
//echo $dspReport[2][0];
//echo $dspReport[2][1];
//echo $dspReport[2][2];
//echo $dspReport[2][3];
//echo $dspReport[3][0];
//echo $dspReport[3][1];
//echo $dspReport[3][2];
//echo $dspReport[3][3];



    return $RetCode;

}



//*****************************************************************************/
//* 関数名 ：Get_ReportS
//* 引数   ：$Key1           物件番号
//*       ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspReport      報告情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告詳細の情報を取得する
//*
//****************************************************************************/
Function Get_ReportS($Key1, $Key3, $Key4, $Key20, &$dspReportS, $ID) {
    // 初期値設定
    $RetCode = 0;

	if (is_null($Key3) == True) {
			// システムエラー
			$RetCode = 2;
			return $RetCode;
		} else {
			$strSQL = "Select * From tenrusu11";
	}
	
	if (is_null($Key1) == True) {
		//$strSQL = $strSQL. " Where ThingNum IS NULL";
		$strSQL = $strSQL. " Where bid IS NULL";
	} else {
		//$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
		$strSQL = $strSQL. " Where id = '". $Key20. "'";
	}

	//$strSQL = $strSQL. " And id = '". $Key20. "'";
//echo $strSQL;

    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {

				// 提案内容の収集
				$i = 0;

				while($array = pg_fetch_assoc($sqlID)) {
					$dspReportS[$i][0] = $array["id"];
					$dspReportS[$i][1] = $array["item5"];
					$dspReportS[$i][2] = $array["item6"];
					$dspReportS[$i][3] = $array["item7"];
					$dspReportS[$i][4] = $array["item8"];

					$i=$i+1;
			
				}

			}
    // 開放
    pg_freeresult($sqlID);
	}

//		echo $dspReportS[0][0];

	return $RetCode;

}


//*****************************************************************************/
//* 関数名 ：Get_ReportS0
//* 引数   ：$Key1           物件番号
//*       ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspReport      報告情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告詳細(分類マスタ:一般)の情報を取得する
//*
//****************************************************************************/
Function Get_ReportM($Key3, $Key21, &$dspReportM, $ID) {
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select * From tenrusu01";
	}
	
    if (is_null($Key21) == True) {
        //$strSQL = $strSQL. " Where ThingNum IS NULL";
        $strSQL = $strSQL. " Where id IS NULL";
    } else {
        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
        $strSQL = $strSQL. " Where id = '". $Key21. "'";

    }

    // SQL実行
   // echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // データ取得
            $array = pg_fetch_array($sqlID);

            if ($array == False) {
                // システムエラー
                $RetCode = 2;
            } else {
                // 表示用データの収集

							$dspReportM[0] = $array["id"];
							$dspReportM[1] = $array["classname"];
							$dspReportM[2] = $array["item1"];
							$dspReportM[3] = $array["item2"];
							$dspReportM[4] = $array["item3"];
							$dspReportM[5] = $array["item4"];
							$dspReportM[6] = $array["comment"];
							$dspReportM[7] = $array["example"];

            }
        }

        // 開放
        pg_freeresult($sqlID);
    }

    return $RetCode;

}




//*****************************************************************************/
//* 関数名 ：Get_ReportU
//* 引数   ：$Key1           物件番号
//*       ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspReport      報告情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：報告詳細の情報を更新
//*
//****************************************************************************/
Function Get_ReportU($Key1, $Key3, $Key20, $ID) {
    // 初期値設定
    $RetCode = 0;

	if (is_null($Key3) == True) {
			// システムエラー
			$RetCode = 2;
			return $RetCode;
		} else {
			$strSQL = "UPDATE tenrusu10 SET ownerdate = '" .Date('Ymd') ."',";
			$strSQL = $strSQL. "syounin = 0";

	}
	if (is_null($Key1) == True) {
		//$strSQL = $strSQL. " Where ThingNum IS NULL";
		$strSQL = $strSQL. " Where id IS NULL";
	} else {
		//$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
		$strSQL = $strSQL. " Where id = '". $Key20. "'";
	}

	//$strSQL = $strSQL. " And id = '". $Key20. "'";
//echo $strSQL;

    // SQL実行
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    }

    // 開放
    pg_freeresult($sqlID);


	return $RetCode;

}






//*****************************************************************************/
//* 関数名 ：Get_Trans
//* 引数   ：$Key1           物件番号
//*       ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspReport      報告情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：送金実績の今月支払い情報を取得する
//*
//****************************************************************************/
Function Get_Trans($Key1, $Key3, $Key4, &$dspTrans, &$dspTrans00, &$dspTrans02, &$dspTrans03, $ID) {
    // 初期値設定
    $RetCode = 0;

		//今月と先月
    $tempdate = mktime(0, 0, 0, Date("m"), 0, Date("Y"));
    $tempdateL = mktime(0, 0, 0, (Date("m") - 1), 0, Date("Y"));


 /**************支払い処理**************************************************/
    // 認証SQL生成
	if (is_null($Key3) == True) {
			// システムエラー
			$RetCode = 2;
			return $RetCode;
		} else {
					$strSQL = "Select *";
					$strSQL = $strSQL. " From tenrusu21";
	}
	
    if (is_null($Key1) == True) {
	        //$strSQL = $strSQL. " Where ThingNum IS NULL";
	        $strSQL = $strSQL. " Where bid IS NULL";
	    } else {
	        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
	        $strSQL = $strSQL. " Where bid = '". $Key1. "'";
    }

    if (is_null($Key4) == True) {
	        //$strSQL = $strSQL. " And HopeLentName Is NULL";
	    } else {
						//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
	        $strSQL = $strSQL. " And clientcode = '". $Key4. "'";
    }
		
		$strSQL = $strSQL. " And kubun = '支払'";
		$strSQL = $strSQL. " And kijyundate = '" .Date("Ym") ."'";

    // SQL実行
		//echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {

		// 提案内容の収集
		$i = 0;
					while($array = pg_fetch_assoc($sqlID)) {
						$dspTrans[$i][0] = $array["contractid"];
						$dspTrans[$i][1] = $array["tekiyou"];
						$dspTrans[$i][2] = $array["soukin"];

			$i=$i+1;
								
						}
		}
		/*****配列の中合計**********/
		function trans_col($arrList, $target){ 		//指定した列の取り出し
			$dspTransS = array();	
			foreach($arrList as $dspTrans2){
				foreach($dspTrans2 as $key => $value){
					if($key == $target){
						$dspTransS[] = $value;
					} 
				} 
			}
			return $dspTransS;		//指定した列が格納された配列を返す
		}

		//実行
		$dspTrans02 = trans_col($dspTrans, "2");		//キーが"name"の列を配列にする
		$dspTrans02=  array_sum($dspTrans02);


    // 開放
    pg_freeresult($sqlID);
	}

	/*******************支払い処理ここまで*********************************/
 /**************請求処理**************************************************/
    // 認証SQL生成
	if (is_null($Key3) == True) {
			// システムエラー
			$RetCode = 2;
			return $RetCode;
		} else {
					$strSQL = "Select *";
					$strSQL = $strSQL. " From tenrusu21";
	}
	
    if (is_null($Key1) == True) {
	        //$strSQL = $strSQL. " Where ThingNum IS NULL";
	        $strSQL = $strSQL. " Where bid IS NULL";
	    } else {
	        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
	        $strSQL = $strSQL. " Where bid = '". $Key1. "'";
    }

    if (is_null($Key4) == True) {
	        //$strSQL = $strSQL. " And HopeLentName Is NULL";
	    } else {
						//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
	        $strSQL = $strSQL. " And clientcode = '". $Key4. "'";
    }
		
		$strSQL = $strSQL. " And kubun = '請求'";
		$strSQL = $strSQL. " And kijyundate = '" .Date("Ym") ."'";


    // SQL実行
//		echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {

		// 提案内容の収集
		$i = 0;
					while($array = pg_fetch_assoc($sqlID)) {
						$dspTrans[$i][3] = $array["contractid"];
						$dspTrans[$i][4] = $array["tekiyou"];
						$dspTrans[$i][5] = $array["soukin"];
						$dspTrans[$i][6] = $array["meisaikin"];
						$dspTrans[$i][7] = $array["kakuteikin"];
						$dspTrans[$i][8] = $array["miseisankin"];
						$dspTrans[$i][9] = $dspTrans[$i][7]-$dspTrans[$i][5];

			$i=$i+1;
								
						}
		}
		/*****配列の中合計**********/
		/*function trans_col($arrList, $target){ 		//指定した列の取り出し
			$dspTransS = array();	
			foreach($arrList as $dspTrans2){
				foreach($dspTrans2 as $key => $value){
					if($key == $target){
						$dspTransS[] = $value;
					} 
				} 
			}
			return $dspTransS;		//指定した列が格納された配列を返す
		}*/

		//実行
		$dspTrans03 = trans_col($dspTrans, "5");
		$dspTrans03=  array_sum($dspTrans03);

		$dspTrans05 = trans_col($dspTrans, "8");
		$dspTrans05 =  array_sum($dspTrans05);
		$dspTrans03 += $dspTrans05;

    // 開放
    pg_freeresult($sqlID);
	}

	/*******************支払い処理ここまで*****************/
		//送金額（支払い合計-請求合計）
		$dspTrans00 = $dspTrans02-$dspTrans03;



//echo $dspTrans[6];
    return $RetCode;

}





//*****************************************************************************/
//* 関数名 ：Get_TransL
//* 引数   ：$Key1           物件番号
//*       ：$Key2           フリガナ
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspReport      報告情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：送金実績の前月分の情報を取得する
//*
//****************************************************************************/
Function Get_TransL($Key1, $Key3, $Key4, &$dspTransL, &$dspTransL00, &$dspTransL02, &$dspTransL03, $ID) {
    // 初期値設定
    $RetCode = 0;

		//今月と先月
    $tempdate = mktime(0, 0, 0, Date("m"), 0, Date("Y"));
    $tempdateL = mktime(0, 0, 0, (Date("m") - 1), 0, Date("Y"));


 /**************支払い処理**************************************************/
    // 認証SQL生成
	if (is_null($Key3) == True) {
			// システムエラー
			$RetCode = 2;
			return $RetCode;
		} else {
					$strSQL = "Select *";
					$strSQL = $strSQL. " From tenrusu21";
	}
	
    if (is_null($Key1) == True) {
	        //$strSQL = $strSQL. " Where ThingNum IS NULL";
	        $strSQL = $strSQL. " Where bid IS NULL";
	    } else {
	        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
	        $strSQL = $strSQL. " Where bid = '". $Key1. "'";
    }

    if (is_null($Key4) == True) {
	        //$strSQL = $strSQL. " And HopeLentName Is NULL";
	    } else {
						//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
	        $strSQL = $strSQL. " And clientcode = '". $Key4. "'";
    }
		
		$strSQL = $strSQL. " And kubun = '支払'";
		$strSQL = $strSQL. " And kijyundate = '". Date('Ym', strtotime('-1 month')). "'";
    // SQL実行
		//echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {

		// 提案内容の収集
		$i = 0;
					while($array = pg_fetch_assoc($sqlID)) {
						$dspTransL[$i][0] = $array["contractid"];
						$dspTransL[$i][1] = $array["tekiyou"];
						$dspTransL[$i][2] = $array["soukin"];

			$i=$i+1;
								
						}
		}
		/*****配列の中合計**********/
		/*function trans_col($arrList, $target){ 		//指定した列の取り出し
			$dspTransS = array();	
			foreach($arrList as $dspTrans2){
				foreach($dspTrans2 as $key => $value){
					if($key == $target){
						$dspTransS[] = $value;
					} 
				} 
			}
			return $dspTransS;		//指定した列が格納された配列を返す
		}*/

		//実行
		$dspTransL02 = trans_col($dspTransL, "2");
		$dspTransL02=  array_sum($dspTransL02);




    // 開放
    pg_freeresult($sqlID);
	}

	/*******************支払い処理ここまで*********************************/
 /**************請求処理**************************************************/
    // 認証SQL生成
	if (is_null($Key3) == True) {
			// システムエラー
			$RetCode = 2;
			return $RetCode;
		} else {
					$strSQL = "Select *";
					$strSQL = $strSQL. " From tenrusu21";
	}
	
    if (is_null($Key1) == True) {
	        //$strSQL = $strSQL. " Where ThingNum IS NULL";
	        $strSQL = $strSQL. " Where bid IS NULL";
	    } else {
	        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
	        $strSQL = $strSQL. " Where bid = '". $Key1. "'";
    }

    if (is_null($Key4) == True) {
	        //$strSQL = $strSQL. " And HopeLentName Is NULL";
	    } else {
						//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
	        $strSQL = $strSQL. " And clientcode = '". $Key4. "'";
    }
		
		$strSQL = $strSQL. " And kubun = '請求'";
		$strSQL = $strSQL. " And kijyundate = '". Date('Ym', strtotime('-1 month')). "'";

    // SQL実行
//		echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {

		// 提案内容の収集
		$i = 0;
					while($array = pg_fetch_assoc($sqlID)) {
						$dspTransL[$i][3] = $array["contractid"];
						$dspTransL[$i][4] = $array["tekiyou"];
						$dspTransL[$i][5] = $array["soukin"];
						$dspTransL[$i][6] = $array["meisaikin"];
						$dspTransL[$i][7] = $array["kakuteikin"];
						$dspTransL[$i][8] = $array["miseisankin"];
						$dspTransL[$i][9] = $dspTransL[$i][7]-$dspTransL[$i][5];

			$i=$i+1;
								
						}
		}
		/*****配列の中合計**********/
		/*function trans_col($arrList, $target){ 		//指定した列の取り出し
			$dspTransLS = array();	
			foreach($arrList as $dspTransL2){
				foreach($dspTransL2 as $key => $value){
					if($key == $target){
						$dspTransLS[] = $value;
					} 
				} 
			}
			return $dspTransLS;		//指定した列が格納された配列を返す
		}*/

		//実行
		$dspTransL03 = trans_col($dspTransL, "5");
		$dspTransL03=  array_sum($dspTransL03);


		$dspTransL05 = trans_col($dspTransL, "8");
		$dspTransL05 =  array_sum($dspTransL05);
		$dspTransL03 += $dspTransL05;

    // 開放
    pg_freeresult($sqlID);
	}

	/*******************支払い処理ここまで*****************/
		//送金額（支払い合計-請求合計）
		$dspTransL00 = $dspTransL02-$dspTransL03;


//echo $dspTransL[6];
    return $RetCode;

}





//*****************************************************************************/
//* 関数名 ：Get_Pay
//* 引数   ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspPayment     支払調書情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：支払調書の情報を取得する
//*
//****************************************************************************/
Function Get_Pay($Key1, $Key3, $Key4, &$dspPay, $ID) {
    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select * From tenrusu31";
	}
	
    if (is_null($Key1) == True) {
        //$strSQL = $strSQL. " Where ThingNum IS NULL";
        $strSQL = $strSQL. " Where bid IS NULL";
    } else {
        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
        $strSQL = $strSQL. " Where bid = '". $Key1. "'";

    }

    if (is_null($Key4) == True) {
        //$strSQL = $strSQL. " And HopeLentName Is NULL";
        $strSQL = $strSQL. " And ownercd Is NULL";
    } else {
					//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
        $strSQL = $strSQL. " And ownercd = '". $Key4. "'";
        $strSQL = $strSQL. " And hakkounenn = '". Date('Y', strtotime('-1 year')). "'";
    }

    // SQL実行
    // echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // データ取得
            $array = pg_fetch_array($sqlID);

            if ($array == False) {
                // システムエラー
                $RetCode = 2;
            } else {
                // 表示用データの収集
																
								$dspPay[0] = $array["loginf"];
								$dspPay[1] = $array["bid"];
								$dspPay[2] = $array["taisyo"];
								$dspPay[3] = $array["koushinkubun"];
								$dspPay[4] = $array["ownercd"];
								$dspPay[5] = $array["owner"];
								$dspPay[6] = $array["printbid"];
								$dspPay[7] = $array["bname"];
								$dspPay[8] = $array["contractid"];//契約NO
								$dspPay[9] = $array["kyojyucode"];

								$dspPay[10] = $array["companyname"];
								$dspPay[11] = $array["tel"];
								$dspPay[12] = $array["fax"];
								$dspPay[13] = $array["busyo"];
								$dspPay[14] = $array["tantousya"];
								$dspPay[15] = $array["hakkounenn"];//発行年

								//支払を受けるもの
								$dspPay[16] = $array["genyuubin"];//郵便番号
								$dspPay[17] = $array["genadd1"];//現住所1
								$dspPay[18] = $array["genadd2"];//現住所2
								$dspPay[19] = $array["genadd3"];//現住所3

								$dspPay[20] = $array["kinnsennkannrino"];//金銭管理NO

								//区分1
								$dspPay[21] = $array["kubun1"];
								$dspPay[22] = $array["bukkenadd1"];
								$dspPay[23] = $array["keisankiso1"];
								$dspPay[24] = $array["siharai1"];
								$dspPay[25] = $array["gensen1"];

								//区分2
								$dspPay[26] = $array["kubun2"];
								$dspPay[27] = $array["bukkenadd2"];
								$dspPay[28] = $array["keisankiso2"];
								$dspPay[29] = $array["siharai2"];
								$dspPay[30] = $array["gensen2"];

								//区分3
								$dspPay[31] = $array["kubun3"];
								$dspPay[32] = $array["bukkenadd3"];
								$dspPay[33] = $array["keisankiso3"];
								$dspPay[34] = $array["siharai3"];
								$dspPay[35] = $array["gensen3"];

								//区分4
								$dspPay[36] = $array["kubun4"];
								$dspPay[37] = $array["bukkenadd4"];
								$dspPay[38] = $array["keisankiso4"];
								$dspPay[39] = $array["siharai4"];
								$dspPay[40] = $array["gensen4"];

								//区分5
								$dspPay[41] = $array["kubu5"];
								$dspPay[42] = $array["bukkenadd5"];
								$dspPay[43] = $array["keisankiso5"];
								$dspPay[44] = $array["siharai5"];
								$dspPay[45] = $array["gensen5"];

								//区分6
								$dspPay[46] = $array["kubun6"];
								$dspPay[47] = $array["bukkenadd6"];
								$dspPay[48] = $array["keisankiso6"];
								$dspPay[49] = $array["siharai6"];
								$dspPay[50] = $array["gensen6"];

								//区分7
								$dspPay[51] = $array["kubun7"];
								$dspPay[52] = $array["bukkenadd7"];
								$dspPay[53] = $array["keisankiso7"];
								$dspPay[54] = $array["siharai7"];
								$dspPay[55] = $array["gensen7"];

								//区分8
								$dspPay[56] = $array["kubun8"];
								$dspPay[57] = $array["bukkenadd8"];
								$dspPay[58] = $array["keisankiso8"];
								$dspPay[59] = $array["siharai8"];
								$dspPay[60] = $array["gensen8"];

								//区分9
								$dspPay[61] = $array["kubun9"];
								$dspPay[62] = $array["bukkenadd9"];
								$dspPay[63] = $array["keisankiso9"];
								$dspPay[64] = $array["siharai9"];
								$dspPay[65] = $array["gensen9"];

								//区分10
								$dspPay[66] = $array["kubun10"];
								$dspPay[67] = $array["bukkenadd10"];
								$dspPay[68] = $array["keisankiso10"];
								$dspPay[69] = $array["siharai10"];
								$dspPay[70] = $array["gensen10"];

							

            }
        }

        // 開放
        pg_freeresult($sqlID);
    }


    return $RetCode;

}

//*****************************************************************************/
//* 関数名 ：Get_Rec01
//* 引数   ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspPayment     支払調書情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：領収書01の情報を取得する
//*
//****************************************************************************/
Function Get_Rec01($Key1, $Key3, $Key4, &$dspRec01, $ID) {
    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select * From tenrusu32";
	}
	
    if (is_null($Key1) == True) {
        //$strSQL = $strSQL. " Where ThingNum IS NULL";
        $strSQL = $strSQL. " Where bid IS NULL";
    } else {
        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
        $strSQL = $strSQL. " Where bid = '". $Key1. "'";

    }

    if (is_null($Key4) == True) {
        //$strSQL = $strSQL. " And HopeLentName Is NULL";
        $strSQL = $strSQL. " And ownercode Is NULL";
    } else {
					//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
       $strSQL = $strSQL. " And ownercode = '". $Key4. "'";
        $strSQL = $strSQL. " And nenndo = '". Date('Y', strtotime('-1 year')). "'";
    }

    // SQL実行
//    echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // データ取得
            $array = pg_fetch_array($sqlID);

            if ($array == False) {
                // システムエラー
                $RetCode = 2;
            } else {
                // 表示用データの収集
																

							$dspRec01[0] = $array["taisyo"];
							$dspRec01[1] = $array["ownercode"];
							$dspRec01[2] = $array["owner"];
							$dspRec01[3] = $array["bid"];
							$dspRec01[4] = $array["bname"];
							$dspRec01[5] = $array["contractid"];
							$dspRec01[6] = $array["kyojyucode"];
							$dspRec01[7] = $array["furikomisousai"];
							$dspRec01[8] = $array["areacode"];

							//会社情報
							$dspRec01[9] = $array["companyname"];
							$dspRec01[10] = $array["tel"];
							$dspRec01[11] = $array["fax"];
							$dspRec01[12] = $array["busyo"];
							$dspRec01[13] = $array["tantousya"];

							//物件情報
							$dspRec01[14] = $array["badd1"];
							$dspRec01[15] = $array["badd2"];
							$dspRec01[16] = $array["badd3"];
							$dspRec01[17] = $array["tekiyou"];


							$dspRec01[18] = $array["ryousyuno"];
							$dspRec01[19] = $array["ryousyukingaku"];

							//各種内容
							$dspRec01[20] = $array["kanriryou"];//管理料
							$dspRec01[21] = $array["kanriryoukingaku"];
							$dspRec01[22] = $array["kaisinentuki"];
							$dspRec01[23] = $array["syuuryounentuki"];

							$dspRec01[24] = $array["soukintesuuryou"];//送金手数料
							$dspRec01[25] = $array["soukintesuuryoukingaku"];
							$dspRec01[26] = $array["soukintesuuryoukaisu"];

							$dspRec01[27] = $array["hosyou"];//保障
							$dspRec01[28] = $array["hosyoukingaku"];

							$dspRec01[29] = $array["satuei"];//撮影
							$dspRec01[30] = $array["satueikingaku"];

							$dspRec01[31] = $array["kanritesuuryou"];//管理手数料
							$dspRec01[32] = $array["kanritesuuryoukingaku"];

							$dspRec01[33] = $array["kousintesuryou"];//更新手数料
							$dspRec01[34] = $array["kousintesuryoukingaku"];

							$dspRec01[35] = $array["setubitenkenryou"];//設備点検
							$dspRec01[36] = $array["setubitenkenryoukingaku"];

							$dspRec01[37] = $array["syuuzenntouroku"];//修繕
							$dspRec01[38] = $array["syuuzenntourokukingaku"];

							$dspRec01[39] = $array["gyoumuitaku"];//業務委託
							$dspRec01[40] = $array["gyoumuitakukingaku"];

							$dspRec01[41] = $array["daikoutesuuryou"];//代行手数料
							$dspRec01[42] = $array["daikoutesuuryoukingaku"];

							$dspRec01[43] = $array["saikeiyakutesuuryou"];//再契約手数料
							$dspRec01[44] = $array["saikeiyakutesuuryoukingaku"];

							$dspRec01[45] = $array["insi"];//印紙
							$dspRec01[46] = $array["insikingaku"];

							$dspRec01[47] = $array["relohosyou"];//リロ保証
							$dspRec01[48] = $array["relohosyoukingaku"];

							$dspRec01[49] = $array["kousinjihosyou"];//更新事務
							$dspRec01[50] = $array["kousinjihosyoukingaku"];

							$dspRec01[51] = $array["kakusyuhosyou"];//各種保障
							$dspRec01[52] = $array["kakusyuhosyoukingaku"];

							$dspRec01[53] = $array["tinryoukaiteitesuutyou"];//賃料改定
							$dspRec01[54] = $array["tinryoukaiteitesuutyoukingaku"];

							$dspRec01[55] = $array["kinsenkanri"];//金銭管理
							$dspRec01[56] = $array["kinsenkanrikingaku"];

							$dspRec01[57] = $array["nenndo"];//年度



							

            }
        }

        // 開放
        pg_freeresult($sqlID);
    }

    return $RetCode;

}
//*****************************************************************************/
//* 関数名 ：Get_Rec02
//* 引数   ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspPayment     支払調書情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：領収書02の一覧情報を取得する
//*
//****************************************************************************/
Function Get_Rec02($Key1, $Key3, $Key4, &$dspRec02, $ID) {
    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select * From tenrusu33";
	}
	
    if (is_null($Key1) == True) {
        //$strSQL = $strSQL. " Where ThingNum IS NULL";
        $strSQL = $strSQL. " Where bid IS NULL";
    } else {
        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
        $strSQL = $strSQL. " Where bid = '". $Key1. "'";

    }

    if (is_null($Key4) == True) {
        //$strSQL = $strSQL. " And HopeLentName Is NULL";
        $strSQL = $strSQL. " And keiyakuno Is NULL";
    } else {
					//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
       $strSQL = $strSQL. " And torihikisakisikibetucode = '". $Key4. "'";
    }
      // $strSQL = $strSQL. " And syounin = '1'";
			 $strSQL = $strSQL. " ORDER BY ryousyuhakkoubi DESC";

    // SQL実行
    echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // データ取得
            $array = pg_fetch_array($sqlID);

            if ($array == False) {
                // システムエラー
                $RetCode = 2;
            } else {
                // 表示用データの収集
																

							$dspRec02[0] = $array["bid"];
							$dspRec02[1] = $array["ryousyuhakkoubi"];
							$dspRec02[2] = $array["ryousyukanrino"];
							
            }
        }

        // 開放
        pg_freeresult($sqlID);
    }
		print_r ($dspRec02);
    return $RetCode;

}

//*****************************************************************************/
//* 関数名 ：Get_Rec03
//* 引数   ：$Key1           物件番号
//*        ：$Key3           地域(東京・大阪)
//*        ：$dspPayment     支払調書情報（参照渡し）
//*       ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：領収書02の一覧情報を取得する
//*
//****************************************************************************/
Function Get_Rec03($Key1, $Key3, $Key4, $Key20, &$dspRec03, $ID) {
    // 初期値設定
    $RetCode = 0;

    // 認証SQL生成
	if (is_null($Key3) == True) {
		// システムエラー
		$RetCode = 2;
		return $RetCode;
	} else {
			$strSQL = "Select * From tenrusu33";
	}
	
    if (is_null($Key1) == True) {
        //$strSQL = $strSQL. " Where ThingNum IS NULL";
        $strSQL = $strSQL. " Where bid IS NULL";
    } else {
        //$strSQL = $strSQL. " Where ThingNum like '". $Key1. "%'";
        $strSQL = $strSQL. " Where bid = '". $Key1. "'";

    }

    if (is_null($Key4) == True) {
        //$strSQL = $strSQL. " And HopeLentName Is NULL";
        $strSQL = $strSQL. " And keiyakuno Is NULL";
    } else {
					//$strSQL = $strSQL. " And HopeLentName = '". $Key4. "'";
       $strSQL = $strSQL. " And torihikisakisikibetucode = '". $Key4. "'";
    }
       $strSQL = $strSQL. " And ryousyukanrino = '". $Key20. "'";
    // SQL実行
    echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
        $RetCode = 2;
    } else {
        if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $RetCode = 0;
        } else {
            // データ取得
            $array = pg_fetch_array($sqlID);

            if ($array == False) {
                // システムエラー
                $RetCode = 2;
            } else {
                // 表示用データの収集

							$dspRec03[0] = $array["bid"];
							$dspRec03[1] = $array["bname"];
							$dspRec03[2] = $array["segm"];
							$dspRec03[3] = $array["torihikisakiname"];
							$dspRec03[4] = $array["torihikikingaku"];
							$dspRec03[5] = $array["ryousyukanrino"];
							$dspRec03[6] = $array["hikiatekakuteibi"];
							$dspRec03[7] = $array["nyuukinhouhou"];
							$dspRec03[8] = $array["keiyakuno"];
							$dspRec03[9] = $array["nyuukinhouhou"];
            }
        }

        // 開放
        pg_freeresult($sqlID);
    }
		print_r ($dspRec02);
    return $RetCode;

}


?>