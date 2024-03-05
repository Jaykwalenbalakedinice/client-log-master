<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/bd99322ebc.js" crossorigin="anonymous"></script>

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
    })
</script>

<script>
    // Prevents multiple form submission.
    document.querySelector('form').addEventListener('submit', function() {
        this.querySelector("button[type='submit']").disabled = true;
    });

    function clearPlaceholder(input) {
        input.setAttribute('data-original-placeholder', input.placeholder);
        input.placeholder = '';
    };

    function restorePlaceholder(input) {
        if (!input.value.trim()) {
            input.placeholder = input.getAttribute('data-original-placeholder');
        }
    }
</script>
    

<script>
    // Check if the submitted message exists
    document.addEventListener('DOMContentLoaded', function() {
                var submittedMessage = document.getElementById('submittedMessage').querySelector('.alert');

                if (submittedMessage) {
                    setTimeout(function() {
                        submittedMessage.classList.add('fade-out');

                        submittedMessage.addEventListener('transitionend', function() {
                            submittedMessage.parentNode.removeChild(submittedMessage);
                        });
                    }, 4000);
                }
            });
</script>
    
<script>
    // Script for API
            var config = {
                cUrl: 'https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json'
            }

            var apiEndPoint =
                'https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json';

            var regionSelect = document.querySelector('#region'); provinceSelect = document.querySelector('#province'),
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
            

<script>
    // Data Automatically uppercased
    function convertToUppercase(inputElement) {
        // Get the current input value
        const inputValue = inputElement.value;

        // Convert to uppercase
        const uppercaseValue = inputValue.toUpperCase();

        // Set the converted value back to the input
        inputElement.value = uppercaseValue;
    }
</script>
    

<script>
    // Disabling submit button  until checkbox is checked.
    $(document).ready(function() {
        $('#termsAndCondition').change(function() {
            if ($(this).is(':checked')) {
                $('#submitBtn').prop('disabled', false);
            } else {
                $('#submitBtn').prop('disabled', true);
            }
        });
    })
</script>