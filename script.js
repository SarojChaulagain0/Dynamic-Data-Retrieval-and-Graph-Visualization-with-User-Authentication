
function sendQuery() {
    var name = document.getElementById("name").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var responseData = JSON.parse(xhr.responseText);
            populateTable(responseData);
        }
    };

    xhr.open("POST", "query.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("name=" + name);
}

function populateTable(data) {
    var table = document.getElementById("resultTable").getElementsByTagName('tbody')[0];
    table.innerHTML = "";

    for (var i = 0; i < data.length; i++) {
        var row = table.insertRow(i);
        var cell = row.insertCell(0);
        cell.innerHTML = data[i].name;
    }
}
