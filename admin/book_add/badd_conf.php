<?php
require_once '../../lib/user_func.php';
require_once '../../lib/check.php';
require_once '../../lib/class.Validation.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";

///^[a-zA-Z0-9!$&*.=^`|~#%'+\/?_{}-]+@([a-zA-Z0-9_-]+\.)+[a-zA-Z]{2,6}$/
//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}elseif (!ckStr($_POST["KEYWORD2"],30,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード

    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $pub = $_POST['pub'];
    $writer = $_POST['writer'];
    $intro = $_POST['intro'];
    $year = $_POST['year'];
    $amazon = $_POST['amazon'];
    $remarks = $_POST['remarks'];
    // 内部文字コード
    define("INNER_CODE", "UTF-8");
    define("HTML_CODE", "UTF-8");
    $vali = new Validation();

    // ISBN
    $isbn = mb_convert_kana($isbn, "KV", INNER_CODE);
    if(!$vali->isISBN($isbn, TRUE, 14, 0, "UTF-8")){
          $isbn_error = "未入力、または内容に誤りが有ります";
          $result = 4;
    }

    //title
    $title = mb_convert_kana($title, "KV", INNER_CODE);
    if(!$vali->isString($title, TRUE, 255, 0, "UTF-8")){
            $title_error = "未入力、または内容に誤りが有ります";
            $result = 4;
    }

    //genre
    $genre = mb_convert_kana($genre, "KV", INNER_CODE);
    if(!$vali->isString($genre, TRUE, 10, 0, "UTF-8")){
        $genre_error = "未入力、または内容に誤りが有ります";
        $result = 4;
    }
    //pub
    $pub = mb_convert_kana($pub, "KV", INNER_CODE);
    if(!$vali->isString($pub, TRUE, 30, "UTF-8")){
        $pub_error = "未入力、または内容に誤りが有ります";
        $result = 4;
    }
    //writer
    $writer = mb_convert_kana($writer, "KV", INNER_CODE);
    if(!$vali->isString($writer, TRUE, 40, "UTF-8")){
        $writer_error = "未入力、または内容に誤りが有ります";
        $result = 4;
    }
    //intro
    $intro = mb_convert_kana($intro, "KV", INNER_CODE);
    if(!$vali->isString($intro, TRUE, 255, "UTF-8")){
        $intro_error = "未入力、または内容に誤りが有ります";
        $result = 4;
    }
    //year
    $year = mb_convert_kana($year, "KV", INNER_CODE);
    if(!$vali->isString($year, TRUE, 4, "UTF-8")){
        $year_error = "未入力、または内容に誤りが有ります";
        $result = 4;
    }
    //amazon
    $amazon = mb_convert_kana($amazon, "KV", INNER_CODE);
    if(!$vali->isURL($amazon, TRUE, 255, 0, "UTF-8")){
    $amazon_error = "未入力、または内容に誤りが有ります";
    $result = 4;
    }
    //remarks
    $remarks = mb_convert_kana($remarks, "KV", INNER_CODE);
    if(!$vali->isString($remarks, TRUE, 400, "UTF-8")){
        $remarks_error = "内容に誤りが有ります";
        $result = 4;
    }
    
}
//画面表示
if($result == 4){
    include("badd_input.html");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>書籍追加確認</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
         <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="jquery.upload.js"></script>
<script>
$(function() {
    // jQuery Upload Thumbs 
    $('form input:file').uploadThumbs({
        position : 0,      // 0:before, 1:after, 2:parent.prepend, 3:parent.append,
                           // any: arbitrarily jquery selector
        imgbreak : true    // append <br> after thumbnail images
    });
});
</script>
<?
$conf = 'badd_res.php';
?>
    </head>
    <body>
        <form name="input" action="<?=$conf;?>" method="post">
    
            <dl>
            <dt>ISBN</dt>
            <dd><?=$isbn;?></dd>
            </dl>
            <dl>
            <dt>タイトル</dt>
            <dd><?=$title;?></dd>
            </dl>
            <dl>
            <dt>ジャンル</dt>
            <dd><?=$genre;?></dd>
            </dl>
            <dl>
            <dt>出版社</dt>
            <dd><?=$pub;?></dd>
            </dl>
            <dl>
            <dt>著者</dt>
            <dd><?=$writer;?></dd>
            </dl>
            <dl>
            <dt>紹介文</dt>
            <dd><?=$intro;?></dd>
            </dl>
            <dl>
            <dt>出版年</dt>
            <dd><?=$year;?></dd>
            </dl>
            <dl>
            <dt>amazonリンク</dt>
            <dd><?=$amazon;?></dd>
            </dl>
            <dl>
            <dt>備考</dt>
            <dd><?=$remarks;?></dd>
            </dl>
            
            <dl>
            <span>画像ファイル</span><br>
            <ul>
             <li>
            <label>
                <input type="hidden" name="MAX_FILE_SIZE" value="600000">
                <input type="file" name="upfile" multiple="multiple"/><br>
             <div class="error"><?=$cover_error;?></div>              
            </label>
             </li>  
            </ul>
            </dl>

            <input type="hidden" name="ActionType" value="TgRSPInf">
            <input type="hidden" name="KEYWORD1" value="<?=$Key1;?>">
            <input type="hidden" name="KEYWORD2" value="<?=$Key2;?>">
            <input type="hidden" name="KEYWORD60" value='<?=$isbn;?>'>
            <input type="hidden" name="KEYWORD61" value='<?=$title;?>'>
            <input type="hidden" name="KEYWORD62" value='<?=$genre;?>'>
            <input type="hidden" name="KEYWORD63" value='<?=$pub;?>'>
            <input type="hidden" name="KEYWORD64" value='<?=$writer;?>'>
            <input type="hidden" name="KEYWORD65" value='<?=$intro;?>'>
            <input type="hidden" name="KEYWORD66" value='<?=$year;?>'>
            <input type="hidden" name="KEYWORD67" value='<?=$amazon;?>'>
            <input type="hidden" name="KEYWORD68" value='<?=$remarks;?>'>

           <br><input type="submit" alt="送信する" />
        </form>
    </body>
</html>

