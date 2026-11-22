<!DOCTYPE html>
<html>
<head>
    <title>Travel Mate AI</title>
    <link rel="stylesheet" href="aicss/aichatbot.css">
</head>

<body>

<div class="chat-container">

    <div class="chat-header">
        <h3>Travel Mate AI</h3>
        <p>Your personal travel assistant</p>
    </div>

    <div id="chat-box" class="chat-box">
        <div class="bot-message">
            Hello! How can I help you explore this destination?
        </div>
    </div>

    <div class="chat-input">

        <input
            type="text"
            id="user-message"
            placeholder="Ask about this place..."
        >

        <button onclick="sendMessage()">Send</button>

    </div>

</div>

<script src="aiscript/aiscript.js"></script>

</body>
</html>