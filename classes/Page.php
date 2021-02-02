<?php

class Page{
    public $id;
    public $title;
    public $url;

    function __construct($title, $url, $id)
    {
        $this-> title = $title;
        $this-> url = $url;
        $this-> id = $id;
    }

    public static function toPage($fetched_row){
        return new Page($fetched_row["title"], $fetched_row["url"], $fetched_row["id"]);
    }

    public function exists($faq_id, $page_id){
        $mysql->Prepare("select * from faq_pages where faq_id = ? and page_id = ?;");
        $result = $mysql->ExecuteStatement(array($faq_id, $page_id));
        if($result->fetch())
            return false;
        return true;

    }

    static function attachPageToFAQ($faq, $page_title, $page_url){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from pages where title = ? and url = ?;");
        $result = $mysql->ExecuteStatement(array($page_title, $page_url));
        
        $page = null;
        if ($row = $result->fetch()){
            $page = self::toPage($row);
        } else{
            $mysql->Prepare("insert into pages (title, url) values (?, ?);");
            $result = $mysql->ExecuteStatement(array($page_title, $page_url));
            
            $mysql->Prepare("select * from pages where title = ? and url = ?;");
            $result = $mysql->ExecuteStatement(array($page_title, $page_url));
            $row = $result->fetch();
            $page = self::toPage($row);
        }

        
        $mysql->Prepare("insert into faq_pages (faq_id, page_id) values (?,?);");
        $result = $mysql->ExecuteStatement(array($faq->id, $page->id));
        
    }

    static function getAllPagesByFAQ($faq){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select p.* from faq_pages inner join pages p on faq_pages.page_id = p.id where faq_id = ?;");
        $result = $mysql->ExecuteStatement(array($faq->id));

        $pages = array();
        while($row = $result->fetch()){
            // print_r($row);
            array_push($pages, self::toPage($row));
        }
        // print_r($pages);
        return $pages;
    }
}


?>