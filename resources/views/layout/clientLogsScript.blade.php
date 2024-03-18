<script src="{{ asset('script/bootstrap.js') }}"></script>

<script src="{{ asset('script/ajaxjquery-3.5.1.js') }}"></script>

<script src="{{ asset('script/fontawesome.js') }}" crossorigin="anonymous"></script>

<script>
    // Js function for search bar
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keyup', function() {
            var searchTerm = this.value.toLowerCase();
            var tableRows = document.querySelectorAll('table tbody tr');

            tableRows.forEach(function(row) {
                var virtualIdCell = row.cells[0].textContent.toLowerCase();
                if (virtualIdCell.indexOf(searchTerm) === -1) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        });
    });
</script>

<script type="module">
    let previousData = [];

function updateTable() {
    let table = document.querySelector('#clientLogs');

    if (!table) {
        // Create table and tbody elements
        const tableElement = document.querySelector('.table-striped');
        const tbodyElement = document.createElement('tbody');
        // Append tbody to table
        tbodyElement.id = 'clientLogs';
        // Append table to document body or specific container
        tableElement.appendChild(tbodyElement);
        // Reassign table to the newly created tbody
        table = tbodyElement;
    }

    $.ajax({
        url: '/client-log-master/public/api/clientLogs',
        cache: false,
        dataType: 'json',
        success: function(data) {
            // Check if data has changed
            if (JSON.stringify(data) !== JSON.stringify(previousData)) {
                // Clear the table
                table.innerHTML = '';
                // Add new rows to the table
                data.forEach(client => {
                    const row = document.createElement('tr');
                    ['virtualIdNumber', 'firstName', 'middleName', 'lastName'].forEach(key => {
                        const cell = document.createElement('td');
                        cell.textContent = client[key];
                        row.setAttribute("id", "row" + client.id)
                        row.appendChild(cell);
                    });
                    // Add the logout button
                    const logoutCell = document.createElement('td');
                    const logoutButton = document.createElement('input');
                    logoutButton.type = 'submit';
                    logoutButton.value = 'Log out';
                    logoutButton.className = 'btn btn-success logoutBtn';
                    logoutButton.addEventListener('click', () => {
                        // Add your logout logic 
                        // alert('route("client.logs.out", ["id" => '+client.id +']');
                        $.ajax({
                            url: "{{ route('client.logs.out') }}", // Assuming 'id' is the identifier for the client
                            type: 'post',
                            data: {
                                id: client.id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                console.log(response);
                                $('#clickMe').attr('href', `http://20.20.23.71:8000/feedback-client/public/feedback?logsNumber=${response}`)
                                $('#row'+client.id).hide();
                                $('#SuccessModal').modal('show');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                               console.log('asdfa');
                            }
                        });
                    });
                    logoutCell.appendChild(logoutButton);
                    row.appendChild(logoutCell);

                    // Hide the logout button if view-only mode is active
                    if ($('#viewBtn').is(':hidden')) {
                        $(logoutButton).hide();
                    }
                    table.appendChild(row);
                });
                // Update previousData
                previousData = data;
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
        }
    });
}

setInterval(updateTable, 3000);
updateTable();

</script>

<script>
    $('#viewBtn').click(function() {
        $('.newAppBtn, .searchInput, .logoutBtn, .viewBtnclass').toggle();
    });
</script>
