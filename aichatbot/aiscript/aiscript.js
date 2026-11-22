function sendMessage() {

    let input = document.getElementById("user-message");
    let message = input.value.trim();

    if (message === "") {
        return;
    }

    let chatBox = document.getElementById("chat-box");

    let userMessage = document.createElement("div");

    userMessage.className = "user-message";
    userMessage.textContent = message;

    chatBox.appendChild(userMessage);

    input.value = "";

    let botMessage = document.createElement("div");

    botMessage.className = "bot-message";
    botMessage.textContent = "AI is thinking...";

    chatBox.appendChild(botMessage);

    chatBox.scrollTop = chatBox.scrollHeight;

    fetch("api/aichat.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify({

            message: message

        })

    })

    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.error || "The travel assistant could not respond.");
        }

        return data;
    })

    .then(data => {

        botMessage.textContent = data.reply;

        chatBox.scrollTop = chatBox.scrollHeight;

    })

    .catch(error => {

        botMessage.textContent = error.message || "Something went wrong. Please try again.";

    });

}