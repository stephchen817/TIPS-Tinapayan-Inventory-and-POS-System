<html>
<?php
    include ("dbConnection.php");
    require ('library/tcpdf-master/tcpdf.php');
    if(isset($_GET['invoiceID'])){ $invID = $_GET['invoiceID'];}

    $pdf = new TCPDF('p', 'mm', 'A4');
        class PDF extends TCPDF {
            public function Header() {
                $this->SetFont('helvetica', 'B', 20);
                $this->Cell(100, 30, 'Tinapayan Festival', 0,1);
            }
            public function Footer() {
                $this->SetFont('helvetica', 'I', 12);
                $this->Cell(100, 5, 'Generated by:TIPS(Tinapayan Inventory and POS System)', 0,1);
            }
        }
        $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        
        $pdf->SetCreator("TIPS: Tinapayan Inventory and POS System"); 
        $pdf->SetTitle("TIPS E-Receipt");
        
        $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(false);                                        
        $pdf->setPrintFooter(false);                                        
       
        $pdf->SetFont('helvetica', '', 12);                                 
        date_default_timezone_set("Asia/Manila");

        $qry = "SELECT price.prodPrice, invoice_details.invoiceID, (invoice_details.inv_qty*price.prodPrice) AS Amount, invoice_details.prodDesc, invoice_details.inv_qty FROM invoice_details INNER JOIN price ON invoice_details.prodID = price.prodID INNER JOIN invoice on invoice_details.invoiceID = invoice.invoiceID WHERE invoice.invoiceID = '$invID'";
        $result = $conn->query($qry);

        $sql = "SELECT invoice.customerName, invoice.customerAddress FROM invoice where invoice.invoiceID = '$invID'";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $custName = $row["customerName"];
        $custAdd = $row["customerAddress"];
    
        $content = '<br><p>Date: '.date('m-d-Y h:i:s A').'
                    <br>Customer Name: '.$custName.'
                    <br>Customer Address: '.$custAdd.'
                    <br><br>
                    <table border="1" cellpadding="5">
                    <tr>
                    <td align = "center"> <b>Invoice No.</b> </td>
                    <td align = "center"> <b>Product Name</b> </td>
                    <td align = "center"> <b>Quantity</b> </td>
                    <td align = "center"> <b>Price</b></td>
                    <td align = "center"> <b>Amount</b> </td></tr>';
        while ($row = $result->fetch_assoc()):
        $content .='
            <tr>
                <td align = "center">' .$row["invoiceID"].'</td>' . 
                '<td align = "center">' .$row["prodDesc"].'</td>' . 
                '<td align = "center">' .$row["inv_qty"].'</td>' . 
                '<td align = "center">' .$row["prodPrice"].'</td>'.
                '<td align = "center">' .$row["Amount"].'</td></tr>';
        endwhile;
        $content .= '</table>';
        
        $pdf->writeHTML($content);

        $txt = '';
        $pdf->writeHTML($txt, '', 0, 'C', true, 0, false, false, 0);
        //$pdf->Header();
        $pdf->Footer();
        //$pdf->AddPage();

        ob_end_clean();
        $pdf->Output();
    ?>
</html>