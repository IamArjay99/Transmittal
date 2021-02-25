$(document).ready(function() {
    
    // ----- CLICK LOGIN BUTTON -----
    $(document).on("click", "#btn_login", function(e) {
        e.preventDefault();

        const username = $("#username").val().trim();
        const password = $("#password").val().trim();
        password === "" && (username !== "" || username === "") && $("#password").focus();
        username === "" && (password !== "" || password === "") && $("#username").focus();

        let countErrors = 0;

        if (username == "" || username == null || username == undefined) {
            $("#username").removeClass("is-valid").addClass("is-invalid");
            $("#invalid-username").html("Please provide a username");
            countErrors++;
        } else {
            $("#username").removeClass("is-invalid").addClass("is-valid");
            $("#invalid-username").html("");
        }

        if (password == "" || password == null || password == undefined) {
            $("#password").removeClass("is-valid").addClass("is-invalid");
            $("#invalid-password").html("Please provide a password");
            countErrors++;
        } else {
            $("#password").removeClass("is-invalid").addClass("is-valid");
            $("#invalid-password").html("");
        }

        if (!countErrors > 0) {
            const data = {username, password};
            $.ajax({
                method: "POST",
                url: "auth/validateLogin",
                dataType: "json",
                data,
                success: function(data) {
                    let result = data.split("|");
                    if (result[0] == "false") {
                        $("#login_message").html(result[1]);
                        $("#username").focus();
                        $("#password").val("");
                    } else {
                        location.replace("dashboard");
                    }
                }
            })
        }
    });
    // ----- END CLICK LOGIN BUTTON -----

})