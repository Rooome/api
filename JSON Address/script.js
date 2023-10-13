document.addEventListener("DOMContentLoaded", function () {
  //Get the element ID for the HTML code and assigned variables
  const regionSelect = document.getElementById("region");
  const provinceSelect = document.getElementById("province");
  const municipalitySelect = document.getElementById("municipality");
  const barangaySelect = document.getElementById("barangay");
  const addressForm = document.getElementById("address-form");
  const selectedRegionElem = document.getElementById("selected-region");
  const selectedProvinceElem = document.getElementById("selected-province");
  const selectedMunicipalityElem = document.getElementById("selected-municipality");
  const selectedBarangayElem = document.getElementById("selected-barangay");

  fetch("philippine_provinces_cities_municipalities_and_barangays_2016.json")
    .then((response) => response.json())
    .then((data) => {
      // fetch the region select box with data from JSON
      for (const regionKey in data) {
        if (data.hasOwnProperty(regionKey)) {
          const region = data[regionKey];
          const option = document.createElement("option");
          option.value = regionKey;
          option.textContent = region.region_name;
          regionSelect.appendChild(option);
        }
      }

      // Update province options 
      regionSelect.addEventListener("change", updateProvinceOptions);

      // Update municipality and barangay 
      provinceSelect.addEventListener("change", updateMunicipalityOptions);

      // Update barangay 
      municipalitySelect.addEventListener("change", updateBarangayOptions);

      // Handles submission of Form
      addressForm.addEventListener("submit", handleFormSubmission);

      function updateProvinceOptions() {
        const selectedRegionKey = regionSelect.value;
        provinceSelect.innerHTML = ""; 
      
        // Creates the default option "Select Province"
        const defaultOption = document.createElement("option");
        defaultOption.textContent = "Select Province";
        provinceSelect.appendChild(defaultOption);
      //Check Selected Region
        if (selectedRegionKey !== "") {
          //Populating Province Dropdown
          const selectedRegion = data[selectedRegionKey];
          const provinces = selectedRegion.province_list;
      
          for (const provinceKey in provinces) {
            if (provinces.hasOwnProperty(provinceKey)) {
              const province = provinces[provinceKey];
              const option = document.createElement("option");
              option.value = provinceKey;
              option.textContent = provinceKey;
              provinceSelect.appendChild(option);
            }
          }
        }
      }      

      function updateMunicipalityOptions() {
        const selectedProvinceKey = provinceSelect.value;
        municipalitySelect.innerHTML = ""; // clears the options in the municipality options
      
        const defaultOptionMunicipality = document.createElement("option");
        defaultOptionMunicipality.textContent = "Select Municipality";
        municipalitySelect.appendChild(defaultOptionMunicipality);
      
        if (selectedProvinceKey !== "") {
          const selectedRegionKey = regionSelect.value;
          const selectedProvince = data[selectedRegionKey].province_list[selectedProvinceKey];
          const municipalities = selectedProvince.municipality_list;

          for (const municipalityKey in municipalities) {
            if (municipalities.hasOwnProperty(municipalityKey)) {
              const municipality = municipalities[municipalityKey];

              // Since municipality is an object, we need to access its name property
              const municipalityName = Object.keys(municipality)[0];
      
              const option = document.createElement("option");
              option.value = municipalityName; 
              option.textContent = municipalityName; 
              municipalitySelect.appendChild(option);
            }
          }
        }
      }
      
      function updateBarangayOptions() {
        const selectedRegionKey = regionSelect.value;
        const selectedProvinceKey = provinceSelect.value;
        const selectedMunicipalityKey = municipalitySelect.value;
        barangaySelect.innerHTML = ""; 
      
        const defaultOptionBarangay = document.createElement("option");
        defaultOptionBarangay.textContent = "Select Barangay";
        barangaySelect.appendChild(defaultOptionBarangay);
      
        if (selectedRegionKey && selectedProvinceKey && selectedMunicipalityKey) {
          const selectedMunicipality = data[selectedRegionKey].province_list[selectedProvinceKey].municipality_list.find(
            (municipality) => Object.keys(municipality)[0] === selectedMunicipalityKey
          );
      
          if (selectedMunicipality) {
            const barangayList = selectedMunicipality[selectedMunicipalityKey].barangay_list;
      
            
            for (const barangay of barangayList) {
              const option = document.createElement("option");
              option.value = barangay;
              option.textContent = barangay;
              barangaySelect.appendChild(option);
            }
          }
        }
      }      
      
      
      function handleFormSubmission(e) {
        e.preventDefault();

        // fetch the selected values
        const selectedRegion = regionSelect.options[regionSelect.selectedIndex].text;
        const selectedProvince = provinceSelect.options[provinceSelect.selectedIndex].text;
        const selectedMunicipality = municipalitySelect.options[municipalitySelect.selectedIndex].text;
        const selectedBarangay = barangaySelect.options[barangaySelect.selectedIndex].text;

        // Display selected values in the results
        selectedRegionElem.textContent = selectedRegion;
        selectedProvinceElem.textContent = selectedProvince;
        selectedMunicipalityElem.textContent = selectedMunicipality;
        selectedBarangayElem.textContent = selectedBarangay;
      }
    })
    .catch((error) => {
      console.error("Error loading JSON data: ", error);
    });
});
