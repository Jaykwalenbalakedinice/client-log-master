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

<script>
    let previousData = [];
    // This function fetches new data and updates the table
    function updateTable() {
        let table = document.querySelector('#clientLogs');
        let tbody;

        if (!table) {
            // Create table and tbody elements
            table = document.createElement('table');
            tbody = document.createElement('tbody');

            // Append tbody to table
            table.appendChild(tbody);

            // Append table to document body or specific container
            document.body.appendChild(table);

        } else {
            // If table already exists, select the tbody
            tbody = table.querySelector('tbody');
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
                            fetch('/clientLogs/logout' + client
                                    .id, { // Replace with your API endpoint
                                        method: 'PUT',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            // Include CSRF token in header for Laravel
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content')
                                        },
                                        body: JSON.stringify({
                                            virtualIdNumber: client.virtualIdNumber
                                        })
                                    })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    // Handle the response data
                                })
                                .catch(error => {
                                    console.error(
                                        'There has been a problem with your fetch operation:',
                                        error);
                                });
                        });
                        logoutCell.appendChild(logoutButton);
                        row.appendChild(logoutCell);

                        // Hide the logout button if view-only mode is active
                        if ($('#viewBtn').is(':hidden')) {
                            $(logoutButton).hide();
                        }

                        tbody.appendChild(row);
                    });

                    // Update previousData
                    previousData = data;
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Call updateTable every 5 seconds
    setInterval(updateTable, 5000);
</script>


<script>
    $('#viewBtn').click(function() {
        $('#newAppBtn, #searchInput, #viewBtn, #logoutBtn').toggle();
    });
</script>
