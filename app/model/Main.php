<?php

namespace App\Model;

use \App\DB;

class Main {

    public $posts_page = 10;
    public $page = 1;
    public $total_count_posts;
    public $total_pages;
    public $offset;


    function __construct()
    {
        if (isset($_GET['page'])) {
            $this->page = (int) $_GET['page'];
        }

        if (is_object(DB::connect())) {
            $pdo = DB::connect();
            $sql = "SELECT COUNT(`id`) AS `total_count` FROM `employees`";
            $query = $pdo->query($sql);
            $count = $query->fetchObject(); 
            $this->total_count_posts = $count->total_count;
        }

        $this->total_pages = ceil($this->total_count_posts / $this->posts_page);

        if ($this->page <= 1 || $this->page > $this->total_pages) {
            $this->page = 1;
        }

        $this->offset = ($this->posts_page * $this->page) - $this->posts_page;
    }

    function get_content() {
        if (is_object(DB::connect())) {
            $pdo = DB::connect();
            $sql = "SELECT * FROM `employees` LIMIT {$this->offset}, {$this->posts_page}";

            if (@$_POST['id'] == 'asc' || @$_POST['first_name'] == 'asc' || @$_POST['last_name'] == 'asc' || @$_POST['salary'] == 'asc' || @$_POST['date_of_birth'] == 'asc') {
                $cell = array_keys($_POST, 'asc')[0];
                setcookie("sort", 'ASC', time()+9999);
            }
            if (@$_POST['id'] == 'desc' || @$_POST['first_name'] == 'desc' || @$_POST['last_name'] == 'desc' || @$_POST['salary'] == 'desc' || @$_POST['date_of_birth'] == 'desc') {
                $cell = array_keys($_POST, 'desc')[0];
                setcookie("sort", 'DESC', time()+9999);
            }
            if (isset($_POST['id']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['salary']) || isset($_POST['date_of_birth'])) setcookie("cell", $cell, time()+9999);

            if (isset($_POST['id']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['salary']) || isset($_POST['date_of_birth'])) {
                $sql = "SELECT * FROM `employees` ORDER BY `{$cell}` {$_POST["$cell"]} LIMIT {$this->offset}, {$this->posts_page}";
            } elseif (isset($_COOKIE['sort']) && isset($_COOKIE['cell'])) {
                $sql = "SELECT * FROM `employees` ORDER BY `{$_COOKIE['cell']}` {$_COOKIE['sort']} LIMIT {$this->offset}, {$this->posts_page}";
            }

            $query = $pdo->query($sql);
            $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $result;
    }
}