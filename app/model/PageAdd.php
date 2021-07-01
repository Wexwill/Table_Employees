<?php

namespace App\Model;

use \App\DB;

class PageAdd {

    public $first_name;
    public $last_name;
    public $salary;
    public $date_of_birth;

    function __construct()
    {
        if (!empty($_POST['first_name']) && preg_match('/^[а-я]+$|^[a-z]+$/iu', $_POST['first_name'])) $this->first_name = $_POST['first_name'];

        if (!empty($_POST['last_name']) && preg_match('/^[а-я]+$|^[a-z]+$/iu', $_POST['last_name'])) $this->last_name = $_POST['last_name'];

        if (!empty($_POST['salary']) && preg_match('/^[0-9]+$/iu', $_POST['salary'])) $this->salary = $_POST['salary'];

        if (!empty($_POST['date_of_birth']) && preg_match('/^(19|20)\d\d([-])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/iu', $_POST['date_of_birth'])) $this->date_of_birth = $_POST['date_of_birth'];
    }

    function sendData() {
        
        if (is_object(DB::connect())
            && !empty($this->first_name)
            && !empty($this->last_name)
            && !empty($this->salary)
            && !empty($this->date_of_birth)
            ) {
            $pdo = DB::connect();
            $data = [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'salary' => $this->salary,
                'date_of_birth' => $this->date_of_birth
            ];
            $sql = "INSERT INTO `employees` (first_name, last_name, salary, date_of_birth) VALUES (:first_name, :last_name, :salary, :date_of_birth)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        }
    }
}