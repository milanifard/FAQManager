<?php


class Ticket {
    public $id;
    public $title;
    public $description;
    public $projectId = -1;
    public $time;

    static function toTicket($row){
        $t = new Ticket();
        $t->id = $row["id"];
        $t->title = $row["title"];
        $t->description = $row["description"];
        $t->time = $row["created_date"];
        return $t;
    }

    static function save($title, $description, $userGroupId, $pageId) {
        $mysql = pdodb::getInstance();
        $mysql->Prepare("insert into tickets (title, description, project_id, tkt_bug_report_page, creator_type) values (?, ?, -1, ?, ?);");
    }
    
    static function getAllByContainsTerm($term){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from tickets
        where (title like CONCAT('%',?,'%')
        or description like CONCAT('%',?,'%'));");
        $result = $mysql->ExecuteStatement(array($term, $term));

        $tickets = array();
        while($row = $result->fetch()){
            array_push($tickets, self::toTicket($row));
        }
        return $tickets;
    }
    static function getAll(){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from tickets;");
        $result = $mysql->ExecuteStatement(array());

        $tickets = array();
        while($row = $result->fetch()){
            array_push($tickets, self::toTicket($row));
        }
        return $tickets;
    }
}
?>