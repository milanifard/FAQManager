<?php

class UserGroup{
    public $id;
    public $title;
    public $persionTitle;

    static function toUserGroup($row){
        $userGroup = new UserGroup();
        $userGroup->id = $row["id"];
        $userGroup->title = $row["title"];
        $userGroup->persionTitle = $row["persian_title"];
        return $userGroup;
    }

    static function getAll(){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from user_groups;");
        $result = $mysql->ExecuteStatement(array());
        
        $groups = array();
        while($row = $result->fetch()){
            array_push($groups, self::toUserGroup($row));
        }
        return $groups;
    }

    static function getByTitle($title){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from user_groups where title = ?;");
        $result = $mysql->ExecuteStatement(array($title));
        $row = $result->fetch();
        return self::toUserGroup($row);
    }

    static function attachToFAQ($faq, $userGroup){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("insert into faq_user_groups(faq_id, user_group_id) values (? ,?);");
        $mysql->ExecuteStatement(array($faq->id, $userGroup->id));
    }
}
?>