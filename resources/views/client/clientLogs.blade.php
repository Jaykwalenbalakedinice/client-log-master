<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('resources/bootstrap5.3.2/bootstrap.min.css') }}" rel="stylesheet">
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

    @include('client.SuccessModal')
    <div id="successMessage" class="overlay">
        @if (session()->has('success'))
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script>
                $(window).on('load', function() {
                    $('#staticBackdrop').modal('show');
                });
            </script>
        @endif
    </div>
    <h1 class="text-center text-dark p2 text-uppercase mt-4" style="font-weight: bolder; font-family: -apple-system;">
        Client Logs</h1>

    <div class="container mt-4">
        <div class="row">

            <div class="row mb-3">
                <div class="col-6 col-md-3 col-lg-2">
                    <a href="{{ route('client.applicationForm') }}"
                        style="text-decoration: none; color: white; font-size: 13px;">
                        <button class="btn btn-dark"><strong>New
                            Application</strong> 
                        </button>
                    </a>
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
    @include('layout.clientLogsScript')
</body>

</html>
