<?
//****************************************************************************/
//*
//* 関数名 ：GetLogin
//* 引数   ：$ActType        Post時のアクションタイプ
//*        ：$Key1           ID
//*        ：$Key2           パスワード
//*        ：$dspUerInfo     ユーザー情報格納配列
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：ログイン画面で入力された情報をDBに問い合わせ、結果格納
//*
//****************************************************************************/
Function GetLogin($ActType, $Key1, $Key3, $Key4, &$dspUerInfo) {

    // 初期値設定
    $result = 0;

    // アクションタイプのチェック
    if ($ActType != "TgRSPInf") {
        $result = 2;
        return $result;
    }

//  echo "アクションタイプのチェックOK";
//  echo $result;

    // コネクションの確立
    $ID = pg_connect("dbname=". DBNAME. " user=". USERNAME);
    if (!$ID) {
        $result = 2;
        return $result;
    }

//  echo "コネクションの確立OK";
//  echo $result;


    // 入力キー項目からオーナー情報を取得し認証する
    $Ret = Get_Login($Key1, $Key2, $dspUserInfo, $ID);

    if ($Ret != 0) {
        if ($Ret == 1) {
            // 認証エラー
            $result = 1;
        } else {
            // システムエラー
            $result = 2;
        }
    }



//  echo "入力キー項目からユーザー情報を取得";
//  echo $result;

    // DBクローズ
    pg_close($ID);

    return $result;

}

//****************************************************************************/
//*
//* 関数名 ：Get_Login
//* 引数   ：$Key1           ID
//*        ：$Key2           パスワード
//*        ：$dspUserInfo     ユーザー情報）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：ログイン用SQL
//*
//****************************************************************************/
Function Get_Login($Key1, $Key2, &$dspOwnLogin, $ID) {
    // 初期値設定
    $result = 0;

    // 認証SQL生成
    $strSQL = "Select * From User";

    if (is_null($Key1) == True) {
	$strSQL = $strSQL. " Where ID IS NULL";
    } else {
        $strSQL = $strSQL. " Where ID = '". $Key1. "'";
    }

    if (is_null($Key2) == True) {
        $strSQL = $strSQL. " And PW Is NULL";
    } else {
	$strSQL = $strSQL. " And PW = '". $Key2. "'";
    }

// SQL実行
//	echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
	$result = 2;
    } else {
	if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $result = 1;
	} else {
            // データ取得
            $array = pg_fetch_array($sqlID);
			
            if ($array == False) {
		// システムエラー
		$result = 2;
            } else {
		// 表示用データの収集
		$dspUserInfo[0] = $array["Num"];
                $dspUserInfo[1] = $array["Name"];
            }
        }

		// 開放
		pg_freeresult($sqlID);

}

    return $result;

}

//****************************************************************************/
//*
//* 関数名 ：Get_
//* 引数   ：$Key1           ID
//*        ：$Key2           パスワード
//*        ：$dspUserInfo     ユーザー情報）
//*        ：$ID             接続オブジェクト
//* 戻り値 ：0(成功) 1(認証エラー) 2(その他エラー)
//*
//* 説明   ：ログイン用SQL
//*
//****************************************************************************/
Function Get_Login($Key1, $Key2, &$dspOwnLogin, $ID) {
    // 初期値設定
    $result = 0;

    // 認証SQL生成
    $strSQL = "Select * From User";

    if (is_null($Key1) == True) {
	$strSQL = $strSQL. " Where ID IS NULL";
    } else {
        $strSQL = $strSQL. " Where ID = '". $Key1. "'";
    }

    if (is_null($Key2) == True) {
        $strSQL = $strSQL. " And PW Is NULL";
    } else {
	$strSQL = $strSQL. " And PW = '". $Key2. "'";
    }

// SQL実行
//	echo $strSQL;
    $sqlID = pg_exec($ID, $strSQL);

    if ($sqlID == False) {
        // システムエラー
	$result = 2;
    } else {
	if (pg_num_rows($sqlID) == 0) {
            // 認証エラー
            $result = 1;
	} else {
            // データ取得
            $array = pg_fetch_array($sqlID);
			
            if ($array == False) {
		// システムエラー
		$result = 2;
            } else {
		// 表示用データの収集
		$dspUserInfo[0] = $array["Num"];
                $dspUserInfo[1] = $array["Name"];
            }
        }

		// 開放
		pg_freeresult($sqlID);

}

    return $result;

}
?>