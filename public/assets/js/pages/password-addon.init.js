document.getElementById("password-addon") &&
    document
        .getElementById("password-addon")
        .addEventListener("click", function () {
            var e = document.getElementById("password-input");
            "password" === e.type ? (e.type = "text") : (e.type = "password");
        });

document.getElementById("password-confirm-addon") &&
    document
        .getElementById("password-confirm-addon")
        .addEventListener("click", function () {
            var e = document.getElementById("password-confirm-input");
            "password" === e.type ? (e.type = "text") : (e.type = "password");
        });
