<?php
require_once('stdlib.php');
require('fpdf/fpdf.php');
securePage();
$database = databaseConnect();

class PDF extends FPDF {

  function loadData($queryResults) {
    $data = array();
    while ($row = $queryResults->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
  }

  function drawTable($header, $data) {
    // Column widths
    $w = array(40, 35, 40, 45);
    // Header
    for($i=0;$i<count($header);$i++)
      $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
      $this->Cell($w[0],6,$row[0],'LR');
      $this->Cell($w[1],6,$row[1],'LR');
      $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
      $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
      $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
  }

}
# Title
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times New Roman','', 16);
$title = "Itinerary for: " . getTripName($_POST['id'], $database);
$pdf->Cell(40,10, $title,1, 0, 'C');

$pdf->Ln(20);

# Participants
$pdf->Cell(40,10, 'Participants',1);
$pHeader = array("Name", "Confirmation", "Visa OK?", "Passport OK", "Paid?");
$pQuery = getQuery("SELECT CONCAT(u.firstName, ' ', u.lastName) AS name, CASE WHEN confirmed = 1 THEN 'Yes' ELSE 'No' END AS confirmed, CASE WHEN passportOK = 1 THEN 'Yes' ELSE 'No' END AS passportOK, CASE WHEN visaOK = 1 THEN 'Yes' ELSE 'No' END AS visaOK, CASE WHEN paid = 1 THEN 'Yes' ELSE 'No' END AS paid FROM tripParticipants t JOIN users u ON t.userNo = u.userNo WHERE t.tripNo = $_POST[id]", $database);
$pData = $pdf->loadData($pQuery);
$pdf->drawTable($pHeader,$pData);

$pdf->Ln(20);

# Activities
$pdf->Cell(40,10,'Activities',1);
$aHeader = array("Description", "Cost", "Start Date", "End Date", "Confirmation");
$aQuery = getQuery("SELECT description, cost, startDate, endDate, confirmed FROM tripActivities WHERE tripNo = $_POST[id]", $database);
$aData = $pdf->loadData($aQuery);
$pdf->drawTable($aHeader,$aData);
$costPerStudent = sumPricePerPerson($_POST['id'], $database) * sizeof(getParticipants($_POST['id'], $database)) / sizeof(getTeacherParticipants($_POST['id'], $database));
$pdf->Cell(40,10, 'Cost per student: ' . $costPerStudent,1);

$pdf->Output();