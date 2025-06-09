import { registerUser } from "../services/authService.js";

document.getElementById("registerForm").addEventListener("submit", async function (e) {
  e.preventDefault();

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!name || !email || !password) {
    alert("Sva polja su obavezna!");
    return;
  }

  const result = await registerUser(name, email, password);
  if (result.success) {
    alert("Registracija uspješna!");
    window.location.href = "login.html";
  } else {
    alert("Greška: " + result.message);
  }
});
