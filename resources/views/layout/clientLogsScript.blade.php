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
                        const logoutBtn = document.querySelector('#logoutBtn');
                        logoutButton.type = 'submit';
                        logoutButton.value = 'Log out';
                        logoutButton.className = 'rounded-10';
                        logoutButton.addEventListener('click', () => {
                            // Add your logout logic here
                            const virtualIdNumber = row.querySelector('td:first-child').textContent;
                            console.log(virtualIdNumber);


                            fetch(`/clientLogs/logout/${virtualIdNumber}`, {
                                    method: 'PUT',
                                    action: 'client.logout',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        // Include CSRF token for Laravel
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    },
                                    body: JSON.stringify({
                                        virtualIdNumber
                                    })
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    // Handle response data
                                    console.log(data);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
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
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Call updateTable every 5 seconds
    setInterval(updateTable, 3000);
</script>

<script>
    $('#viewBtn').click(function() {
        $('#newAppBtn, #searchInput, #viewBtn, #logoutBtn').toggle();
    });
</script>
