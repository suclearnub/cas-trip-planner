<?php
require_once('stdlib.php');
require('fpdf/fpdf.php');
securePage();
$database = databaseConnect();

class PDF extends FPDF {

  function loadData($queryResults) {
    $data = array();
    while ($row = $queryResults->fetch_assoc()) {
      $rowArray = [];
      foreach($row as $rowEntry) {
        $rowArray[] = $rowEntry;
      }
      $data[] = $rowArray;
    }
    return $data;
  }

  function drawTable($header, $data, $isActivities) {
    # Column widths
    if(!$isActivities) { $w = array(40, 40, 40, 40, 40); }
    else { $w = array(40, 40, 40, 40); }
    # Header
    for($i=0;$i<count($header);$i++)
      $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    # Data
    foreach($data as $row)
    {
      $this->Cell($w[0],6,$row[0],'LR',0);
      $this->Cell($w[1],6,$row[1],'LR',0);
      $this->Cell($w[2],6,$row[2],'LR',0);
      $this->Cell($w[3],6,$row[3],'LR',0);
      if(!$isActivities) { $this->Cell($w[4],6,$row[4],'LR',0); }
      $this->Ln();
    }
    # Closing line
    $this->Cell(array_sum($w),0,'','T');
  }

}
# Title
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','', 9);
$title = "Itinerary for: " . getTripName($_POST['tripNo'], $database);
$pdf->Cell(40,10, $title,0, 0, 'C');

$pdf->Ln(20);

# Participants
$pdf->Cell(40,10, 'Participants',0);
$pdf->Ln(20);
$pHeader = array("Name", "Confirmation", "Visa OK?", "Passport OK?", "Paid?");
$pQuery = getQuery("SELECT CONCAT(u.firstName, ' ', u.lastName) AS name, CASE WHEN confirmed = 1 THEN 'Yes' ELSE 'No' END AS confirmed, CASE WHEN passportOK = 1 THEN 'Yes' ELSE 'No' END AS passportOK, CASE WHEN visaOK = 1 THEN 'Yes' ELSE 'No' END AS visaOK, CASE WHEN paid = 1 THEN 'Yes' ELSE 'No' END AS paid FROM tripParticipants t JOIN users u ON t.userNo = u.userNo WHERE t.tripNo = $_POST[tripNo]", $database);
$pData = $pdf->loadData($pQuery);
$pdf->drawTable($pHeader,$pData, FALSE);

$pdf->Ln(20);

# Activities
$pdf->Cell(40,10,'Activities',0);
$pdf->Ln(20);
$aHeader = array("Description", "Cost", "Start Date", "End Date");
$aQuery = getQuery("SELECT description, cost, startDate, endDate FROM tripActivities WHERE tripNo = $_POST[tripNo] AND confirmed = 1", $database);
$aData = $pdf->loadData($aQuery);
$pdf->drawTable($aHeader,$aData, TRUE);
$this->Ln();
$costPerStudent = sumPricePerPerson($_POST['tripNo'], $database) * sizeof(getParticipants($_POST['tripNo'], $database)) / (sizeof(getStudentParticipants($_POST['tripNo'], $database)) - sizeof(getTeacherParticipants($_POST['tripNo'], $database)));
$pdf->Cell(40,10, 'Cost per student: ' . $costPerStudent,1);

$pdf->Output();