$(document).ready(function() {
    $('#registrationForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());
        formData.append('mobile', $('#mobile').val());
        formData.append('address', $('#address').val());
        formData.append('gender', $('#gender').val());
        formData.append('dob', $('#dob').val());
        formData.append('profile_picture', $('#profile_picture')[0].files[0]);
        formData.append('signature', $('#signature')[0].files[0]);
        formData.append('role', $('#role').val());

        $.ajax({
            url: './api/register.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert('Registration successful!');
                // Redirect or update UI as needed
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Registration failed. Please try again.');
            }
        });
    });
});
