<?php

namespace App\View;

class PageAdd {

    function htmlAdd() {

        $first_name = preg_match('/^[а-я]+$|^[a-z]+$/iu', @$_POST['first_name']) ? @$_POST['first_name'] : "";
        $last_name = preg_match('/^[а-я]+$|^[a-z]+$/iu', @$_POST['last_name']) ? @$_POST['last_name'] : "";
        $salary = preg_match('/^[0-9]+$/iu', @$_POST['salary']) ? @$_POST['salary'] : "";
        $date_of_birth = preg_match('/^(19|20)\d\d([-])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/iu', @$_POST['date_of_birth']) ? @$_POST['date_of_birth'] : "";

        $html = '
        <div class="container">
            <h1>Add employee</h1>
            <div class="forms">
                <form method="POST">
                    <input type="text" name="first_name" placeholder="first name" value="' . $first_name . '" required />
                    <input type="text" name="last_name" placeholder="last name" value="' . $last_name . '" required />
                    <input type="text" name="salary" placeholder="salary" value="' . $salary . '" required />
                    <input type="text" name="date_of_birth" placeholder="date of birth (Y-m-d)" value="' . $date_of_birth . '" required />
                    <button type="submit" name="send">Send</button>
                </form>

                <form method="POST" action="/">
                    <button type="submit">Back</button>
                </form>
            </div>    
        </div>
        ';

        return $html;
    }

    function render() {
        
        ob_start();
        require_once './app/layouts/header.php';
        echo $this->htmlAdd();
        require_once './app/layouts/footer.php';
        $html = ob_get_clean();
        
        return $html;
    }

}