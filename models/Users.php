<?php
require_once '../config/config.php';
require_once 'Database.php';
class Users extends Database
{
    private $usersTable = "hd_users";

    /** Login USER:
     * @param $email
     * @param $password
     * @return false
     */
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }


    /** List All USERS:
     * @return mixed
     */
    public function listAllUsers() {
        $this->query('SELECT * From '. $this->usersTable);
        $this->execute();
        $users = $this->resultSet();
        if ($users !== null) {
        }
        return $users;
    }

    /** List
     * @param $colName
     * @param $colValue
     * @return void
     * @throws Exception
     */
    public function listUser($colName, $colValue) {
        // Check Param Validation
        if($this->checkParam($colName)) {
            $this->query('SELECT * From '. $this->usersTable .' WHERE '. $colName .' = :colValue');
            $this->bind(':colValue', $colValue);
            $this->execute();
            $users = $this->single();
            if ($users !== null) {
            }
            return $users;
        }
    }

    /** ADD New User:
     * @param string $email
     * @param string $password
     * @param string $name
     * @return void
     * @throws Exception
     */
    public function addUser($email, $password, $name) {
        // Checking If Email Already Exists:
        $emailCheck = $this->emailExistance($email);
        if(!empty($emailCheck)) {
            header('Location:../html/');
        }
        $hashedPassword = hash('sha256', $password);
        $this->query('INSERT INTO '. $this->usersTable .' (email, password, name) VALUES (:email, :password, :name);');
        $this->bind('email', $email);
        $this->bind(':password', $hashedPassword);
        $this->bind('name', $name);
        $this->execute();
    }

    public function updateUser($valueCol, $value, $identifierCol, $identifier) {
        $this->allowedColumns = ['email', 'name', 'password', 'id'];
        $paramValidation = $this->checkParam($valueCol, $identifierCol);
        if($paramValidation) {
            $this->query('UPDATE '. $this->usersTable.'
                        SET '. $valueCol .' = :value 
                        WHERE '. $identifierCol .' = :identifier');
            $this->bind(':value', $value);
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
    }

    public function deleteUser($identifierCol, $identifier) {
        $this->allowedColumns = ['email', 'name', 'password', 'id'];
        $paramValidation = $this->checkParam($identifierCol);
        if($paramValidation) {
            $this->query('DELETE FROM '. $this->usersTable .' WHERE '. $identifierCol .' = :identifier');
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
    }

    /** Check If Email Already Exists:
     * @param string $email
     * @return mixed
     */
    public function emailExistance($email) {
        $this->query("SELECT * FROM ". $this->usersTable ." WHERE email = :email");
        $this->bind(':email', $email);
        $this->execute();
        return $this->single();
    }

    /** Email Validate:
     * @param string $email
     * @return bool
     */
    public function emailValidate($email) {
        if(!filter_var($email, FILTER_SANITIZE_EMAIL) || !preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            return false;
        } else {
            return true;
        }
    }

    /** Validate Name:
     * @param string $name
     * @return bool
     */
    public function nameValidate($name) {
        if(!filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS || !preg_match("/^[a-z A-Z]{10,30}$/", $name))) {
            return false;
        } else {
            return true;
        }
    }

    /** Validate Password:
     * @param string $password
     * @return bool
     */
    public function passwordValidate($password) {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/';
        if(!filter_var($password, FILTER_SANITIZE_STRING || !preg_match($pattern, $password)) || !strlen($password)) {
            return false;
        } else {
            return true;
        }
    }
}

