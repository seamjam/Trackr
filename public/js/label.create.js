let labels = [];

function addLabel() {
    const label_count = document.getElementById("label_count").value;
    const post_company = document.getElementById("post_company").value;
    const postal_code = document.getElementById("postal_code").value;
    const house_number = document.getElementById("house_number").value;
    const receiver_first_name = document.getElementById("receiver_first_name").value;
    const receiver_last_name = document.getElementById("receiver_last_name").value;

    //validation
    const postalCodeRegex = /^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/;

    if (isNaN(label_count)) {
        alert("Amount should be a number");
        return;
    }

    if (isNaN(house_number)) {
        alert("House number should be a number");
        return;
    }

    if (!postalCodeRegex.test(postal_code)) {
        alert("Incorrect postal code: " + postal_code);
        return;
    }

    if (!/^[a-zA-Z]+$/.test(receiver_first_name)) {
        alert("First name should only contain letters");
        return;
    }

    if (!/^[a-zA-Z]+$/.test(receiver_last_name)) {
        alert("Last name should only contain letters");
        return;
    }

    for (let i = 0; i < label_count; i++) {
        const label = {
            label_count,
            post_company,
            postal_code,
            house_number,
            receiver_first_name,
            receiver_last_name
        };

        labels.push(label);
    }
    renderTable();
    saveLabels();
}


function saveLabels() {
    const labelsJSON = JSON.stringify(labels);
    localStorage.setItem('labels', labelsJSON);
}

function loadLabels() {
    const labelsJSON = localStorage.getItem('labels');
    if (labelsJSON) {
        labels = JSON.parse(labelsJSON);
        renderTable();
    }
}

window.onload = loadLabels;

function deleteLabel(index) {
    labels.splice(index, 1);
    renderTable();
    saveLabels();
}

function renderTable() {
    const tableBody = document.querySelector("#label_table tbody");
    tableBody.innerHTML = "";

    labels.forEach((label, index) => {
        const row = document.createElement("tr");

        const postCompanyCell = document.createElement("td");
        postCompanyCell.innerHTML = "<strong>Delivery Company:</strong> " + label.post_company;
        row.appendChild(postCompanyCell);

        const postalCodeCell = document.createElement("td");
        postalCodeCell.innerHTML = "<strong>Postal Code:</strong> " + label.postal_code;
        row.appendChild(postalCodeCell);

        const houseNumberCell = document.createElement("td");
        houseNumberCell.innerHTML = "<strong>House Number:</strong> " + label.house_number;
        row.appendChild(houseNumberCell);


        const receiverFirstNameCell = document.createElement("td");
        receiverFirstNameCell.innerHTML = "<strong>First Name: </strong> " + label.receiver_first_name;
        row.appendChild(receiverFirstNameCell);

        const receiverLastNameCell = document.createElement("td");
        receiverLastNameCell.innerHTML = "<strong>Last Name: </strong> " + label.receiver_last_name;
        row.appendChild(receiverLastNameCell);

        const actionsCell = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", () => {
            deleteLabel(index);
        });
        actionsCell.appendChild(deleteButton);
        row.appendChild(actionsCell);

        tableBody.appendChild(row);

        const labelsInput = document.querySelector("#labels_input");
        labelsInput.value = JSON.stringify(labels);
    });
}


function clearTable() {
    const tableBody = document.querySelector("#label_table tbody");
    tableBody.innerHTML = "";
}

const submitButton = document.querySelector("button[type='submit']");
submitButton.addEventListener("click", submitForm);

function submitForm() {
    const labelsInput = document.querySelector("#labels_input");
    labelsInput.value = JSON.stringify(labels);

    document.querySelector("#myForm").submit();
    clearTable();
    localStorage.removeItem('labels');
}





