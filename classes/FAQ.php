<?php


class FAQ
{
    public $id;
    public $title;
    public $answer;
    public $click_count;

    static function getNewInstance($title, $answer, $click_count) {
        $faq = new FAQ();
        $faq->title = $title;
        $faq->answer = $answer;
        $faq->click_count = $click_count;
        return $faq;
    }

    static function add($faq){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("insert into faqs (title, answer, click_count) values (?, ?, ?);");
        $mysql->ExecuteStatement(array($faq->title, $faq->answer, $faq->click_count));
        
        $mysql->Prepare("select last_insert_id() as id;");
        $result = $mysql->ExecuteStatement(array());
        $row = $result->fetch();
        
        $faq->id = $row["id"];
        return $faq;
    }

    static function toFAQ($row){
        $faq = new FAQ();
        $faq->id = $row["id"];
        $faq->title = $row["title"];
        $faq->answer = $row["answer"];
        $faq->click_count = $row["click_count"];
        return $faq;
    }

    static function getAll($page_number){
        $mysql = pdodb::getInstance();
        $offset = $page_number * 10;
        $mysql->Prepare("select * from faqs order by id desc limit 10;");
        $result = $mysql->ExecuteStatement(array());

        $faqs = array();

        while($row = $result->fetch()){
            array_push($faqs, self::toFAQ($row));
        }
        return $faqs;
    }

    static function getById($id) {
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from faqs where id = ?;");
        $result = $mysql->ExecuteStatement(array($id));
        
        if ($row = $result->fetch()){
            return self::toFAQ($row);
        }

        return null;
    }

    static function getRelatedFAQ($title, $description, $pageId, $userGroupId){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select distinct f.*
        from keywords k
                 inner join faqs_keywords fk on k.id = fk.keyword_id
                 inner join faqs f on fk.faq_id = f.id
                 left join faq_user_groups fug on f.id = fug.faq_id and fug.user_group_id = ? 
                 left join faq_pages fp on f.id = fp.faq_id and fp.page_id = ? 
        where (? like CONCAT('%', term, '%')
            or ? like CONCAT('%', term, '%'))
          and fk.state = 1
        order by -fug.id, -fp.id;");
        // add page limit

        $result = $mysql->ExecuteStatement(array($userGroupId, $pageId, $title, $description));

        $faqs = array();
        while($row = $result->fetch()){
            array_push($faqs, self::toFAQ($row));
        }
        return $faqs;
    }

    function increaseClickCount(){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("update faqs
        set click_count = click_count + 1
        where id = ?");
        $mysql->ExecuteStatement(array($this->id));
    }

    function addUsefullKeyword($title, $description){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("insert into faqs_keywords(faq_id, keyword_id)
        select ?, k.id
        from keywords k
        left join faqs_keywords fk on k.id = fk.keyword_id and fk.faq_id = ?
        where (? like CONCAT('%',term,'%')
        or ? like CONCAT('%',term,'%'))
        and fk.id is null");
        $mysql->ExecuteStatement(array($this->id, $this->id, $title, $description));
    }
}