<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // This function fetches new data and updates the view-only table
    function updateViewOnlyTable() {
        const table = document.querySelector('table tbody'); // Use the correct selector for your view-only table
        if (!table) {
            // If the table doesn't exist, don't try to update it
            return;
        }

        fetch('http://localhost/client-log-master/public/api/viewClientLogs') // Replace with your API endpoint
            .then(response => response.json())
            .then(data => {
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

                    table.appendChild(row);
                });
            });
    }

    // Call updateViewOnlyTable every 5 seconds
    setInterval(updateViewOnlyTable, 5000);
</script>
