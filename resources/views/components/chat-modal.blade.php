<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex gap-3 align-items-center" id="chatModalLabel">
                    <div style="width: 40px; height: 40px">
                        <img src="{{ asset('images/default.jpeg') }}" id="chat-recipient-avatar"
                            class="rounded-circle  w-100 h-100" alt="User">
                    </div><span id="chat-recipient-name">المحادثة</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="chat-container">
                    <div class="chat-messages" id="chat-messages">
                        <!-- Messages will be loaded here -->
                        <div class="text-center p-3 loading-messages">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">جاري التحميل...</span>
                            </div>
                            <p>جاري تحميل المحادثة...</p>
                        </div>
                    </div>
                    <div class="chat-input mt-3">
                        <form id="chat-form" class="d-flex">
                            <input type="hidden" id="receiver-id" name="receiver_id" value="">
                            <input type="text" id="message-input" name="message" class="form-control"
                                placeholder="اكتب رسالتك هنا..." required>
                            <button type="submit" class="btn btn-primary ms-2">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pusher CDN -->

<style>
    .chat-container {
        display: flex;
        flex-direction: column;
        height: 400px;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    .message {
        margin-bottom: 10px;
        padding: 8px 12px;
        border-radius: 18px;
        max-width: 70%;
        word-wrap: break-word;
    }

    .message-sent {
        background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
        color: white;
        align-self: flex-end;
        margin-left: auto;
    }

    .message-received {
        background-color: #e9ecef;
        color: #212529;
        align-self: flex-start;
        margin-right: auto;
    }

    .message-time {
        font-size: 0.7rem;
        margin-top: 5px;
        opacity: 0.7;
    }

    .message-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .chat-input {
        margin-top: 10px;
    }

    .chat-input form {
        display: flex;
    }

    .chat-input input {
        flex: 1;
        border-radius: 20px;
        padding: 10px 15px;
    }

    .chat-input button {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
        border: none;
    }
</style>
