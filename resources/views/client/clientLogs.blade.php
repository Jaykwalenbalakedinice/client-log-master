<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Client Logs</title>

    <style>
        .overlay {
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .alert {
            opacity: 1;
            transition: opacity 1s ease-out;
        }

        .alert.fade-out {
            opacity: 0;
        }

        .alert .icon {
            position: fixed;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            /* Adjust the size of the icon */
        }
    </style>
</head>

<body class="bg-custom" style="background-color: #BB8E89">
    <div id=successMessage class="overlay">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                <i class="fa-solid fa-circle-check pr-3"></i>
                {{ session('success') }}
            </div>
        @endif
    </div>
    <h1 class="text-center text-dark p2 text-uppercase mt-4" style="font-weight: bolder; font-family: -apple-system;">
        Client Logs</h1>

    <div class="container mt-4">
        <div class="row">

            <div class="row mb-3">
                <div class="col-6 col-md-3 col-lg-2">
                    <button class="btn btn-dark" style="padding-left: 6px; padding-right: 6px;"><a href="{{ route('client.applicationForm') }}"
                            style="text-decoration: none; color: white; font-size: 13px;">Create New
                            Application</a></button>
                </div>

                <div class="col-6 col-md-4 col-lg-4">
                    <input type="text" id="searchInput" class="form-control border-dark" style="border-radius: 0;   "
                        placeholder="Enter Virtual ID">
                </div>
            </div>

            <div class="table-responsive col-12" style="height: 400px; overflow-y: auto;">
                <table class="table table-striped table-hover table-sm table-bordered border-dark text-center">
                    <thead>
                        <tr class="table-dark table-active text-uppercase text-white">
                            <th class="col-2">Virtual ID</th>
                            <th class="col-3">First Name</th>
                            <th class="col-3">Middle Name</th>
                            <th class="col-3">Last Name</th>
                            <th class="col-2"></th>
                        </tr>
                    </thead>
                    {{-- Data in clientLogs disappear when logout button clickeds --}}
                    @foreach ($clients as $client)
                        @if (!$client->timeOut)
                            <tbody>
                                <tr>
                                    <td>{{ $client->virtualIdNumber }}</td>
                                    <td>{{ $client->firstName }}</td>
                                    <td>{{ $client->middleName }}</td>
                                    <td>{{ $client->lastName }}</td>
                                    <td>

                                        <div class="row-1">
                                            <div class="col col-1">
                                                <form method="POST"
                                                    action="{{ route('client.logout', ['client' => $client->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="submit" value="Log out"
                                                        class="btn btn-success rounded-10" autocomplete="off">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>

    </div>
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

        // Check if the success message exists
        if (document.getElementById('successMessage')) {
            // Get the success message element
            var successMessage = document.getElementById('successMessage').querySelector('.alert');

            // Wait for 3 seconds, then add fade-out class to trigger the animation
            setTimeout(function() {
                successMessage.classList.add('fade-out');

                // After the animation completes, remove the success message from the DOM
                successMessage.addEventListener('transitionend', function() {
                    successMessage.parentNode.removeChild(successMessage);
                });
            }, 2000); // 2000 milliseconds = 2 seconds
        }
    </script>
</body>

</html>
