<?php

class QueryBuilder
{
    public function fetchQuery($condition)
    {
        if ($condition == "student/fetch") {
            $query = "SELECT studentCode FROM studentfile";
            return  $query;
        }
    }

    public function insertQuery($condition)
    {
        if ($condition == "header/insert") {

            $query = "INSERT INTO fetcherfile (fetcherCode, fetcherName, contactNum, regDate, isActive) VALUES (:fetcherCode, :fetcherName, :contactNum, :regDate, :isActive)";
            return $query;
        }
        if ($condition == "details/insert") {

            $query = "INSERT INTO details (studentCode, fetcherCode, relationship) VALUES (:studentCode, :fetcherCode, :relationship)";
            return $query;
        }
    }

    public function fetchTwoTable($condition)
    {
        if ($condition == "fetchTwo/get") {
            $query = "SELECT f.fetcherCode, d.studentCode, f.fetcherName, d.relationship, s.fullName
            FROM fetcherfile AS f
            JOIN details AS d ON f.fetcherCode = d.fetcherCode
            JOIN studentfile AS s ON d.studentCode = s.studentCode;";
            return $query;
        }
    }
}
