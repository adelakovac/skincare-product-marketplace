import { loginUser } from "../services/authService.js";

document.getElementById("loginForm").addEventListener("submit", async function (e) {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    alert("Sva polja su obavezna!");
    return;
  }

  const result = await loginUser(email, password);
  if (result.success) {
    alert("Login uspješan!");
    window.location.href = "index.html";
  } else {
    alert("Login neuspješan: " + result.message);
  }
});
document.getElementById('loginForm').addEventListener('submit', async (e) => {
  e.preventDefault();

  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;

  try {
    const response = await fetch('/backend/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ email, password }),
    });

    const data = await response.json();

    if (data.success) {
      alert('Uspješna prijava! Dobrodošli, ' + email);
      // Možeš ovdje redirect na dashboard ili početnu stranicu
      window.location.href = '/views/dashboard.html';
    } else {
      alert('Greška: ' + data.message);
    }
  } catch (error) {
    alert('Došlo je do greške, pokušajte ponovo.');
    console.error(error);
  }
});
