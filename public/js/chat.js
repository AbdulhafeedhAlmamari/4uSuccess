document.getElementById('sendMessage').addEventListener('click', function () {
    let input = document.getElementById('chatInput');
    let messageText = input.value.trim();
    if (messageText) {
        let chatBody = document.querySelector('.chat-body');
        let messageDiv = document.createElement('div');
        messageDiv.classList.add('chat-message', 'sent');
        messageDiv.textContent = messageText;
        chatBody.appendChild(messageDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
        input.value = ''; // Clear input
    }
});
