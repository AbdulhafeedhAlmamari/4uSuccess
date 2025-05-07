<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex gap-3 align-items-center" id="chatModalLabel">
                    <div style="width: 40px; height: 40px">
                        <img src="{{ asset('images/default.jpeg') }}" id="chat-recipient-avatar"
                            class="rounded-circle w-100 h-100" alt="User">
                    </div><span id="chat-recipient-name">المحادثة</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="chat-messages" id="chat-messages">
                    <!-- Messages will be loaded here -->
                    <div class="text-center p-3 loading-messages">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">جاري التحميل...</span>
                        </div>
                    </div>
                </div>
                <div class="chat-input mt-3">
                    <form id="chat-form">
                        <div class="input-group">
                            <input type="text" class="form-control" id="message-input"
                                placeholder="اكتب رسالتك هنا...">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* .chat-messages {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    } */

    .message {
        margin-bottom: 10px;
        padding: 8px 12px;
        border-radius: 15px;
        max-width: 80%;
        word-wrap: break-word;
    }

    .message-sent {
        background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
        color: white;
        align-self: flex-end;
        margin-left: auto;
    }

    .message-received {
        background-color: #ffffff;
        margin-right: auto;
        border-top-left-radius: 5px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
        color: white;
        align-self: flex-end;
        margin-left: auto;
    }

    .message-time {
        font-size: 0.7rem;
        color: #999;
        margin-top: 3px;
        text-align: right;
    }

    .message-sender {
        font-weight: bold;
        margin-bottom: 3px;
    }
</style>

<script>
    document.getElementById('chatModal').addEventListener('hidden.bs.modal', function() {
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        document.body.classList.remove('modal-open');
        document.body.style = ''; // لإزالة overflow: hidden;
    });
    document.addEventListener('DOMContentLoaded', function() {
        let currentRecipientId = null;
        const chatMessages = document.getElementById('chat-messages');
        const messageInput = document.getElementById('message-input');
        const chatForm = document.getElementById('chat-form');
        const recipientNameSpan = document.getElementById('chat-recipient-name');
        const recipientAvatar = document.getElementById('chat-recipient-avatar');
        document.getElementById('chat-recipient-avatar');

        // Function to open chat with a specific consultant
        window.openChat = function(recipientId, recipientName, recipientAvatar = null) {
            currentRecipientId = recipientId;
            recipientNameSpan.textContent = recipientName;

            // Set recipient avatar if provided, otherwise use default
            if (recipientAvatar) {
                document.getElementById('chat-recipient-avatar').src = recipientAvatar;
            } else {
                // Fetch user details to get avatar
                fetchUserDetails(recipientId);
            }

            // Clear previous messages
            chatMessages.innerHTML = `
                <div class="text-center p-3 loading-messages">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">جاري التحميل...</span>
                    </div>
                </div>
            `;

            // Load messages
            loadMessages(recipientId);

            // Show the modal
            const chatModal = new bootstrap.Modal(document.getElementById('chatModal'));
            chatModal.show();
        };

        // Function to fetch user details
        function fetchUserDetails(userId) {
            fetch(`/users/${userId}/details`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.consultant) {
                        // Update avatar if available
                        if (data.user.avatar) {
                            document.getElementById('chat-recipient-avatar').src = data.user.avatar;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching user details:', error);
                });
        }

        // Function to create message element
        function createMessageElement(message) {
            const div = document.createElement('div');
            const isCurrentUser = message.sender_id === {{ Auth::id() }};

            div.className = `message ${isCurrentUser ? 'message-sent' : 'message-received'}`;

            let content = '';
            if (!isCurrentUser) {
                content += `<div class="message-sender">${message.sender_name}</div>`;
            }

            content += `
                <div class="message-content">${message.message || message.content}</div>
                <div class="message-time">${formatMessageTime(message.created_at)}</div>
            `;

            div.innerHTML = content;
            return div;
        }

        // Function to load messages
        function loadMessages(recipientId) {
            fetch(`/chat/messages?receiver_id=${recipientId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear loading spinner
                    chatMessages.innerHTML = '';

                    if (data.messages.length === 0) {
                        chatMessages.innerHTML =
                            '<div class="text-center p-3">لا توجد رسائل سابقة. ابدأ المحادثة الآن!</div>';
                        return;
                    }

                    // Display messages
                    data.messages.forEach(message => {
                        const messageElement = createMessageElement(message);
                        chatMessages.appendChild(messageElement);
                    });

                    // Scroll to bottom
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                })
                .catch(error => {
                    console.error('Error loading messages:', error);
                    chatMessages.innerHTML =
                        '<div class="text-center p-3 text-danger">حدث خطأ أثناء تحميل الرسائل</div>';
                });
        }

        // Function to format message time
        function formatMessageTime(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleTimeString('ar-SA', {
                    hour: '2-digit',
                    minute: '2-digit'
                }) +
                ' ' + date.toLocaleDateString('ar-SA', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
        }

        // Handle form submission
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const message = messageInput.value.trim();
            if (!message || !currentRecipientId) return;

            // Clear input
            messageInput.value = '';

            // Add message to chat (optimistic UI update)
            const tempMessage = {
                sender_id: {{ Auth::id() }},
                content: message,
                created_at: new Date().toISOString()
            };

            const messageElement = createMessageElement(tempMessage);
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Send message to server
            fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        receiver_id: currentRecipientId,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Error sending message:', data.error);
                        alert('حدث خطأ أثناء إرسال الرسالة' + data);
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    alert('حدث خطأ أثناء إرسال الرسالة');
                });
        });
    });
</script>
