const xhttp = new XMLHttpRequest();

var input = document.getElementById("search")

input.addEventListener("keyup", function() {
    var search = input.value

    $.ajax({
        method: "GET",
        url: "http://127.0.0.1:8000/notas?search="+search
    });
})