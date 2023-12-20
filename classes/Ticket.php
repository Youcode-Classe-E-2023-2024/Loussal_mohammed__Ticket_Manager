<?php

class Ticket extends Database
{
    private $ticketTable = 'hd_tickets';

    /** List All Departmens:
     * @return array
     */
    public function listTickets()
    {
        $this->query('SELECT * FROM ' .$this->ticketTable .' WHERE supprimer = false');
        $this->execute();
        $departments = $this->resultSet();

        return $departments;
    }


    /** ADD New Department:
     * @param string $name
     * @param int $status
     * @return void
     */
    public function addTicket($name, $status) {
        $this->query('INSERT INTO '. $this->ticketTable .' (name, status) 
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
    public function updateTicket($valueCol, $value, $identifierCol, $identifier) {
        $this->allowedColumns = ['name', 'status', 'id'];
        $paramValidation = $this->checkParam($valueCol, $identifierCol);
        if($paramValidation) {
            $this->query('UPDATE '. $this->ticketTable .'
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
    public function softDeleteTicket($colName, $colValue) {
        // Check Params Validation
        $this->allowedColumns = ['name', 'status'];
        $paramValidation = $this->checkParam($colName);
        // Check if the department is already deleted
        $existingState = $this->getDepartmentState($colName, $colValue);

        if ($paramValidation === 1) {
            if ($existingState === false) {
            } elseif (!$existingState['supprimer']) {
                $this->query('UPDATE ' . $this->ticketTable . '
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
    public function getTicketState($colName, $colValue) {
        $this->query('SELECT supprimer FROM ' . $this->ticketTable . '
                  WHERE ' . $colName . ' = :colValue');

        $this->bind(':colValue', $colValue);
        $result = $this->single();

        return $result;
    }
}