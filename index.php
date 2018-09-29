<?php
/**
 * Created by PhpStorm.
 * User: 이지윤
 * Date: 2017-11-04
 * Time: 오후 10:05
 */
include "controllers/main.php";

    // 사용자 등록
$controllers_main = new controllers_main();
if(isset($_GET['register']))    {
    $controllers_main->register();
}

    // 사용자 등록시 무결성 검사
else if(isset($_POST['confirm']))  {
    $controllers_main->confirm($_POST['userid'], $_POST['username'],
        $_POST['userpassword'], $_POST['classification'],
        $_POST['gender'], $_POST['phone'], $_POST['email']);
}

    // DB에 사용자 정보 수정
else if(isset($_POST['update']))  {
    $controllers_main->update($_POST['userid'], $_POST['username'],
        $_POST['userpassword'], $_POST['classification'],
        $_POST['gender'], $_POST['phone'], $_POST['email']);
}

    // 사용자 정보수정 view 띄우기
else if(isset($_GET['modify'])) {
    $controllers_main->modify();
}

    // 사용자 정보수정 시 무결성 검사
else if(isset($_GET['modifyinfoget']))  {
    $controllers_main->modifyinfoget($_GET['id']);
}

    //  사용자 삭제
else if(isset($_GET['delete']))    {
    $controllers_main->delete();
}

    // 사용자 삭제 시 무결성검사
else if(isset($_POST['delete_confirm']))    {
    $controllers_main->delete_confirm($_POST['userid'], $_POST['userpassword']);
}

    // 전체 회원보기 list
else if(isset($_GET['list']))    {
        if(isset($_GET['list_num']))    {
            $controllers_main->call($_GET['list_num']);
        } else{
            $controllers_main->call(1);
        }
}

    // url에 입력값이 없을 경우 main페이지 띄우기
else   {
    $controllers_main->main();
}