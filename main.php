<?php
/**
 * Created by PhpStorm.
 * User: 이지윤
 * Date: 2017-11-02
 * Time: 오후 10:38
 */

include "model/model.php";

class controllers_main  {

    private $db;

    // 생성자로 modeld의 객체 생성
    function __construct()
    {
        $this->db = new model();
    }

    // main화면으로 갈 때
    function main() {
        include "view/main.php";
    }

    // 사용자 등록 페이지로 갈 때
    function register() {
        include "view/register.php";
    }

    // 사용자 등록 시 무결성 검사
    function confirm($userid, $username, $userpassword, $classification, $gender, $phone, $email)
    {
        $confirm = false;
        include "view/register_confirm.php";
        include "view/main.php";

        // 무결성 검사 통과 시 db에 저장
        if ($confirm == true) {
            $this->db->registrationProcessing($userid, $username, $userpassword, $classification, $gender, $phone, $email);
        }
    }

    // 사용자 정보 수정페이지 이동
    function modify()
    {
        include "view/modify.php";
    }

    // 사용자 정보수정 시 정보 가지고 오기
    function modifyinfoget($id)
    {
        $this->db->modifyinfoget($id);
    }

    // 사용자 정보 수정시 무결성 검사
    function update($userid, $username, $userpassword, $classification, $gender, $phone, $email)
    {
        $confirm = false;
        include "view/modify_confirm.php";
        include "view/main.php";

        // 무결성 검사 통과 시
        if ($confirm == true) {
            $this->db->update($userid, $username, $userpassword, $classification, $gender, $phone, $email);
        }
    }

    // 사용자 삭제 페이지로 이동
    function delete()
    {
        include "view/delete.php";
    }

    // 사용자 삭제 시 무결성 검사
    function delete_confirm($userid, $userpassword)
    {
        $result = $this->db->delete_confirm($userid, $userpassword);
        if ($result == 0) {
            echo "<script>alert('등록되지 않은 ID입니다.');</script>";
        } else if ($result == 1) {
            echo "<script>alert('암호가 일치하지 않습니다.')</script>";
        } else if ($result == 2) {
            $this->db->delete($userid);
        }
        include "view/main.php";
    }

    // 전체 회원보기 페이지로 이동
    function call($list_num)
    {
        $result = $this->db->call($list_num);

        // list 불러오기
        include "view/list.php";

        // pagenation button 불러오기

        // userinfo테이블의 행 count값
        $table_count = $this->db->table_count();

        $row = mysqli_fetch_row($table_count);
        include "view/call.php";
    }
}
