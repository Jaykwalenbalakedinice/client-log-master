<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://kit.fontawesome.com/bd99322ebc.js" crossorigin="anonymous"></script>

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

<script>
    let previousData = [];
    // This function fetches new data and updates the table
    function updateTable() {
        const table = document.querySelector('#clientLogs');

        if (!table) {
            // Create table and tbody elements
            const tableElement = document.createElement('table');
            const tbodyElement = document.createElement('tbody');

            // Append tbody to table
            tableElement.appendChild(tbodyElement);

            // Append table to document body or specific container
            document.body.appendChild(tableElement);

            // Reassign table to the newly created tbody
            table = tbodyElement;
        }

        fetch('http://localhost/client-log-master/public/api/clientLogs', {
                cache: 'no-store'
            })
            .then(response => response.json())
            .then(data => {
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
                            row.appendChild(cell);
                        });

                        // Add the logout button
                        const logoutCell = document.createElement('td');
                        const logoutButton = document.createElement('input');
                        logoutButton.type = 'submit';
                        logoutButton.value = 'Log out';
                        logoutButton.className = 'btn btn-success rounded-10';
                        logoutButton.addEventListener('click', () => {
                            // Add your logout logic here
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
            });
    }

    // Call updateTable every 5 seconds
    setInterval(updateTable, 5000);
</script>

<script>
    fetch('/clientLogs/logout/' + client.id, { // Replace with your API endpoint
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            // Include CSRF token in header for Laravel
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
</script>

<script>
    $('#viewBtn').click(function() {
        $('#newAppBtn, #searchInput, #viewBtn, #logoutBtn').toggle();
    });
</script>
