<html>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
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
                        <th>Customer Name </th>
                        <th>Customer Address </th>
                        <th>Details </th>
                        <th>Remove </th>
                    </tr>
                </table>
            </div>
            <div align="center">
                <input type="submit" name="insert" id="insert" class="btn btn-primary" value="Save Customer Details" />
            </div>
        </form>
        <br />
    </div>

    <div id="user_dialog" title="Add Data">
        <div class="form-group">
            <input type="text" name="custname" id="custname" placeholder="Enter Customer Name" class="form-control" />
            <span id="error_custname" class="text-danger"></span>
        </div>
        <div class="form-group">
            <input type="address" name="custadd" id="custadd" placeholder="Enter Customer Address" class="form-control" />
            <span id="error_custadd" class="text-danger"></span>
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
            $('#custname').val('');
            $('#custadd').val('');
            $('#error_custname').text('');
            $('#error_custadd').text('');
            $('#custname').css('border-color', '');
            $('#custadd').css('border-color', '');
            $('#save').text('Save');
            $('#user_dialog').dialog('open');
        });

        $('#save').click(function() {
            var error_custname = '';
            var error_custadd = '';
            var custname = '';
            var custadd = '';

            if ($('#custname').val() == '') {
                error_custname = 'Customer Name is required';
                $('#error_custname').text(error_custname);
                $('#custname').css('border-color', '#cc0000');
                custname = '';
            } else {
                error_custname = '';
                $('#error_custname').text(error_custname);
                $('#custname').css('border-color', '');
                custname = $('#custname').val();
            }


            if ($('#custadd').val() == '') {
                error_custadd = 'Customer Address is required';
                $('#error_custadd').text(error_custadd);
                $('#custadd').css('border-color', '#cc0000');
                custadd = '';
            } else {
                error_custadd = '';
                $('#error_custadd').text(error_custadd);
                $('#custadd').css('border-color', '');
                custadd = $('#custadd').val();
            }


            if (error_custname != '' || error_custadd != '') {
                return false;
            } else {
                if ($('#save').text() == 'Save') {
                    count = count + 1;
                    output = '<tr id ="row_' + count + '">';

                    output += '<td>' + custname + ' <input type = "hidden" name = "hidden_custname[]" id = "custname' + count + '" class = "custname" value ="' + custname + '"/></td>';

                    output += '<td>' + custadd + ' <input type = "hidden" name = "hidden_custadd[]" id = "custadd' + count + '" class = "custadd" value ="' + custadd + '"/></td>';

                    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + count + '">View</button></td>';
                    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + count + '">Remove</button></td>';

                    output += '</tr>';
                    $('#user_data').append(output);
                } else {
                    var row_id = $('#hidden_row_id').val();
                    output += '<td>' + custname + ' <input type = "hidden" name = "hidden_custname[]" id = "custname' + row_id + '" class = "custname" value ="' + custname + '"/></td>';

                    output += '<td>' + custadd + ' <input type = "hidden" name = "hidden_custadd[]" id = "custadd' + row_id + '" class = "custadd" value ="' + custadd + '"/></td>';

                    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + row_id + '">View</button></td>';
                    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + row_id + '">Remove</button></td>';

                    $('#row_' + row_id + '').html(output);
                }
                $('#user_dialog').dialog('close');
            }
        });

        $(document).on('click', '.view_details', function() {
            var row_id = $(this).attr("id");
            var custname = $('#custname' + row_id + '').val();
            var custadd = $('#custadd' + row_id + '').val();

            $('#custname').val(custname);
            $('#custadd').val(custadd);
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
            $('.custname').each(function() {
                count_data = count_data + 1;
            });
            if (count_data > 0) {
                var form_data = $(this).serialize();
                $.ajax({
                    url: "customer.php",
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