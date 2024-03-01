@extends('layout.app')
@section('additionalStyle')
<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    body,
    html {
        margin: 0;
        padding: 0;
    }

    body {
        background-image: linear-gradient(#8a0000, #0c2cba);
        background-size: cover;
        background-attachment: fixed;
        /* or scroll, depending on desired effect */
        height: 100vh;
        margin: 0;
        /* In case there's default margin causing issues */
    }

    .form-control,
    .form-select {
        background-color: #ffffff;
        border-color:
    }

    strong {
        margin-left: 10px;
    }

    @media (max-width: 1024px) and (max-height: 1280px) {
        body {
            justify-content: center;
            align-items: center;
        }
    }


    .alert p {
        font-size: 18px;
        font-style: italic;
        color: #fff;
        padding-top: 10px;
        color: black;
        margin-left: 20px;
    }

    .alert a {
        font-weight: bold;
        text-decoration: none;
        color: skyblue;
    }

    .alert a:hover {
        font-weight: bold;
        text-decoration: underline;
        color: #380036;
    }

    .button-container {
        margin: 15px 0;
    }

    .btn {
        width: 100%;
        margin-right: 10px;
        display: block;
        font-size: 20px;
        color: #fff;
        border: none;
        border-radius: 5px;
        background-image: linear-gradient(to right, #aa076b, #61045f);
        cursor: pointer;
    }

    .btn:hover {
        background-image: linear-gradient(to right, #61045f, #aa076b);
    }

    .is-invalid2 {
        border-color: #dc3545;
    }

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
@endsection
@section('content')
<div id=submitedMessage class="overlay">
    @if (session()->has('submited'))
        <div class="alert alert-success" role="alert">
            <i class="fa-solid fa-circle-check pr-3"></i>
            {{ session('submited') }}
        </div>
    @endif
</div>
<div>
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif
</div>

@include('client.privacyModal')

<div class="container-fluid">
    <div class="row">
        <div class="col text-center">
            <img src="https://depedcalabarzon.ph/wp-content/uploads/2023/09/website-banner-4.png"
                style="width: 60%; height: 100px">
            <h4 class="text-white mb-1" style="margin-top: 10px;"><strong>HELP US SERVE YOU BETTER!</strong>
            </h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <form method="POST" action="{{ route('client.store') }}" class="card-body rounded-3 text-dark p-4 mt-3 mb-5 overflow-auto" style="border-radius: 10px;
                overflow: hidden;
                background: rgba(247, 247, 247, 0.719);
                box-shadow: 0 15px 20px rgba(0, 0, 0, 0.6);"
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


                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="emailAddress"> <strong>Active Email Address</strong></label>
                    <input type="email" id="emailAddress" class="form-control" name="emailAddress" maxlength="254"
                        placeholder="example@gmail.com" onfocus="clearPlaceholder(this)"
                        onblur="restorePlaceholder(this)" required autocomplete="on">
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="region"><strong>Region</strong></label>
                    <select id="region" name="region" class="form-select region"
                        aria-label="Default select example" onchange="loadProvince()">
                        {{-- <option selected value="">Select Region</option> --}}
                    </select>
                </div>
                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4 select_option">
                    <label class="label" for="province"><strong>Province</strong></label>
                    <select id="province" name="province" class="form-select province"
                        aria-label="Default select example" onchange="loadMunicipality()">
                        <option selected value="">Select Province</option>
                        <!-- Municipality options will be populated dynamically -->
                    </select>
                </div>
                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="municipality"><strong>Municipality</strong></label>
                    <select id="municipality" name="municipality" class="form-select municipality"
                        aria-label="Default select example" onchange="loadBarangay()">
                        <option selected value="">Select Municipality</option>
                        <!-- Municipality options will be populated dynamically -->
                    </select>
                </div>
                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="barangay"><strong>Barangay</strong></label>
                    <select id="barangay" name="barangay" class="form-select barangay"
                        aria-label="Default select example">
                        <option selected value="">Select Barangay</option>
                        <!-- Barangay options will be populated dynamically -->
                    </select>
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="clientType"> <strong>Client Type</strong> </label>
                    <select class="form-control" id="clientType" name="clientType">
                        <option value="Citizen">Citizen</option>
                        <option value="Business">Business</option>
                        <option value="Government">Government(Employee or another agency)</option>
                    </select>
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="firstName"><strong>First Name</strong> </label>
                    <input type="text" name="firstName" id="firstName" value="" maxlength="50"
                        class="form-control" placeholder="Juan" onfocus="clearPlaceholder(this)"
                        onblur="restorePlaceholder(this)" autocomplete="on" required>
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="middleName"> <strong>Middle Name</strong> </label>
                    <input type="text" name="middleName" id="middleName" value="" maxlength="50"
                        class="form-control" placeholder="Dela Cruz (If Applicable)"
                        onfocus="clearPlaceholder(this)" onblur="restorePlaceholder(this)" autocomplete="on">
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="lastName"> <strong>Last Name</strong> </label>
                    <input type="text" name="lastName" id="lastName" value="" maxlength="50"
                        class="form-control" placeholder="Santos" onfocus="clearPlaceholder(this)"
                        onblur="restorePlaceholder(this)" autocomplete="on" required>
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="gender"> <strong>Gender</strong> </label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="birthDate"> <strong>Birth Date</strong> </label>
                    <input type="date" name="birthDate" id="birthDate" value="" maxlength="50"
                        class="form-control" autocomplete="on" required>
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="contact"> <strong>Mobile Number</strong> </label>
                    <input type="tel" id="contact" class="form-control" name="contact" value=""
                        pattern="[0]{1}[9]{1}[0-9]{9}" placeholder="Ex. 09638445701 (Optional)"
                        onfocus="clearPlaceholder(this)" onblur="restorePlaceholder(this)" autocomplete="on">
                </div>


                <div class="form-group mt-3 col-sm-12 col-lg-4 col-md-4">
                    <label class="label" for="officeConcerned"> <strong>Office Concerned</strong> </label>
                    <select id="officeConcerned" name="officeConcerned[]" class="js-states w-100" multiple>
                        @foreach ($fd as $item)
                            <option value="{{ $item->division_short_name }}">{{ $item->division_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3 col-sm-12 col-lg-8 col-md-8">
                    <label class="label" for="purposeId"> <strong>Purpose</strong> </label>
                    <select id="purpose" name="purpose[]" class="js-states w-100" multiple>
                        @foreach ($purpose as $item)
                            <option value="{{$item->purpose}}">{{$item->purpose}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col text-center mt-2">
                    <label class="label text-center text-danger" for="virtualIdNumber"> <strong>Virtual ID Number</strong> </label>
                    <select class="form-control form-control-lg text-center" id="virtualIdNumber" name="virtualIdNumber">
                        <option value="">Please select your assigned VIRTUAL ID No</option>
                        @foreach ($virtualId as $item)
                            <option value="{{ $item->id_number }}">{{ $item->id_number }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Modal --}}
                @include('client.modal')


                <div class="container-responsive">
                    <div class="row align-items-center">

                        <div class="col-6 col-md-8 mt-3 mt-sm-4">
                            <button type="button" class="btn btn-active bg-dark text-white"
                                style="font-weight: bold;" data-bs-toggle="modal" data-bs-target="staticBackdrop"
                                onclick="validate()">Submit</button>
                        </div>

                        <div class="col-6 col-md-4 mt-3 mt-sm-4">
                            <a href="{{ route('client.clientLogs') }}" style="text-decoration: none;">
                                <button type="button" class="btn btn-primary"
                                    style="color: white; font-weight: bold;">Log Out</button>
                            </a>
                        </div>

                    </div>
                </div>
        </form>
    </div>

</div>
</div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $("#purpose").select2({
          placeholder: "  Select your purpose",
          allowClear: true
      });
      $("#officeConcerned").select2({
          placeholder: "  Select Divison / Office / Unit",
          allowClear: true
      });

      function validate(){
        const question = "Are you sure that the information you want to submit is true?" + "\n\n" +
                            "By clicking submit, your are allowing us to store your information to our database."
        
        if(confirm(question) == true){
            document.getElementById("submittForm").submit();
        }
      }
    </script>

<script>
    // Prevents multiple form submission.
    document.querySelector('form').addEventListener('submit', function() {
        this.querySelector("button[type='submit']").disabled = true;
    });

    // function clearPlaceholder(input) {
    //     input.setAttribute('data-original-placeholder', input.placeholder);
    //     input.placeholder = '';
    // }

    // function restorePlaceholder(input) {
    //     if (!input.value.trim()) { // Check if the input field is empty
    //         input.placeholder = input.getAttribute('data-original-placeholder'); // Restore the placeholder text
    //     }
    // }

    // document.addEventListener("DOMContentLoaded", function() {
    //     var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
    //         backdrop: 'static',
    //         keyboard: false
    //     });
    //     myModal.show();

    //     document.getElementById('agreeButton').addEventListener('click', function() {
    //         // Add your logic for what happens when the user agrees
    //         // For example, you might close the modal or redirect to another page
    //         myModal.hide();
    //     });
    // });

    // document.getElementById('submitNga').addEventListener('click', function(event) {
    //     // Get form inputs
    //     var emailAddress = document.getElementById('emailAddress').value;
    //     var region = document.getElementById('region').value;
    //     var province = document.getElementById('province').value;
    //     var municipality = document.getElementById('municipality').value;
    //     var barangay = document.getElementById('barangay').value;
    //     var clientType = document.getElementById('clientType').value;
    //     var firstName = document.getElementById('firstName').value;
    //     var middleName = document.getElementById('middleName').value;
    //     var lastName = document.getElementById('lastName').value;
    //     var gender = document.getElementById('gender').value;
    //     var birthDate = document.getElementById('birthDate').value;
    //     var contact = document.getElementById('contact').value;
    //     var divisionOfResidence = document.getElementById('divisionOfResidence').value;
    //     var officeConcerned = document.getElementById('officeConcerned').value;
    //     var purposeId = document.getElementById('purposeId').value;
    //     var virtualIdNumber = document.getElementById('virtualIdNumber').value;

    //     event.preventDefault(); // This line ensures the form submission is halted

    //     // Check if any required field is empty
    //     if (!emailAddress || !region || !province || !municipality || !barangay || !clientType || !firstName ||
    //         !lastName || !gender || !birthDate || !divisionOfResidence || !officeConcerned || !purposeId || !virtualIdNumber) {
    //         // Display an alert to the user indicating that all required fields must be filled
    //         alert('Please fill all required fields.');
    //         // Prevent the default action of the submit button
    //     } else {
    //         // Populate preview data and open the modal
    //         document.getElementById('previewEmailAddress').innerText = emailAddress;
    //         document.getElementById('previewRegion').innerText = region;
    //         document.getElementById('previewProvince').innerText = province;
    //         document.getElementById('previewMunicipality').innerText = municipality;
    //         document.getElementById('previewBarangay').innerText = barangay;
    //         document.getElementById('previewClientType').innerText = clientType;
    //         document.getElementById('previewFirstName').innerText = firstName;
    //         document.getElementById('previewMiddleName').innerText = middleName;
    //         document.getElementById('previewLastName').innerText = lastName;
    //         document.getElementById('previewGender').innerText = gender;
    //         document.getElementById('previewBirthDate').innerText = birthDate;
    //         document.getElementById('previewContact').innerText = contact;
    //         document.getElementById('previewDivisionOfResidence').innerText = divisionOfResidence;
    //         document.getElementById('previewOfficeConcerned').innerText = officeConcerned;
    //         document.getElementById('previewPurposeId').innerText = purposeId;
    //         document.getElementById('previewVirtualIdNumber').innerText = virtualIdNumber;

    //         // Open the modal
    //         var staticBackdrop = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
    //             backdrop: 'static',
    //             keyboard: false
    //         });
    //         staticBackdrop.show();
    //     }
    // });

    // Check if the submited message exists
    if (document.getElementById('submitedMessage')) {
        var submitedMessage = document.getElementById('submitedMessage').querySelector('.alert');

        if (submitedMessage) {
            setTimeout(function() {
                submitedMessage.classList.add('fade-out');

                submitedMessage.addEventListener('transitionend', function() {
                    submitedMessage.parentNode.removeChild(submitedMessage);
                });
            }, 4000);
        }
    }

    // Script for API

    var config = {
        cUrl: 'https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json'
    }

    var apiEndPoint =
        'https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json';

    var regionSelect = document.querySelector('#region');
    provinceSelect = document.querySelector('#province'),
        citySelect = document.querySelector('#city'),
        municipalitySelect = document.querySelector('#municipality'),
        barangaySelect = document.querySelector('#barangay')

    function loadRegions() {
        let apiEndPoint = config.cUrl;

        fetch(apiEndPoint)
            .then(Response => Response.json())
            .then(data => {
                regionSelect.innerHTML = '<option value="">Select Region</option>';

                // Iterate over the regions in the data
                for (let regionCode in data) {
                    const region = data[regionCode];
                    const option = document.createElement('option');
                    option.value = regionCode;
                    option.textContent = region.region_name;
                    regionSelect.appendChild(option);
                }

                regionSelect.disabled = false;
            })
            .catch(error => console.error('Error loading regions:', error));
    }


    function loadProvince() {
        // Get the selected region code
        const selectedRegionCode = regionSelect.value;

        fetch(apiEndPoint)
            .then(response => response.json())
            .then(data => {
                const selectedRegion = data[selectedRegionCode];

                if (selectedRegion && selectedRegion.province_list) {
                    provinceSelect.innerHTML =
                        '<option value="">Select Province</option>'; // Clear existing province options

                    // Iterate over the provinces in the selected region
                    for (let provinceName in selectedRegion.province_list) {
                        const option = document.createElement('option');
                        option.value = provinceName;
                        option.textContent = provinceName;
                        provinceSelect.appendChild(option);
                    }

                    provinceSelect.disabled = false;
                } else {
                    console.error('Invalid response format:', data);
                }
            })
            .catch(error => console.error('Error loading provinces:', error));
    }

    function loadMunicipality() {
        // Get the selected region and province codes
        const selectedRegionCode = regionSelect.value;
        const selectedProvinceName = provinceSelect.value;

        fetch(apiEndPoint)
            .then(response => response.json())
            .then(data => {
                const selectedRegion = data[selectedRegionCode];
                const selectedProvince = selectedRegion.province_list[selectedProvinceName];

                if (selectedProvince && selectedProvince.municipality_list) {
                    municipalitySelect.innerHTML =
                        '<option value="">Select Municipality</option>'; // Clear existing municipality options

                    // Iterate over the municipalities in the selected province
                    for (let municipalityName in selectedProvince.municipality_list) {
                        const option = document.createElement('option');
                        option.value = municipalityName;
                        option.textContent = municipalityName;
                        municipalitySelect.appendChild(option);
                    }

                    municipalitySelect.disabled = false;
                } else {
                    console.error('Invalid response format:', data);
                }
            })
            .catch(error => console.error('Error loading municipalities:', error));
    }


    function loadBarangay() {
        // Get the selected region, province, and city codes
        const selectedRegionCode = regionSelect.value;
        const selectedProvinceName = provinceSelect.value;
        const selectedMunicipalityName = municipalitySelect.value;

        fetch(apiEndPoint)
            .then(response => response.json())
            .then(data => {
                const selectedRegion = data[selectedRegionCode];
                const selectedProvince = selectedRegion.province_list[selectedProvinceName];
                const selectedMunicipality = selectedProvince.municipality_list[selectedMunicipalityName];

                if (selectedMunicipality && selectedMunicipality.barangay_list) {
                    barangaySelect.innerHTML =
                        '<option value="">Select Barangay</option>'; // Clear existing barangay options

                    // Iterate over the barangays in the selected city
                    for (let barangayName of selectedMunicipality.barangay_list) {
                        const option = document.createElement('option');
                        option.value = barangayName;
                        option.textContent = barangayName;
                        barangaySelect.appendChild(option);
                    }

                    barangaySelect.disabled = false;
                } else {
                    console.error('Invalid response format:', data);
                }
            })
            .catch(error => console.error('Error loading barangays:', error));
    }


    window.onload = loadRegions
</script>
@endsection