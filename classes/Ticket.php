<?php


class Ticket {
    public $id;
    public $title;
    public $description;
    public $projectId = -1;

    static function save($title, $description, $userGroupId, $pageId) {
        $mysql = pdodb::getInstance();
        $mysql->Prepare("insert into tickets (title, description, project_id, tkt_bug_report_page, creator_type) values (?, ?, -1, ?, ?);");
        $mysql->ExecuteStatement(array($title, $description, $pageId, $userGroupId));
    }
}
?>