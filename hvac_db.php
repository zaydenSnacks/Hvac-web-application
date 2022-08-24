<?php
class hvacDB
{
    public static function login($email_address, $password)
    {
        $db = DATABASE::getDB();
        $query = "SELECT emailAddress, password, firstName, lastName, employeeId FROM employees WHERE emailAddress = :email_address AND password = :password";
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":email_address", $email_address);
            $statement->bindValue(":password", $password);
            $statement->execute();

            $rows = $statement->fetchAll();
            $statement->closeCursor();

            if(count($rows) == 1)
            {
                session_start();
                $_SESSION['firstName'] = $rows[0]['firstName'];
                $_SESSION['lastName'] = $rows[0]['lastName'];
                

                if($rows[0]['employeeId'] == 1) // Manager 
                {
                    $_SESSION['employee_type'] = "admin";
                    return "admin";
                } else {
                    $_SESSION['employee_type'] = "employee";
                    return "employee";
                }

            } else {
                
                include("HvacWebsite.php");
            }

        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo $error;
            include("HvacWebsite.php");
        }
    }
    
    private static function create_account($email_address, $phone_number)
    {
        $db = DATABASE::getDB();
        $users_query = "SELECT u.userId FROM users u WHERE :email_address = u.emailAddress AND :phone_number = u.phoneNumber";
        $accounts_query = "INSERT INTO accounts (balance, userId) VALUES (0, :userId)";
        try {
            $statement = $db->prepare($users_query);
            $statement->bindValue(":email_address", $email_address);
            $statement->bindValue(":phone_number", $phone_number);
            $statement->execute();
            $u_rows = $statement->fetchAll();
            $statement->closeCursor();
            
            

            $statement = $db->prepare($accounts_query);
            $statement->bindValue(":userId", $u_rows[0]['userId']);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo $error;
        }
    }



    private static function create_appointments($email_address, $phone_number)
    {
        $db = DATABASE::getDB();
        $users_query = "SELECT u.userId, u.address FROM users u WHERE :email_address = u.emailAddress AND :phone_number = u.phoneNumber";
        $appointment_query = "INSERT INTO appointments (address, userId) VALUES (:address, :userId)";
        try {
            $statement = $db->prepare($users_query);
            $statement->bindValue(":email_address", $email_address);
            $statement->bindValue(":phone_number", $phone_number);
            $statement->execute();
            $u_rows = $statement->fetchAll();
            $statement->closeCursor();

            $statement = $db->prepare($appointment_query);
            $statement->bindValue(":address", $u_rows[0]['address']);
            $statement->bindValue(":userId", $u_rows[0]['userId']);
            $statement->execute();
            $statement->closeCursor();

        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo $error;
        }
    }

    
    public static function create_user($first_name, $last_name, $email_address, $phone_number, $zip_code, $address, $problem)
    {
        session_start();
        $db = DATABASE::getDB();
        $query = "INSERT INTO users (firstName, lastName, emailAddress, phoneNumber, address, zipCode, problem) VALUES (:first_name, :last_name, :email_address, :phone_number, :address, :zip_code, :problem)";
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":first_name", $first_name);
            $statement->bindValue(":last_name", $last_name);
            $statement->bindValue(":email_address", $email_address);
            $statement->bindValue(":phone_number", $phone_number);
            $statement->bindValue(":address", $address);
            $statement->bindValue(":zip_code", $zip_code);
            $statement->bindValue(":problem", $problem);
            $statement->execute();
            $statement->closeCursor();

            self::create_account($email_address, $phone_number); 
            self::create_appointments($email_address, $phone_number);

        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo $error;
        }
       
    }

    public static function create_employee($first_name, $last_name, $email_address, $phone_number, $password)
    {
        session_start();
        $db = DATABASE::getDB();
        $query = "INSERT INTO employees (firstName, lastName, emailAddress, phoneNumber, password) VALUES (:first_name, :last_name, :email_address, :phone_number, :password)";
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":first_name", $first_name);
            $statement->bindValue(":last_name", $last_name);
            $statement->bindValue(":email_address", $email_address);
            $statement->bindValue(":phone_number", $phone_number);
            $statement->bindValue(":password", $password);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            print($error);
        }
    }

    public static function create_quote($user_id, $amount)
    {
        session_start();
        $db = DATABASE::getDB();
        $query = "UPDATE accounts SET balance = :amount WHERE userId = :user_id ";
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":user_id", $user_id);
            $statement->bindValue(":amount", -1 * $amount);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            print($error);
        }
    }

    public static function enter_user_appointments($user_id, $date, $time)
    {
        session_start();
        $db = DATABASE::getDB();
        $query = "UPDATE appointments SET time = :time, date = :date WHERE userId = :user_id ";
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":user_id", $user_id);
            $statement->bindValue(":date", $date);
            $statement->bindValue(":time", $time);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            print($error);
        }
    }

    public static function enter_employee_appointments($user_id, $employee_id)
    {
        session_start();
        $db = DATABASE::getDB();
        $query = "UPDATE appointments SET employeeId = :employee_id WHERE userId = :user_id ";
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":user_id", $user_id);
            $statement->bindValue(":employee_id", $employee_id);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            print($error);
        }
    }

    public static function view_user_accounts_appointments($first_name, $last_name, $email_address)
    {
    
        session_start(); 
        $db = DATABASE::getDB();
        if ($first_name == '' && $last_name == '' && $email_address == '')
        {
            $query = "SELECT u.userId, u.firstName, u.lastName, u.emailAddress, u.phoneNumber, u.address, ap.date, ap.time, a.balance, ap.employeeId FROM users u INNER JOIN accounts a ON u.userId = a.userId INNER JOIN appointments ap ON u.userId = ap.userId";
        } else {
            $query = "SELECT u.userId, u.firstName, u.lastName, u.emailAddress, u.phoneNumber, u.address, ap.date, ap.time, a.balance, ap.employeeId FROM users u INNER JOIN accounts a ON u.userId = a.userId INNER JOIN appointments ap ON u.userId = ap.userId WHERE u.firstName = '".$first_name."' AND u.lastName = '".$last_name."' AND u.emailAddress = '".$email_address."';";
        }
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            $statement->closeCursor();
            return $rows;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            print($error);
        }
    }

    public static function view_hvac_stock($model, $type)
    {
        session_start();
        $db= DATABASE::getDB();
        if ($model == '' && $type == '') {
            $query = "SELECT serialNumber, Model, hvacType, numberOf FROM hvac";
        } else {
            $query = "SELECT serialNumber, Model, hvacType, numberOf FROM hvac WHERE Model = :model AND hvacType = :type";
        }

        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":type", $type);
            $statement->bindValue(":model", $model);
            $statement->execute();
            $rows = $statement->fetchAll();
            $statement->closeCursor(); 
            return $rows;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            print($error);
        }
    }

    public static function view_employees($first_name, $last_name, $email_address)
    {
        session_start(); 
        $db = DATABASE::getDB();
        if ($first_name == '' && $last_name == '' && $email_address == '')
        {
            $query = "SELECT e.employeeId, e.firstName, e.lastName, e.emailAddress, e.phoneNumber, ap.date, ap.time FROM employees e LEFT JOIN appointments ap ON e.employeeId = ap.employeeId";
        } else {
            $query = "SELECT e.employeeId, e.firstName, e.lastName, e.emailAddress, e.phoneNumber, ap.date, ap.time FROM employees e LEFT JOIN appointments ap ON e.employeeId = ap.employeeId WHERE e.firstName = '".$first_name."' AND e.lastName = '".$last_name."' AND e.emailAddress = '".$email_address."'";
        }
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            $statement->closeCursor();
            return $rows;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            print($error);
        }
    }
}
