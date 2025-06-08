export async function loginUser(email, password) {
  try {
    const response = await fetch("/api/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password })
    });

    return await response.json();
  } catch (error) {
    console.error("Greška:", error);
    return { success: false, message: "Greška u konekciji sa serverom." };
  }
}

export async function registerUser(name, email, password) {
  try {
    const response = await fetch("/api/register", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ name, email, password })
    });

    return await response.json();
  } catch (error) {
    console.error("Greška:", error);
    return { success: false, message: "Greška u konekciji sa serverom." };
  }
}
