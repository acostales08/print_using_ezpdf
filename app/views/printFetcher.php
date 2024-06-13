<?php
require_once('../lib/ezpdfclass/class/class.ezpdf.php');
require_once('../include/func_pdf2tab.php');

$xhost = 'localhost';
$uname = 'root';
$xpw = '';
$xdbname = 'fetcherdb';
$xcnstr = "mysql:host=$xhost;dbname=$xdbname;charset=utf8";
$xopt = array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");

try {
    $link_id = new PDO($xcnstr, $uname, $xpw, $xopt);
} catch (Exception $e) {
    echo "No Connection";
    exit();
}

if ($_POST["txt_repoutput"] == "pdf") {
    $pdf = new Cezpdf('Letter', 'portrait');
} else {
    $pdf = new tab_ezpdf('Letter', 'portrait');
}

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d');

$pdf->selectFont("../lib/ezpdfclass/fonts/Helvetica.afm");
$xheader = $pdf->openObject();
$pdf->saveState();

$xfsize = 10;
$xtop = 750;
$xdate = 735;

$pdf->ezPlaceData(125, $xtop, "<b>FETCHER FILE REPORT</b>", 12, 'left');
$pdf->ezPlaceData(125, $xdate, "<b>Date Printed: $currentDateTime</b>", 10, 'left');

$xtop -= 30;

$fetcherFrom = $_POST['txtFetchFrom'];
$fetcherTo = $_POST['txtFetchTo'];
$dateFrom = $_POST['txtregDateFrom'];
$dateTo = $_POST['txtregDateTo'];
$isActive = isset($_POST['selectStatus']) ? 1 : null;
$reportType = isset($_POST['reportType']) ? $_POST['reportType'] : 'detailed';

