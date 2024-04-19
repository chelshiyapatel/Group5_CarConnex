<?php
session_start();
require_once 'config.php'; 
require_once 'fpdf184/fpdf.php'; 

function generatePDF($name, $address, $phoneNumber) {
  
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 10, 'Order Confirmation', 0, 1, 'C');
    $pdf->Ln(10); 

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Name: $name", 0, 1);
    $pdf->Cell(0, 10, "Address: $address", 0, 1);
    $pdf->Cell(0, 10, "Phone Number: $phoneNumber", 0, 1);

    $pdf->Ln(10);
    $pdf->MultiCell(0, 10, "Your order has been successfully placed. Thank you for shopping with us!");

    $pdf->Output('order_confirmation.pdf', 'D');
}

if (
    isset($_POST['name']) &&
    isset($_POST['address']) &&
    isset($_POST['phone'])
) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone'];

    generatePDF($name, $address, $phoneNumber);

    header('Location: products.php');
    exit;
} else {
    echo "Error: Form fields are not set.";
}
?>
