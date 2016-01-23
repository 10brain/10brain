<?
	require("./lib/check.php");
        require("./lib/common.php");
	require("./lib/ReloGlofunc.php");
	require("./lib/Respfunc.php");
	
	$result = 0;
	$Err = 0;
	$ErrMag = "";
	
	$ActType = "";
	$Key1 = "";
	$Key2 = "";
	$Type = "";

        
	/*if (!ckStr($_POST["KEYWORD1"],40,1) or ereg("[^0-9\-]",$_POST["KEYWORD1"])){
            $result = 1;
	}elseif (!ckStr($_POST["KEYWORD2"],20,1)){
            $result = 1;
	}else{*/
            $ActType = $_POST["ActionType"];
            $Key1 = $_POST["KEYWORD1"];  //ID
            $Key2 = $_POST["KEYWORD2"];  //パスワード

            //DB問い合わせ
            $result = GetLogin2($ActType, $Key1, $Key2, $dspUserInfo);
            
            $Type = $dspUserInfo[0];


	//}

	//画面表示
	if ($result == 0){
            //管理者判定
            if($dspUserInfo[1] == "管理者"){
                include("top.html");
            }else{
              include("./admin/top.php");
            }
	}else{
            if ($_POST["ActionType"] != "TgRSPInf"){
		$aaaa = "";
            }elseif ($result == 1){
		$aaaa = "入力に誤りがあります。";
            }else{
		$aaaa = "ただいまサーバーが込み合っております。";
            }
		
            if (strpos(realpath("."), "/test/") == true){
		$form_action = "./top.php";
            }else{
		$form_action = "./top.php";
            }
	
        include("login.html");
	}
?>

