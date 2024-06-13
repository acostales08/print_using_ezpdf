<?php

require("../database/config.php");
require("../query/queries.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

interface Ipost
{
    public function fetchController();
    public function insertData($data, $students);
    public function fetchTwoTable();
}

class projectController extends Database implements Ipost
{
    public function fetchController()
    {
        $query = new QueryBuilder();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($this->php_prepare($query->fetchQuery("student/fetch"))) {
                try {
                    $this->php_execute();
                    if ($this->php_rowCount()) {
                        $data = $this->php_fetchAll();
                        $response = array(
                            "status" => "success",
                            "data" => $data
                        );
                        echo json_encode($response);
                    } else {
                        throw new Exception("No data found.");
                    }
                } catch (Exception $e) {
                    $response = array(
                        "status" => "error",
                        "message" => $e->getMessage()
                    );
                    echo json_encode($response);
                }
            }
        }
    }

    public function insertData($data, $students)
    {
        $query = new QueryBuilder();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->php_prepare($query->insertQuery("header/insert"))) {
                $this->php_dynamic_handler(":fetcherCode", $data['fetcherCode']);
                $this->php_dynamic_handler(":fetcherName", $data['fetcherName']);
                $this->php_dynamic_handler(":contactNum", $data['contactNum'], 2);
                $this->php_dynamic_handler(":regDate", $data['regDate']);
                $this->php_dynamic_handler(":isActive", $data['isActive'], 2);
                $this->php_execute();
            } else {
                throw new Exception("Header insertion failed.");
            }

            if ($this->php_prepare($query->insertQuery("details/insert"))) {
                foreach ($students as $student) {
                    $studentCode = $student['studentCode'];
                    $relationship = $student['relation'];
                    $this->php_dynamic_handler(":studentCode", $studentCode);
                    $this->php_dynamic_handler(":fetcherCode", $data['fetcherCode']);
                    $this->php_dynamic_handler(":relationship", $relationship);
                    if (!$this->php_execute()) {
                        throw new Exception("Details insertion failed.");
                    }
                }
            } else {
                throw new Exception("Details preparation failed.");
            }

            $response = array(
                "status" => "success",
                "message" => "All data successfully inserted"
            );
            echo json_encode($response);
        }
    }

    public function fetchTwoTable()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $query = new QueryBuilder();
            if ($this->php_prepare($query->fetchTwoTable("fetchTwo/get"))) {
                $this->php_execute();
                if ($this->php_rowCount()) {
                    $fetchData = $this->php_fetchAll();
                    $response = array(
                        "status" => "success",
                        "data" => $fetchData
                    );
                    echo json_encode($response);
                }
            }
        }
    }
}
