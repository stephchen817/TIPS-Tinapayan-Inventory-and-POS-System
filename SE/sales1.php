<?php include "dbConnection.php";
$qry = "SELECT price.prodPrice, invoice_details.invoiceID, invoice_details.prodDesc, invoice_details.inv_qty FROM invoice_details INNER JOIN price ON invoice_details.prodID = price.prodID";
$result = $conn->query($qry);

if (!isset($_SESSION)) {
    session_start();
}
?>
<html>

<head>
    <title>sales</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="styles/display.js" charset="utf-8"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--For update, delete icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!--For font styles-->
    <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles/design.css">

</head>

<body id='reppage'>
    <div class='container-fluid' id="header1">
        <p id='head'>TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
    </div>
    <div class='container-w-75'>
        <main>
            <section class='sec-1' id='panel'>
                <div class='container-xl'>
                    <img src="images/user.png" id='pic'>
                    <center>
                        <h2 style="font-size:24px; font-family:Baloo Tamma;"class='loggedIn' id='username'><?php echo $_SESSION["loginUser"]; ?></h3>
                    </center>
                    <button type="button" name="add" id="add" class="btn btn-block btn-success btn-xs">Add Invoice</button>
                        <button onclick="window.location.href='encoderMenu.php'" id='return' type="button" class="btn-block btn-info btn-secondary">
                            Return
                        </button>
                </div>
            </section>
            <section class='sec-2' id='table'>
                <form method="post" id="user_form">
                    <div class="table-responsive">
                            <table id='user_data' class="table table-hover table-striped">
                                <tr style="border-bottom: none !important; border-top: none !important">
                                    <th class='h2' style="font-size:20;text-align:center;">Invoice Number </th>
                                    <th class='h2' style="font-size:20;text-align:center;">Product Description </th>
                                    <th class='h2' style="font-size:20;text-align:center;">Invoice Quantity </th>
                                    <th class='h2' style="font-size:20;text-align:center;">Details </th>
                                    <th class='h2' style="font-size:20;text-align:center;">Remove </th>
                                </tr>
                            </table>
                    </div>
                    <div align="center">
                        <input style="font-size:20px;padding-left:20px;padding-right:20px;margin-top: 10rem;margin-right:2rem;"type="submit" name="insert" id="insert" class="btn btn-primary" value ="Save ">
                    </div>
                </form>
                <br />
            </section>
    </div>
    <div id="user_dialog" title="Add Data">
        <div class="form-group">
            <input type="number" name="invoiceID" id="invoiceID" placeholder="Enter Invoice No." class="form-control" />
            <span id="error_invoiceID" class="text-danger"></span>
        </div>
        <div class="form-group">
            <input type="text" name="item_name" id="item_name" onchange='price(this)' placeholder="Enter Product Name" class="form-control" />
            <span id="error_item_name" class="text-danger"></span>
        </div>
        <div class="form-group">
            <input type="number" name="productqty" id="productqty" placeholder="Enter Quantity" class="form-control" />
            <span id="error_productqty" class="text-danger"></span>
        </div>
        <div class="form-group" align="right">
            <input type="hidden" name="row_id" id="hidden_row_id" />
            <button type="button" name="save" id="save" class="btn btn-info">Save</button>
        </div>
    </div>

    <div id="action_alert" title="Action">

    </div>

</body>

