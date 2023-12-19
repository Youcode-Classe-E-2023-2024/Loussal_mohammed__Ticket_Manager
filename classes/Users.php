<?php
require_once '../config/config.php';
require_once 'Database.php';
class Users extends Database
{
    private $usersTable = "hd_users";

    /** List All USERS:
     * @return mixed
     */
    public function listAllUsers() {
        $this->query('SELECT * From '. $this->usersTable);
        $this->execute();
        $users = $this->stmt->fetch(PDO::FETCH_ASSOC);
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
            $users = $this->stmt->fetch(PDO::FETCH_ASSOC);
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
        $this->query('INSERT INTO '. $this->usersTable .' (email, password, name) VALUES (:email, :password, :name);');
        $this->bind('email', $email);
        $this->bind(':password', $password);
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
}
$users = new Users();

