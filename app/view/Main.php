<?php

namespace App\View;

use App\Model\Main as Model;

class Main {
    
    public $content;

    function __construct($content)
    {
        $this->content = $content;
    }

    function html() {
        $obj = new Model();

        $table = '';
        for ($i = 0; $i < count($this->content); $i++) {
            @$table .= '
                <tr>
                    <th><a href="/?page=update">Update</a> | Delete</th>
                    <th>' . $this->content[$i]['id'] . '</th>
                    <th>' . $this->content[$i]['first_name'] . '</th>
                    <th>' . $this->content[$i]['last_name'] . '</th>
                    <th>' . $this->content[$i]['salary'] . ' $</th>
                    <th>' . $this->content[$i]['date_of_birth'] . '</th>
                </tr>
            ';
        }

        $pages = '';
        for ($i = 1; $i <= $obj->total_pages; $i++) {
            $pages .= "
                <a href='/?page=" . $i . "'>" . $i . "</a>";

        }
        
        $html = '
            <div class="container">

                <h1>Employees</h1>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <div class="divth">
                                    <form method="POST"><button type="submit" name="id" value="desc"><img src="/images/arrowup.png" /></button></form>
                                    Id
                                    <form method="POST"><button type="submit" name="id" value="asc"><img src="/images/arrowup.png" /></button></form>
                                </div>    
                            </th>
                            <th>
                                <div class="divth">
                                    <form method="POST"><button type="submit" name="first_name" value="desc"><img src="/images/arrowup.png" /></button></form>
                                    First name
                                    <form method="POST"><button type="submit" name="first_name" value="asc"><img src="/images/arrowup.png" /></button></form>
                                </div>    
                            </th>
                            <th>
                                <div class="divth">
                                    <form method="POST"><button type="submit" name="last_name" value="desc"><img src="/images/arrowup.png" /></button></form>
                                    Last name
                                    <form method="POST"><button type="submit" name="last_name" value="asc"><img src="/images/arrowup.png" /></button></form>
                                </div>    
                            </th>
                            <th>
                                <div class="divth">
                                    <form method="POST"><button type="submit" name="salary" value="desc"><img src="/images/arrowup.png" /></button></form>
                                    Salary
                                    <form method="POST"><button type="submit" name="salary" value="asc"><img src="/images/arrowup.png" /></button></form>
                                </div>    
                            </th>
                            <th>
                                <div class="divth">
                                    <form method="POST"><button type="submit" name="date_of_birth" value="desc"><img src="/images/arrowup.png" /></button></form>
                                    Date of birth
                                    <form method="POST"><button type="submit" name="date_of_birth" value="asc"><img src="/images/arrowup.png" /></button></form>
                                </div>    
                            </th>
                        </tr>
                    </thead>
            
                    <tbody>' . $table . '</tbody>
                
                </table>

                <div class="footer">
                    <div class="pages">' . $pages . '</div>
                    <div class="add">
                        <form method="POST" action="/?page=add">
                            <button type="submit">Add employee</button>
                        </form>
                    </div>
                </div>    

            </div>
        ';

        return $html;
    }

    function render() {
        
        ob_start();
        require_once './app/layouts/header.php';
        echo $this->html();
        require_once './app/layouts/footer.php';
        $html = ob_get_clean();
        
        return $html;
    }
    
}