</html>
<script>
    $(document).ready(function() {

        var count = 0;

        $('#user_dialog').dialog({
            autoOpen: false,
            width: 400
        });

        $('#add').click(function() {
            $('#user_dialog').dialog('option', 'title', 'Add Data');
            $('#invoiceID').val('');
            $('#item_name').val('');
            $('#productqty').val('');
            $('#error_invoiceID').text('');
            $('#error_item_name').text('');
            $('#error_productqty').text('');
            $('#invoiceID').css('border-color', '');
            $('#item_name').css('border-color', '');
            $('#productqty').css('border-color', '');
            $('#save').text('Save');
            $('#user_dialog').dialog('open');
        });

        $('#save').click(function() {
            var error_invoiceID = '';
            var error_item_name = '';
            var error_productqty = '';
            var invoiceID = '';
            var item_name = '';
            var productqty = '';

            if ($('#invoiceID').val() == '') {
                error_invoiceID = 'Invoice ID is required';
                $('#error_invoiceID').text(error_invoiceID);
                $('#invoiceID').css('border-color', '#cc0000');
                invoiceID = '';
            } else {
                error_invoiceID = '';
                $('#error_invoiceID').text(error_invoiceID);
                $('#invoiceID').css('border-color', '');
                invoiceID = $('#invoiceID').val();
            }


            if ($('#item_name').val() == '') {
                error_item_name = 'Product Name is required';
                $('#error_item_name').text(error_item_name);
                $('#item_name').css('border-color', '#cc0000');
                item_name = '';
            } else {
                error_item_name = '';
                $('#error_item_name').text(error_item_name);
                $('#item_name').css('border-color', '');
                item_name = $('#item_name').val();
            }


            if ($('#productqty').val() == '') {
                error_productqty = 'Product Quantity is required';
                $('#error_productqty').text(error_productqty);
                $('#productqty').css('border-color', '#cc0000');
                productqty = '';
            } else {
                error_productqty = '';
                $('#error_productqty').text(error_productqty);
                $('#productqty').css('border-color', '');
                productqty = $('#productqty').val();
            }


            if (error_invoiceID != '' || error_item_name != '' || error_productqty != '') {
                return false;
            } else {
                if ($('#save').text() == 'Save') {
                    count = count + 1;
                    output = '<tr id ="row_' + count + '">';

                    output += '<td align="center" class="contents">' + invoiceID + ' <input type = "hidden" name = "hidden_invoiceID[]" id = "invoiceID' + count + '" class = "invoiceID" value ="' + invoiceID + '"/></td>';

                    output += '<td align="center" class="contents">' + item_name + ' <input type = "hidden" name = "hidden_item_name[]" id = "item_name' + count + '" class = "item_name" value ="' + item_name + '"/></td>';

                    output += '<td align="center" class="contents">' + productqty + ' <input type = "hidden" name = "hidden_productqty[]" id = "productqty' + count + '" class = "productqty" value ="' + productqty + '"/></td>'
                    <?php #$abc = "SELECT `prodPrice` FROM price WHERE `prodID` IN (SELECT `prodID` FROM products WHERE `prodDesc` = :item_name)";
                    #$result2 = $conn->prepare($abc);
                    #$result2->bindParam(':item_name', $prodDesc, PDO::PARAM_STR);
                    #$result2->execute();
                    ?>

                    <?php #while ($row = $result2->fetch_assoc()) :
                    #$id = $row['prodID'];
                    ?>
                    //  output += '<td>' + <?php #echo $row['prodPrice']; 
                                            ?> + '</td>';

                    <?php #endwhile; 
                    ?>

                    output += '<td align ="center"><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + count + '">View</button></td>';
                    output += '<td align="center"><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + count + '">Remove</button></td>';

                    output += '</tr>';
                    $('#user_data').append(output);
                } else {
                    var row_id = $('#hidden_row_id').val();

                    output = '<td>' + invoiceID + ' <input type = "hidden" name = "hidden_invoiceID[]" id = "invoiceID' + row_id + '" class = "invoiceID" value ="' + invoiceID + '"/></td>';

                    output += '<td>' + item_name + ' <input type = "hidden" name = "hidden_item_name[]" id = "item_name' + row_id + '" class = "item_name" value ="' + item_name + '"/></td>';

                    output += '<td>' + productqty + ' <input type = "hidden" name = "hidden_productqty[]" id = "productqty' + row_id + '" class = "productqty" value ="' + productqty + '"/></td>';

                    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + row_id + '">View</button></td>';
                    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + row_id + '">Remove</button></td>';

                    $('#row_' + row_id + '').html(output);
                }
                $('#user_dialog').dialog('close');
            }
        });

        function price(e) {
            $(e).closest("tr").find("#item_name").keyup(function() {
                a = e.value;
                $.ajax({
                    type: "POST",
                    url: "showPrice.php",
                    data: {
                        'a': a
                    },
                    success: function(data) {
                        $(e).closest("tr").find("#price").val(data);
                    }
                });
            });
        }
        $(document).on('click', '.view_details', function() {
            var row_id = $(this).attr("id");
            var invoiceID = $('#invoiceID' + row_id + '').val();
            var item_name = $('#item_name' + row_id + '').val();
            var productqty = $('#productqty' + row_id + '').val();

            $('#invoiceID').val(invoiceID);
            $('#item_name').val(item_name);
            $('#productqty').val(productqty);
            $('#save').text('Edit');
            $('#hidden_row_id').val(row_id);
            $('#user_dialog').dialog('option', 'title', 'Edit Data');
            $('#user_dialog').dialog('open');
        });

        $(document).on('click', '.remove_details', function() {
            var row_id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this data?")) {
                $('#row_' + row_id + '').remove();
            } else {
                return false;
            }
        });

        $('#action_alert').dialog({
            autoOpen: false
        });

        $('#user_form').on('submit', function(event) {
            event.preventDefault();
            var count_data = 0;
            $('.invoiceID').each(function() {
                count_data = count_data + 1;
            });
            if (count_data > 0) {
                var form_data = $(this).serialize();
                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        $('#user_data').find("tr:gt(0)").remove();
                        $('#action_alert').html('<p> Data has been inserted successfully!')
                        $('#action_alert').dialog('open');
                    }
                })

            } else {
                $('#action_alert').html('<p> Please add at least one data! </p>');
                $('#action_alert').dialog('open');
            }
        });

    });
</script>