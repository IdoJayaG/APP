document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form dari reload halaman

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Membaca file JSON user
    fetch('users.json')
        .then(response => response.json())
        .then(users => {
            // Mencari user yang cocok dengan username dan password
            const user = users.find(user => user.username === username && user.password === password);

            if (user) {
                // Jika user ditemukan, redirect ke halaman branda
                window.location.href = 'branda.html';
            } else {
                // Jika user tidak ditemukan, tampilkan pesan error
                document.getElementById('error-message').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
        });
});
