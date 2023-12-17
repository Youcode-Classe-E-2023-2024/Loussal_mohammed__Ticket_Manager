<?php
require_once 'Database.php';
include_once '../config/config.php';
class Department extends Database {
    private $departmentTable = "hd_departments";

    /** List All Departmens
     * @return array
     */
    public function listDepartment()
    {
        $this->query('SELECT name FROM ' . $this->departmentTable . ' WHERE id = 2');
        $this->execute();
        $departments = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        return $departments;
    }

    public function addDepartment($department) {
        $this->query('');
    }

    /** Update department
     * @param $valueCol string
     * @param $value string|int|bool|null
     * @param $identifierCol string
     * @param $identifier string|int|bool|null
     * @return void
     */

    /** Update Department Details
     * @param $valueCol
     * @param $value
     * @param $identifierCol
     * @param $identifier
     * @return void
     * @throws Exception
     */
    public function update($valueCol, $value, $identifierCol, $identifier) {
        if($this->checkParam($valueCol, $identifierCol)) {
            $this->query('UPDATE '. $this->departmentTable .'
                        SET '. $valueCol .' = :value 
                        WHERE '. $identifierCol .' = :identifier');
            $this->bind(':value', $value);
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
        }


//        if (!empty($_POST['search']['value'])) {
//            $this->stmt .= ' WHERE id LIKE "%' . $_POST["search"]["value"] . '%"
//                        OR name LIKE "%' . $_POST["search"]["value"] . '%"
//                        OR status LIKE "%' . $_POST["search"]["value"] . '%"';
//        }
//
//        if (!empty($_POST['order'])) {
//            $this->stmt .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'];
//        } else {
//            $this->stmt .= ' ORDER BY id DESC';
//        }
//
//        if ($_POST['length'] != -1) {
//            $this->stmt .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
//        }
//
//        $this->stmt->execute();
//        $departmentData = array();
//
//        while ($department = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
//            $departmentRows = array();
//            $status = '';
//
//            if ($department['status'] == 1) {
//                $status = '<span class="label label-success">Enabled</span>';
//            } else if ($department['status'] == 0) {
//                $status = '<span class="label label-danger">Disabled</span>';
//            }
//
//            $departmentRows[] = $department['id'];
//            $departmentRows[] = $department['name'];
//            $departmentRows[] = $status;
//            $departmentRows[] = '<button type="button" name="update" id="' . $department["id"] . '" class="btn btn-warning btn-xs update">Edit</button>';
//            $departmentRows[] = '<button type="button" name="delete" id="' . $department["id"] . '" class="btn btn-danger btn-xs delete">Delete</button>';
//            $departmentData[] = $departmentRows;
//        }
//
//        $output = array(
//            "draw" => intval($_POST["draw"]),
//            "recordsTotal" => count($departmentData), // Assuming $departmentData contains all records
//            "recordsFiltered" => count($departmentData),
//            "data" => $departmentData
//        );
//        if($output != null) {
//            print_r($output);
//        } else {
//            echo 'this array is empty';
//        }




//    public function getDepartmentDetails() {
//        if($this->departmentId) {
//            $this->stmt = $this->dbh->prepare("
//            SELECT id, name, status FROM" .$this->department. "WHERE id = '" .$this->departmentId ."'");
//            $result = $this->stmt->execute(PDO::FETCH_ASSOC);
//            var_dump($result);
//
//        }
//    }
}
$database = new Database();
$depa = new Department();
$name = $depa->listDepartment();
print_r($name);
$depa->update('name', "Testing", 'id', 2);
print_r($name);