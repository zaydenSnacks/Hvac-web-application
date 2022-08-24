<?php
require_once('database.php');
require_once('hvac_db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home_page';
}

switch ($action) {
    case 'home_page':
        session_start();
        
        if(isset($_SESSION['firstName']))
            $_SESSION['firstName'] = null;
            session_destroy();

        include('HvacWebsite.php');
        break;
    case 'login':

        $email_address = filter_input(INPUT_POST, 'email_address');
        $password =  filter_input(INPUT_POST,'password');
        $employee_type = hvacDB::login($email_address, $password);
        
        if($employee_type == "admin")
            include("admin.php"); 
        else if($employee_type == "employee") {
            include("employee.php");
        }
        break;
    case 'create_user':
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email_address = filter_input(INPUT_POST, 'email_address');
        $address = filter_input(INPUT_POST, 'address');
        $zip_code = filter_input(INPUT_POST, 'zip_code');
        $phone_number = filter_input(INPUT_POST, 'phone_number');
        $problem =  filter_input(INPUT_POST, 'problem');
        
        hvacDB::create_user($first_name, $last_name, $email_address, $phone_number, $zip_code, $address, $problem);
        
        if(isset($_SESSION['firstName'])) {
            
            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }

        } else {
            include('HvacWebsite.php');
        }
        break;
    case'create_employee':
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email_address = filter_input(INPUT_POST, 'email_address');
        $phone_number = filter_input(INPUT_POST, 'phone_number');
        $password = filter_input(INPUT_POST, 'password');
        
        hvacDB::create_employee($first_name, $last_name, $email_address, $phone_number, $password);
        
        if(isset($_SESSION['firstName'])) {
            
            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }

        } else {
            include('HvacWebsite.php');
        }
        break;
        
        
        break;
    case 'user_look_up':
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email_address = filter_input(INPUT_POST, 'email_address');
        
        $rows = hvacDB::view_user_accounts_appointments($first_name, $last_name, $email_address);

        if(isset($_SESSION['firstName'])) {

            $_SESSION['user_look_up'] = $rows;
            
            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }
        } else {
            include('HvacWebsite.php');
        }
        break;
    case 'user_enter_appointments':
        $user_id = filter_input(INPUT_POST, 'user_id');
        $date = filter_input(INPUT_POST, 'date');
        $time = filter_input(INPUT_POST, 'time');

        hvacDB::enter_user_appointments($user_id, $date, $time);

        if(isset($_SESSION['firstName'])) {
            
            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }
        } else {
            include('HvacWebsite.php');
        }
        

        break;
    case 'view_employees':
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email_address = filter_input(INPUT_POST, 'email_address');

        $rows = hvacDB::view_employees($first_name, $last_name, $email_address);
        
        if(isset($_SESSION['firstName'])) {
            
            $_SESSION['view_employees'] = $rows;

            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }
        } else {
            include('HvacWebsite.php');
        }
        break;
    case 'employee_enter_appointments':
        $employee_id= filter_input(INPUT_POST, 'employee_id');
        $user_id = filter_input(INPUT_POST, 'user_id');

        hvacDB::enter_employee_appointments($user_id, $employee_id);
        
        if(isset($_SESSION['firstName'])) {
            
            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }
        } else {
            include('HvacWebsite.php');
        }
        break;
    case 'hvac_stock':
        $model = filter_input(INPUT_POST, 'model');
        $type = filter_input(INPUT_POST, 'type');
        
        $rows = hvacDB::view_hvac_stock($model, $type);
        
        if(isset($_SESSION['firstName'])) {
            
            $_SESSION['hvac_stock'] = $rows;
        
            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }
        } else {
            include('HvacWebsite.php');
        }
        break;
    case 'enter_account_balance':
        $user_id = filter_input(INPUT_POST, 'user_id');
        $amount = filter_input(INPUT_POST, 'amount');

        hvacDB::create_quote($user_id, $amount);

        if(isset($_SESSION['firstName'])) {

            if ($_SESSION['employee_type'] == "admin") {
                include("admin.php"); 
            } else if ($_SESSION['employee_type'] == "employee") {
                include("employee.php");
            }
        } else {
            include('HvacWebsite.php');
        }

        break;


}

?>

<!-- 
    
admin--

- enter_users                                               DONE
- view users and their account balance                      DONE        
- view all appointments                                     DONE
- enter appointments                                        DONE
- assign technicians(employees) to appointments             DONE
- create employees                                          DONE
- view employees                                            DONE
- take off technicians from appointments                    DONE
- view hvacs in stock                                       DONE

employee--

- enter_users                                               DONE
- enter appointments                                        DONE
- view there appointments / check off appointments --- (once check appointment type changes)    DONE 
- enter account balance for customer                        DONE
- view hvacs in stock                                       DONE 
 -->