@extends('layout.app')
@section('additionalStyle')
    <!-- Select2 CSS -->
    <link href="{{asset('css/ajax-select2-4.0.6.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <div id=submittedMessage class="overlay">
        @if (session()->has('submited'))
            <div class="alert alert-success" style="padding: 1em;" role="alert">
                <i class="fa-solid fa-circle-check pr-3"></i>
                {{ session('submited') }}
            </div>
        @endif
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col text-center mt-3">
                <img src="{{asset('images/depedimage.png')}}" alt="Deped image">
                <h4 class="text-white mb-1" style="margin-top: 10px;"><strong>HELP US SERVE YOU BETTER!</strong>
                </h4>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <form method="POST" action="{{ route('client.store') }}"
                class="card-body rounded-3 text-dark p-4 mt-3 mb-5 overflow-auto"
                style="overflow: hidden;
                background: rgba(0, 0, 0, 0.548); background-size: cover;"
                id="submittForm">
                @csrf
                @method('post')
                <div class="row">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-center">
                                <h4 class="text-black mb-1"><strong>Application Form</strong></h4>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3">
                        <label class="label" for="emailAddress"> <strong>Email Address</strong></label>
                        <input type="email" id="emailAddress" class="form-control" name="emailAddress" maxlength="254"
                            placeholder="example@gmail.com" onfocus="clearPlaceholder(this)"
                            onblur="restorePlaceholder(this)" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3">
                        <label class="label" for="region"><strong>Region</strong></label>
                        <select id="region" name="region" class="form-select region" aria-label="Default select example"
                            onchange="loadProvince(); changeColor(this);" required>
                            <option value="" disable selected>Select Region</option>
                        </select>
                    </div>
                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3 select_option">
                        <label class="label" for="province"><strong>Province</strong></label>
                        <select id="province" name="province" class="form-select province"
                            aria-label="Default select example" onchange="loadMunicipality(); changeColor(this);" required>
                            <option disable selected value="">Select Province</option>
                            <!-- Municipality options will be populated dynamically -->
                        </select>
                    </div>
                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3">
                        <label class="label" for="municipality"><strong>Municipality</strong></label>
                        <select id="municipality" name="municipality" class="form-select municipality"
                            aria-label="Default select example" onchange="loadBarangay(); changeColor(this);" required>
                            <option disabled selected value="">Select Municipality</option>
                            <!-- Municipality options will be populated dynamically -->
                        </select>
                    </div>
                    <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                        <label class="label" for="barangay"><strong>Barangay</strong></label>
                        <select id="barangay" name="barangay" class="form-select barangay"
                            aria-label="Default select example" onchange="changeColor(this);" required>
                            <option disable selected value="">Select Barangay</option>
                            <!-- Barangay options will be populated dynamically -->
                        </select>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                        <label class="label" for="clientType"> <strong>Client Type</strong> </label>
                        <select class="form-select" id="clientType" name="clientType" onchange="changeColor(this)" required>
                            <option value="" disabled selected>Select Client Type</option>
                            <option value="Citizen">Citizen</option>
                            <option value="Business">Business</option>
                            <option value="Government">Government(Employee or another agency)</option>
                        </select>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                        <label class="label" for="firstName"><strong>First Name</strong> </label>
                        <input type="text" name="firstName" id="firstName" value="" maxlength="50"
                            class="form-control" placeholder="Juan" onfocus="clearPlaceholder(this)"
                            onblur="restorePlaceholder(this)" autocomplete="off" oninput="convertToUppercase(this)" required>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3" style="font-size: ">
                        <label class="label" for="middleName"> <strong>Middle Name (If Applicable)</strong> </label>
                        <input type="text" name="middleName" id="middleName" value="" maxlength="50"
                            class="form-control" placeholder="Dela Cruz" onfocus="clearPlaceholder(this)"
                            onblur="restorePlaceholder(this)" autocomplete="off" oninput="convertToUppercase(this)">
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3">
                        <label class="label" for="lastName"> <strong>Last Name</strong> </label>
                        <input type="text" name="lastName" id="lastName" value="" maxlength="50"
                            class="form-control" placeholder="Santos" onfocus="clearPlaceholder(this)"
                            onblur="restorePlaceholder(this)" autocomplete="off" oninput="convertToUppercase(this)"
                            required>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3">
                        <label class="label" for="gender"> <strong>Gender</strong> </label>
                        <select class="form-select" id="gender" name="gender" onchange="changeColor(this)" required>
                            <option disabled selected value="">Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-3 col-md-3">
                        <label class="label" for="birthDate"> <strong>Birth Date</strong> </label>
                        <input type="date" name="birthDate" id="birthDate" value="" maxlength="50"
                            class="form-control" autocomplete="off" onchange="changeColor(this)" required>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                        <label class="label" for="contact"> <strong>Mobile Number (Optional)</strong> </label>
                        <input type="tel" id="contact" class="form-control" name="contact" value=""
                            pattern="[0]{1}[9]{1}[0-9]{9}" placeholder="Ex. 09638445701" onfocus="clearPlaceholder(this)"
                            onblur="restorePlaceholder(this)" autocomplete="off">
                    </div>


                    <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                        <label class="label" for="officeConcerned"> <strong>Office Concerned</strong> </label>
                        <select id="officeConcerned" name="officeConcerned[]" class="js-states" multiple required>
                            @foreach ($fd as $item)
                                <option value="{{ $item->division_short_name }}">{{ $item->division_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                        <label class="label" for="purposeId"> <strong>Purpose</strong> </label>
                        <select id="purpose" name="purpose[]" class="js-states" multiple required>
                            @foreach ($purpose as $item)
                                <option value="{{ $item->purpose }}">{{ $item->purpose }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col text-center mt-2">
                        <label class="label text-center" for="virtualIdNumber"> <strong>Virtual ID
                                Number</strong> </label>
                        <select class="form-control form-control-lg text-center" id="virtualIdNumber"
                            name="virtualIdNumber" onchange="changeColor(this)" required>
                            <option disabled selected value="">Please select your assigned VIRTUAL ID No</option>
                            @foreach ($virtualId as $item)
                                <option value="{{ $item->id_number }}">{{ $item->id_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="container-responsive">
                        <div class="row align-items-center">
                            <!-- Button trigger modal -->
                            <div class="col-6 col-md-8 mt-3 mt-sm-4">
                                <button id="submitBtn" type="submit" class="btn btn-active bg-dark text-white"
                                    style="font-weight: bold;" onclick="validate()">Submit</button>
                            </div>
                            <!-- Modal -->
                            @include('client.dataVerification')

                            <div class="col-6 col-md-4 mt-3 mt-sm-4">
                                <a href="{{ route('client.clientLogs') }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-primary"
                                        style="color: white; font-weight: bold;">Log Out</button>
                                </a>
                            </div>

                        </div>
                        <div class="wthree-text col">
                            <label class="anim">
                                <input id="termsAndCondition" type="checkbox" class="checkbox" required="">
                            </label>
                            <span class="privacyNotice">DATA PRIVACY NOTICE: Data and Information in this form are
                                intended exclusively for the purpose of this activity. This will be kept by the process
                                owner for the purpose of visitors record. Serving other purposes into intended by the
                                process owner is a violation of Data Privacy Act of 2012. Data subjects voluntarily
                                provided these data and information explicitly consenting the process owner to serve its
                                purpose.</span>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection
