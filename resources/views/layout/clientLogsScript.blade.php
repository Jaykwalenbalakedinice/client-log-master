<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
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