if ($reportType == "detailed") {
    $x1 = 120;
    $x2 = 487;
    $pdf->line($x1, $xtop, $x2, $xtop);
    $xtop -= 15;

    $xleft1 = array();
    $xleft1[0] = 125;
    $xleft1[1] = $xleft1[0] + 150;
    $xleft1[2] = $xleft1[1] + 145;
    $xleft1[3] = $xleft1[2] + 80;

    $pdf->ezPlaceData($xleft1[0], $xtop, "Student Code", $xfsize, 'left');
    $pdf->ezPlaceData($xleft1[1], $xtop, "Student Name", $xfsize, 'left');
    $pdf->ezPlaceData($xleft1[2], $xtop, "Relationship", $xfsize, 'left');

    $xtop -= 5;

    $pdf->line($x1, $xtop, $x2, $xtop);

    $pdf->restoreState();
    $pdf->closeObject();
    $pdf->addObject($xheader, 'all');

    $xqry = "SELECT f.fetcherCode, d.studentCode, f.fetcherName, d.relationship, s.fullName, f.regDate, f.isActive
    FROM fetcherfile AS f
    JOIN details AS d ON f.fetcherCode = d.fetcherCode
    JOIN studentfile AS s ON d.studentCode = s.studentCode
    WHERE f.fetcherCode BETWEEN :fetcherFrom AND :fetcherTo
    AND f.regDate BETWEEN :dateFrom AND :dateTo";

    if ($isActive !== null) {
        $xqry .= " AND f.isActive = :isActive";
    }

    $xstmt = $link_id->prepare($xqry);
    $xstmt->bindParam(':fetcherFrom', $fetcherFrom);
    $xstmt->bindParam(':fetcherTo', $fetcherTo);
    $xstmt->bindParam(':dateFrom', $dateFrom);
    $xstmt->bindParam(':dateTo', $dateTo);

    if ($isActive !== null) {
        $xstmt->bindParam(':isActive', $isActive, PDO::PARAM_INT);
    }

    $xstmt->execute();
    $totalFetchers = 0;
    $totalStudents = 0;

    $printedFetchCodes = array();
    $fetcherCodeCounts = array();

    while ($xrs = $xstmt->fetch(PDO::FETCH_ASSOC)) {
        $fetcCode = $xrs["fetcherCode"];

        if (!isset($fetcherCodeCounts[$fetcCode])) {
            $fetcherCodeCounts[$fetcCode] = 0;
        }

        if (!in_array($fetcCode, $printedFetchCodes)) {
            if (!empty($printedFetchCodes)) {

                $currentFetcherCode = end($printedFetchCodes);
                $totalStudentsForCurrentFetcher = $fetcherCodeCounts[$currentFetcherCode];

                $xtop -= 15;
                $pdf->line($x1, $xtop, $x2, $xtop);

                $xtop -= 15;
                $xl1 = array();
                $xl1[0] = 125;
                $xl1[1] = $xl1[0] + 350;
                $pdf->ezPlaceData($xl1[0], $xtop, 'Total Students: ', 11, 'left');
                $pdf->ezPlaceData($xl1[1], $xtop, $totalStudentsForCurrentFetcher, 11, 'left');
            }

            echo $fetcCode;
            $printedFetchCodes[] = $fetcCode;
            $totalFetchers++;
            $xtop -= 25;
            $pdf->ezPlaceData($xleft1[0], $xtop, $fetcCode, 11, 'left');
        }

        $xtop -= 15;
        $pdf->ezPlaceData($xleft1[0], $xtop, $xrs["studentCode"], $xfsize, 'left');
        $pdf->ezPlaceData($xleft1[1], $xtop, $xrs["fullName"], $xfsize, 'left');
        $pdf->ezPlaceData($xleft1[2], $xtop, $xrs["relationship"], $xfsize, 'left');
        $pdf->ezPlaceData($xleft1[3], $xtop, '', $xfsize, 'left');


        $fetcherCodeCounts[$fetcCode]++;
        $totalStudents++;
    }

    if (!empty($printedFetchCodes)) {
        $currentFetcherCode = end($printedFetchCodes);
        $totalStudentsForCurrentFetcher = $fetcherCodeCounts[$currentFetcherCode];

        $xtop -= 15;
        $pdf->line($x1, $xtop, $x2, $xtop);

        $xtop -= 15;
        $xl1 = array();
        $xl1[0] = 125;
        $xl1[1] = $xl1[0] + 350;
        $pdf->ezPlaceData($xl1[0], $xtop, 'Total Students: ', 11, 'left');
        $pdf->ezPlaceData($xl1[1], $xtop, $totalStudentsForCurrentFetcher, 11, 'left');
    }


    $xtop -= 30;
    $pdf->ezPlaceData($xleft1[0], $xtop, 'Total Fetchers: ' . $totalFetchers, 11, 'left');
    $xtop -= 15;
    $pdf->ezPlaceData($xleft1[0], $xtop, 'Total Students: ' . $totalStudents, 11, 'left');
} else {
    $x1 = 75;
    $x2 = 430;
    $pdf->line($x1, $xtop, $x2, $xtop);
    $xtop -= 15;

    $xleft1 = array();
    $xleft1[0] = 75;
    $xleft1[1] = $xleft1[0] + 85;
    $xleft1[2] = $xleft1[1] + 105;
    $xleft1[3] = $xleft1[2] + 155;
    $xleft1[4] = $xleft1[3] + 50;

    $pdf->ezPlaceData($xleft1[0], $xtop, "Fetcher Code", $xfsize, 'left');
    $pdf->ezPlaceData($xleft1[1], $xtop, "Fetcher Name", $xfsize, 'left');
    $pdf->ezPlaceData($xleft1[2], $xtop, "Registered Date", $xfsize, 'left');
    $pdf->ezPlaceData($xleft1[3], $xtop, "No. Student", $xfsize, 'right');

    $xtop -= 5;

    // Second Line
    $pdf->line($x1, $xtop, $x2, $xtop);

    $pdf->restoreState();
    $pdf->closeObject();
    $pdf->addObject($xheader, 'all');

    $xqry = "SELECT 
    f.fetcherCode, 
    f.fetcherName, 
    f.regDate, 
    f.isActive, 
    COUNT(d.studentCode) AS studentCount,
    GROUP_CONCAT(d.studentCode SEPARATOR ', ') AS studentCodes, 
    GROUP_CONCAT(d.relationship SEPARATOR ', ') AS relationships
    FROM fetcherfile AS f
    JOIN details AS d ON f.fetcherCode = d.fetcherCode
    JOIN studentfile AS s ON d.studentCode = s.studentCode
    WHERE f.fetcherCode BETWEEN :fetcherFrom AND :fetcherTo
    AND f.regDate BETWEEN :dateFrom AND :dateTo
    AND (:isActive IS NULL OR f.isActive = :isActive)
    GROUP BY f.fetcherCode";


    $xstmt = $link_id->prepare($xqry);
    $xstmt->bindParam(':fetcherFrom', $fetcherFrom);
    $xstmt->bindParam(':fetcherTo', $fetcherTo);
    $xstmt->bindParam(':dateFrom', $dateFrom);
    $xstmt->bindParam(':dateTo', $dateTo);
    $xstmt->bindParam(':isActive', $isActive, PDO::PARAM_INT);

    $xstmt->execute();

    while ($xrs = $xstmt->fetch(PDO::FETCH_ASSOC)) {
        $xtop -= 15;
        $pdf->ezPlaceData($xleft1[0], $xtop, $xrs["fetcherCode"], $xfsize, 'left');
        $pdf->ezPlaceData($xleft1[1], $xtop, $xrs["fetcherName"], $xfsize, 'left');
        $pdf->ezPlaceData($xleft1[2], $xtop, $xrs["regDate"], $xfsize, 'left');
        $pdf->ezPlaceData($xleft1[3], $xtop, $xrs["studentCount"], $xfsize, 'right');
    }
}

// First Line


$pdf->ezStream();
