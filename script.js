function openNav() {
    var sidenav = document.getElementById("mySidenav");
    if (sidenav.style.width === "250px") {
        sidenav.style.width = "0";
    } else {
        sidenav.style.width = "250px";
    }
}

function goBack() {
    window.history.back();
}

// APPOINTMENT AJAX/DOM
function updateDentist() {
    var service_select = document.getElementById("service");
    var dentist_select = document.getElementById("dentist");
    var selected_service_id = service_select.value;
    var dentist_options = dentist_select.getElementsByTagName("option");
    for (var i = 0; i < dentist_options.length; i++) {
        var dentist_option = dentist_options[i];
        if (dentist_option.value === "") {
            continue;
        }
        var dentist_ids_str = service_select.options[service_select.selectedIndex].getAttribute("data-dentists");
        if (dentist_ids_str === "") {
            dentist_option.classList.add("hidden");
            dentist_option.selected = false;
        } else {
            var dentist_ids = dentist_ids_str.split(",");
            if (dentist_ids.includes(dentist_option.value)) {
                dentist_option.classList.remove("hidden");
            } else {
                dentist_option.classList.add("hidden");
                dentist_option.selected = false;
            }
        }
    }
}
document.getElementById("service").addEventListener("change", updateDentist);

function updateSchedule() {
    // Get the selected dentist ID from the dropdown list
    var dentistId = document.getElementById("dentist").value;

    // Send an AJAX request to fetch the dentist schedule data
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/DACclinic/processes/get_schedule.php?id=" + dentistId, true);
    xhr.onload = function () {
        // Check if the request was successful
        if (xhr.status === 200) {
            // Parse the response data as a JSON object
            var scheduleData = JSON.parse(xhr.responseText);

            // Update the time options in the dropdown list
            var timeOptions = "";
            for (var i = 0; i < scheduleData.length; i++) {
                timeOptions +=
                    '<option value="' + scheduleData[i].time + '">' + scheduleData[i].displayTime + "</option>";
            }
            document.getElementById("txttime").innerHTML = timeOptions;
        } else {
            console.log("Request failed: " + xhr.status);
        }
    };
    xhr.send();
}

function updatePrice() {
    var service_id = document.getElementById("service").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("price").value = this.responseText;
        }
    };
    xmlhttp.open("GET", "/DACclinic/processes/get_price.php?id=" + service_id, true);
    xmlhttp.send();
}

// MODALS
const myModal = document.getElementById("myModal");
const myInput = document.getElementById("myInput");

myModal.addEventListener("shown.bs.modal", () => {
    myInput.focus();
});

var deleteUserId;

function setDeleteUserId(id) {
    deleteUserId = id;
    document
        .querySelector("#staticBackdrop .modal-footer a[href='']")
        .setAttribute("href", "/DACclinic/processes/delete_user_process.php?id=" + id);
}

function deleteUser() {
    // You can use the 'deleteUserId' variable here to perform the delete operation
    console.log(deleteUserId);
}

function setDeleteUserId2(id) {
    deleteUserId2 = id;
    document
        .querySelector("#staticBackdrop .modal-footer a[href='']")
        .setAttribute("href", "/DACclinic/processes/delete_service.php?id=" + id);
}

function deleteUser2() {
    // You can use the 'deleteUserId' variable here to perform the delete operation
    console.log(deleteUserId2);
}

function setDeleteUserId3(id) {
    deleteUserId3 = id;
    document
        .querySelector("#staticBackdrop .modal-footer a[href='']")
        .setAttribute("href", "/DACclinic/processes/archive_process.php?id=" + id);
}

function deleteUser3() {
    // You can use the 'deleteUserId' variable here to perform the delete operation
    console.log(deleteUserId3);
}
