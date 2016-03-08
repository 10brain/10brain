<?php
/******************************************************************************/
// 書籍番号貸出判定
// 20160307@ito
//
//
//
/******************************************************************************/
require '../lib/book_func.php';
require '../lib/check.php';

$ActType = $_POST["ActionType"];
$Key10 = $_POST["KEYWORD1"];  //ID

//貸出冊数確認
$obj=new BookModel();
//入力された情報の確認
$result = $obj->GETBorrowUList($ActType, $Key0, $dspBorrowUList);

//入力された情報の確認
    if(isset($_POST['KEYWORD10'])){
        $Key10 = $_POST['KEYWORD10'];
        $obj=new BookModel();
        //入力された情報の確認
        $result = $obj->GETBorrowSearch($Key10, $dspBooknum);
        if($dspBooknum[0] = 0){
            $zaiko = '在庫無';
            include 'borrow.php';
        }else{
            $zaiko = '在庫有';
            include 'borrow.php';
        }
    }
    

?>
