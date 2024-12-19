function login() {
    var email = $("#email").val();
    var password = $("#password_hash").val();

    if (email === "" || password === "") {
        alert("Please fill in all fields.");
        return;
    }

    $.ajax({
        url: './api/login.php',
        type: 'POST',
        data: {
            email: email,
            password: password
        },
        success: function(response) {
            var res = JSON.parse(response);
            if (res.status) {
                // Handle successful login
                if (res.data.redirect_url) {
                    window.location.href = res.data.redirect_url;
                } else {
                    alert("Login successful, but no redirection URL provided.");
                }
            } else {
                // Handle errors
                alert(res.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while processing your request.');
        }
    });
}
