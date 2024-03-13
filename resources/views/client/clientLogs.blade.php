<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('resources/bootstrap5.3.2/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{asset('css/client-Logs.css')}}">
    <title>Client Logs</title>

</head>

<body class="bg-dark">

    @include('client.SuccessModal')
    <div id="successMessage" class="overlay">
        @if (session()->has('success'))
            <script src="{{asset('script/jquery-3.7.1.js')}}"></script>
            <script>
                $(window).on('load', function() {
                    $('#staticBackdrop').modal('show');
                });
            </script>
        @endif
    </div>
    <h1 class="text-center text-dark p2 text-uppercase mt-5">
        Client Logs</h1>

    <div class="container mt-4">
        <div class="row">

            <div class="row mb-3">
                <div class="col-4 col-md-3 col-lg-2 col-sm-3" style="padding-right: 0px;">
                    <a href="{{ route('client.applicationForm') }}"
                        style="text-decoration: none; color: white;">
                        <button class="btn btn-dark" id="newAppBtn">New
                            Application
                        </button>
                    </a>
                </div>
                <div class="col-4 col-md-2 col-lg-1 col-sm-2" style="padding: 0px;">
                    <a id="viewBtn" class="btn btn-dark px-4"><i class="fa-solid fa-eye-slash"></i></a>
                </div>
                <div class="col-4 col-md-5 col-lg-3" style="padding: 0px;">
                    <input type="text" id="searchInput" class="form-control border-dark" style="border-radius: 0;   "
                        placeholder="Enter Virtual ID">
                </div>
            </div>

            <div class="table-responsive col-12">
                <table class="table table-striped table-sm table-dark text-center table-hover" style="opacity: 0.85;" id="clientsTable">
                    <thead>
                        <tr>
                            <th id="log" class="col-2 pt-3 col-md-2">Virtual ID</th>
                            <th id="log" class="col-3 pt-3 col-md-2">First Name</th>
                            <th id="log" class="col-3 pt-3 col-md-2">Middle Name</th>
                            <th id="log" class="col-3 pt-3 col-md-2">Last Name</th>
                            <th id="log" class="col-2 pt-3 col-md-2"></th>
                        </tr>
                    </thead>
                    {{-- Data in clientLogs disappear when logout button clickeds --}}
                    @foreach ($clients as $client)
                        @if (!$client->timeOut)
                            <tbody id="clientLogs">
                                <tr data-client-id="{{ $client->id }}">
                                    <td>{{ $client->virtualIdNumber }}</td>
                                    <td>{{ $client->firstName }}</td>
                                    <td>{{ $client->middleName }}</td>
                                    <td>{{ $client->lastName }}</td>
                                    <td>

                                        <div class="row-1">
                                            <div class="col col-1 col-md-12">
                                                <form method="post"
                                                    action="{{ route('client.logout', ['client' => $client->id]) }}">
                                                    @csrf
                                                    @method('post')
                                                    
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