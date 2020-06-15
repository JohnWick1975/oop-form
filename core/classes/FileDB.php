<?php


class FileDB
{
    private $file_name;
    private $data;

    /**
     * FileDB constructor.
     * @param string $file_name
     */
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * Set an array into the object $data.
     *
     * @param array $data_array
     */
    public function setData(array $data_array)
    {
        $this->data = $data_array;
    }

    /**
     * Save object $data array to DB.
     */
    public function save()
    {
        array_to_file($this->data, $this->file_name);
    }

    /**
     * Load an array from file to object $data.
     */
    public function load()
    {
        $data_array = file_to_array($this->file_name);
        $this->data = $data_array ? $data_array : [];
    }

    /**
     * Return object $data array.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Create table in object $data array if not exists.
     *
     * @param string $table_name
     * @return bool
     */
    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * Check for а table in an $data array exists.
     *
     * @param string $table_name
     * @return bool
     */
    public function tableExists(string $table_name): bool
    {
        return isset($this->data[$table_name]);
    }

    /**
     * Delete the table in an object $data array.
     *
     * @param string $table_name
     * @return bool
     */
    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);
            return true;
        }

        return false;
    }

    /**
     * Erase table in an object $data array.
     *
     * @param string $table_name
     * @return bool
     */
    public function truncateTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }


    /**
     * Create the row in an object $data array table.
     *
     * @param string $table_name
     * @param array $row
     * @param int|null $row_id
     * @return bool|int|string|null
     */
    public function insertRow(string $table_name, array $row, int $row_id = null)
    {
        if (!$this->tableExists($table_name) || $this->rowExists($table_name, $row_id)) {
            return false;
        }

        if ($row_id) {
            $this->data[$table_name][$row_id] = $row;
        } else {
            $this->data[$table_name][] = $row;
            $row_id = array_key_last($this->data[$table_name]);
        }

        return $row_id;
    }

    /**
     * Check for row exists in an object array.
     *
     * @param string $table_name
     * @param int|null $row_id
     * @return bool
     */
    public function rowExists(string $table_name, $row_id): bool
    {
        return isset($this->data[$table_name][$row_id]);
    }

    /**
     * Create the row in an object array if it's not exists.
     *
     * @param string $table_name
     * @param array $row
     * @param int $row_id
     * @return bool|string
     */
    public function insertRowIfNotExists(string $table_name, array $row, int $row_id)
    {
        if (!$this->rowExists($table_name, $row_id)) {
            $this->insertRow($table_name, $row, $row_id);
            return $row_id;
        }

        return false;
    }

    /**
     * Change a row in an object array.
     *
     * @param string $table_name
     * @param int $row_id
     * @param array $row
     * @return bool
     */
    public function updateRow(string $table_name, array $row, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;
            return true;
        }

        return false;
    }

    /**
     * Delete row from an object array.
     *
     * @param string $table_name
     * @param int $row_id
     * @return bool
     */
    public function deleteRow(string $table_name, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);
            return true;
        }

        return false;
    }

    /**
     * Get row from an object array by $row_id index.
     *
     * @param string $table_name
     * @param int $row_id
     * @return bool|array
     */
    public function getRowById(string $table_name, int $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];
        }

        return false;
    }

    /**
     * Get rows array from an object $data array by entered conditions.
     *
     * @param string $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere(string $table_name, array $conditions): array
    {
        $rows = [];

        foreach ($this->data[$table_name] ?? [] as $row_id => $row) {
            $conditions_met = true;

            foreach ($conditions as $condition_key => $condition) {
                if ($row[$condition_key] !== $condition) {
                    $conditions_met = false;
                    break;
                }
            }

            if ($conditions_met) {
                $rows[$row_id] = $row;
            }
        }

        return $rows;
    }

    /**
     * Get row array from an object $data array by entered conditions.
     *
     * @param string $table_name
     * @param array $conditions
     * @return bool|mixed
     */
    public function getRowWhere(string $table_name, array $conditions)
    {
        if (!$conditions){
            return false;
        }

        foreach ($this->data[$table_name] ?? [] as $row_id => $row) {
            $conditions_met = true;

            foreach ($conditions as $condition_key => $condition) {
                if ($row[$condition_key] !== $condition) {
                    $conditions_met = false;
                    break;
                }
            }

            if ($conditions_met) {
                return $row;
            }
        }

        return false;
    }
}