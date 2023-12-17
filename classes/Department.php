<?php
require_once 'Database.php';
include_once '../config/config.php';
class Department extends Database {
    private $departmentTable = "hd_departments";

    /** List All Departmens:
     * @return array
     */
    public function listDepartments()
    {
        $this->query('SELECT * FROM ' .$this->departmentTable .' WHERE supprimer = false');
        $this->execute();
        $departments = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        return $departments;
    }

    /** ADD New Department:
     * @param string $name
     * @param int $status
     * @return void
     */
    public function addDepartment($name, $status) {
        $this->query('INSERT INTO '. $this->departmentTable .' (name, status) 
            VALUES(:name, :status)');
        $this->bind('name', $name);
        $this->bind('status', $status);
        $this->execute();
    }

    /** Update Department Details:
     * @param string $valueCol
     * @param mixed $value
     * @param string $identifierCol
     * @param mixed $identifier
     * @return void
     * @throws Exception
     */
    public function update($valueCol, $value, $identifierCol, $identifier) {
        $paramValidation = $this->checkParam($valueCol, $identifierCol);
        if($paramValidation) {
            $this->query('UPDATE '. $this->departmentTable .'
                        SET '. $valueCol .' = :value 
                        WHERE '. $identifierCol .' = :identifier');
            $this->bind(':value', $value);
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
        }

    /** Soft Delete Department:
     * @param string $colName Column name for identification
     * @param mixed  $colValue Value for identification
     * @throws Exception
     */
    public function softDeleteDepartmentByName($colName, $colValue) {
    // Check Params Validation
    $paramValidation = $this->checkParam($colName);
    // Check if the department is already deleted
    $existingState = $this->getDepartmentState($colName, $colValue);

        if ($paramValidation === 1) {
            if ($existingState === false) {
                // Handle the case where the department doesn't exist
                // (you might throw an exception or handle it as needed)
            } elseif (!$existingState['supprimer']) {
                $this->query('UPDATE ' . $this->departmentTable . '
                          SET supprimer = true
                          WHERE ' . $colName . ' = :colValue');

                $this->bind(':colValue', $colValue);
                $this->execute();
            }
        }
}

    /** Get Department State:
     * @param string $colName Column name for identification
     * @param mixed  $colValue Value for identification
     * @return array|null
     */
    public function getDepartmentState($colName, $colValue) {
        $this->query('SELECT supprimer FROM ' . $this->departmentTable . '
                  WHERE ' . $colName . ' = :colValue');

        $this->bind(':colValue', $colValue);
        $result = $this->stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
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
$name = $depa->listDepartments();
print_r($name);
$depa->update('name', 'Testing', 'id', 2);
$depa->softDeleteDepartmentByName('name', 'Testing');
print_r($name);