<html>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- For auto-suggest of products
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
    <script src="jquery-ui/jquery-ui.min.js"></script> -->
</head>

<body style="font-family: Tahoma">
    <div class="container">
        <br />
        <div align="right" style="margin-bottom:5px;">
            <button type="button" name="add" id="add" class="btn btn-success btn-xs">Add</button>
        </div>
        <br />
        <form method="post" id="user_form">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="user_data">
                    <tr>
                        <th>Invoice No.</th>
                        <th>Product Name </th>
                        <th>Quantity </th>
                        <th>Details </th>
                        <th>Remove </th>
                    </tr>
                </table>
            </div>
            <div align="center">
                <input type="submit" name="insert" id="insert" class="btn btn-primary" value="Save Invoice" />
            </div>
        </form>
        <br />
    </div>

    <div id="user_dialog" title="Add Data">
        <div class="form-group">
            <label>Enter Invoice Number</label>
            <input type="number" name="invoiceID" id="invoiceID" placeholder="Enter Invoice No." class="form-control" />
            <span id="error_invoiceID" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Enter Product Name</label>
            <input type="text" name="item_name" id="item_name" placeholder="Enter Product Name" class="form-control" />
            <span id="error_item_name" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Enter Quantity</label>
            <input type="number" name="productqty" id="productqty" placeholder="Enter Quantity" class="form-control" />
            <span id="error_productqty" class="text-danger"></span>
        </div>
        <div class="form-group" align="center">
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

                    output += '<td>' + invoiceID + ' <input type = "hidden" name = "hidden_invoiceID[]" id = "invoiceID' + count + '" class = "invoiceID" value ="' + invoiceID + '"/></td>';

                    output += '<td>' + item_name + ' <input type = "hidden" name = "hidden_item_name[]" id = "item_name' + count + '" class = "item_name" value ="' + item_name + '"/></td>';

                    output += '<td>' + productqty + ' <input type = "hidden" name = "hidden_productqty[]" id = "productqty' + count + '" class = "productqty" value ="' + productqty + '"/></td>';

                    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + count + '">View</button></td>';
                    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + count + '">Remove</button></td>';

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