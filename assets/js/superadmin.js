document.addEventListener("DOMContentLoaded", function() {
    // Fetch pending users
    fetchPendingUsers();

    function fetchPendingUsers() {
        fetch('./api/get-pending-users.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let usersHtml = '';
                    data.users.forEach(user => {
                        usersHtml += `
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.email}</td>
                                <td>${new Date(user.created_at).toLocaleString()}</td>
                                <td>
                                    <button class="btn btn-success" onclick="approveUser(${user.id})">Approve</button>
                                </td>
                            </tr>
                        `;
                    });
                    document.getElementById('pending-users-list').innerHTML = usersHtml;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error fetching pending users:', error));
    }

    // function approveUser(userId) {
    //     fetch('./api/approve-user.php', {
    //         method: 'POST',
    //         body: JSON.stringify({ user_id: userId }),
    //         headers: {
    //             'Content-Type': 'application/json'
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.success) {
    //             alert('User approved successfully.');
    //             fetchPendingUsers(); // Reload the pending users list
    //         } else {
    //             alert(data.message);
    //         }
    //     });
    // }
});
