@extends('layouts.app')
@section('title')
    {{ __('عرض المستشارون') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <style>
        a.btn-primary {
            background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
            border: none;
            height: 45px;
        }
    </style>
@endsection
@section('content')
    <!-- consultants section -->
    <section class="consultants-section my-5">
        <div class="container my-5 ">
            <p class="consultants_header mb-5">المستشارون</p>
            <form action="{{ route('home.consultants') }}" method="GET">
                <div class="d-flex justify-content-center">
                    <select class="form-select me-4" name="specialization" aria-label="Default select example">
                        <option value="">التخصص</option>
                        <option value="الذكاء الاصطناعي"
                            {{ request('specialization') == 'الذكاء الاصطناعي' ? 'selected' : '' }}>الذكاء الاصطناعي
                        </option>
                        <option value="إدارة الاعمال" {{ request('specialization') == 'إدارة الاعمال' ? 'selected' : '' }}>
                            إدارة الاعمال</option>
                        <option value="التربية الادبية"
                            {{ request('specialization') == 'التربية الادبية' ? 'selected' : '' }}>التربية الادبية</option>
                        <option value="علوم الحاسب" {{ request('specialization') == 'علوم الحاسب' ? 'selected' : '' }}>علوم
                            الحاسب</option>
                    </select>
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="radio" name="gender" value="ذكر" id="maleRadio"
                            {{ request('gender') == 'ذكر' ? 'checked' : '' }}>
                        <label class="form-check-label" for="maleRadio">
                            ذكر
                        </label>
                    </div>
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="radio" name="gender" value="انثى" id="femaleRadio"
                            {{ request('gender') == 'انثى' ? 'checked' : '' }}>
                        <label class="form-check-label" for="femaleRadio">
                            انثى
                        </label>
                    </div>
                    <button class="btn btn-primary ms-4" type="submit">بحث</button>
                </div>
            </form>

            @if (request('specialization') || request('gender'))
                <div class="container mt-3">
                    <div class="alert alert-info d-flex justify-content-between align-content-center">
                        <div>
                            <h5>نتائج البحث:</h5>
                            @if (request('specialization'))
                                <span class="badge bg-secondary me-2">التخصص: {{ request('specialization') }}</span>
                            @endif
                            @if (request('gender'))
                                <span class="badge bg-success me-2">الجنس:
                                    {{ request('gender') == 'ذكر' ? 'ذكر' : 'انثى' }}</span>
                            @endif
                        </div>
                        <a href="{{ route('home.consultants') }}" class="btn btn-primary   float-end w-auto">إلغاء
                            التصفية</a>
                        {{-- <a href="{{ route('home.consultants') }}"
                            class="btn btn-primary btn-outline-danger float-end w-auto">إلغاء التصفية</a> --}}
                    </div>
                </div>
            @endif

            <div class="container mb-5">
                <div class="row mt-5">
                    @forelse($consultants as $consultant)
                        <div class="col-lg-3 col-md-4 mt-3" data-aos="fade-down-left" data-aos-duration="1000">
                            <div class="card border-0 shadow p-2 rounded-3">
                                @if (isset($consultant->user->profile_image))
                                    <img src="{{ asset($consultant->user->profile_image) }}"
                                        class="card-img-top rounded-circle w-50 m-auto" style="height: 150px"
                                        alt="صورة المستشار">
                                @else
                                    <img src="{{ asset('build/assets/images/consultant-01.png') }}"
                                        class="card-img-top rounded-circle h-25 w-50 m-auto" style="height: 200px"
                                        alt="صورة المستشار">
                                @endif
                                <div class="card-body px-0 m-0">
                                    <h5 class="card-title">{{ $consultant->user->name }}</h5>
                                    <p class="card-text">{{ $consultant->specialization ?? 'التخصص غير متوفر' }}</p>
                                    <div class="row mt-5">
                                        <div class="col-10">
                                            <a href="{{ route('home.consultants.show', $consultant->id) }}"
                                                class="btn btn-view">عـــــرض الحساب</a>
                                        </div>
                                        <div class="col-2">
                                            <i class="fa-regular fa-comment-dots fs-3" data-bs-toggle="modal"
                                                data-bs-target="#chatModal" data-consultant-id="{{ $consultant->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 mt-4">
                            @if (!request('specialization') === null || !request('gender') === null)
                                <div class="alert alert-info text-center">
                                    لا يوجد مستشارين متاحين حالياً.
                                </div>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    @include('components.chat-modal')
@endsection

@section('script')
    {{-- <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script> --}}
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    {{-- <script src="{{ asset('build/assets/js/chat.js') }}"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables
            let receiverId = null;
            let chatMessages = document.getElementById('chat-messages');
            let chatForm = document.getElementById('chat-form');
            let messageInput = document.getElementById('message-input');
            let receiverIdInput = document.getElementById('receiver-id');
            let chatModal = document.getElementById('chatModal');
            let pusher = null;
            let channel = null;

            // Initialize Pusher
            function initializePusher() {
                // Get Pusher credentials from meta tags
                const pusherKey = document.querySelector('meta[name="pusher-app-key"]').content;
                const pusherCluster = document.querySelector('meta[name="pusher-app-cluster"]').content;
                // Initialize Pusher


                pusher = new Pusher(pusherKey, {
                    cluster: pusherCluster,
                    forceTLS: true,
                    authEndpoint: '/broadcasting/auth',
                    auth: {
                        headers: {
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }
                });
                // alert(pusher);


            }
            console.log('saaaaaa');
            // Initialize chat when modal is shown
            if (chatModal) {
                chatModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const consultantId = button.getAttribute('data-consultant-id');

                    if (consultantId) {
                        // Initialize Pusher if not already initialized
                        if (!pusher) {
                            initializePusher();
                        }

                        initializeChat(consultantId);

                    }
                });

                // Clear chat when modal is hidden
                chatModal.addEventListener('hidden.bs.modal', function() {
                    chatMessages.innerHTML = '';
                    if (channel) {
                        channel.unbind_all();
                        pusher.unsubscribe(channel.name);
                        channel = null;
                    }
                });
            }

            // Initialize chat with consultant
            function initializeChat(consultantId) {
                fetch(`/chat/consultant/${consultantId}`)
                    .then(response => response.json())
                    .then(data => {
                        // alert(data.user_id);
                        // Set recipient name in modal title
                        document.getElementById('chat-recipient-name').textContent = data.consultant.user.name;
                        document.getElementById('chat-recipient-avatar').src = data.consultant.user
                            .profile_image;

                        // Set receiver ID for sending messages
                        receiverId = data.user_id;
                        receiverIdInput.value = receiverId;


                        // Load previous messages
                        loadMessages(receiverId);

                        // Subscribe to private channel
                        subscribeToChannel(receiverId);
                    })
                    .catch(error => {
                        console.error('Error fetching consultant details:', error);
                        chatMessages.innerHTML =
                            '<div class="alert alert-danger">' + error + '</div>';
                    });
            }

            // Load previous messages
            function loadMessages(userId) {
                chatMessages.innerHTML = `
        <div class="text-center p-3 loading-messages">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">جاري التحميل...</span>
            </div>
            <p>جاري تحميل المحادثة...</p>
        </div>
    `;

                fetch(`/chat/messages?user_id=${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        chatMessages.innerHTML = '';

                        if (data.messages.length === 0) {
                            chatMessages.innerHTML =
                                '<div class="text-center text-muted p-3">لا توجد رسائل سابقة. ابدأ المحادثة الآن!</div>';
                        } else {

                            renderMessages(data.messages, data.current_user_id);
                        }

                        // Scroll to bottom
                        scrollToBottom();
                    })
                    .catch(error => {
                        console.error('Error loading messages:', error);
                        chatMessages.innerHTML =
                            '<div class="alert alert-danger">حدث خطأ أثناء تحميل الرسائل</div>';
                    });
            }

            // Render messages in the chat
            function renderMessages(messages, currentUserId) {
                messages.forEach(message => {
                    // console.log(message..JSON);
                    const isCurrentUser = message.sender_id == currentUserId;
                    const messageClass = isCurrentUser ? 'message-sent' : 'message-received';
                    const alignment = isCurrentUser ? 'ms-auto' : 'me-auto';

                    const messageTime = new Date(message.created_at).toLocaleTimeString('ar-SA', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const messageElement = document.createElement('div');
                    messageElement.className = `message-container ${alignment}`;
                    messageElement.innerHTML = `
            <div class="message ${messageClass}">
                ${message.message}
                <div class="message-time">${messageTime}</div>
            </div>
        `;

                    chatMessages.appendChild(messageElement);
                });
            }

            // Subscribe to private channel for real-time messages
            function subscribeToChannel(otherUserId) {
                if (!pusher) {
                    console.error('Pusher is not initialized');
                    return;
                }

                // Get current user ID from meta tag
                const currentUserId = document.querySelector('meta[name="user-id"]')?.content;

                if (!currentUserId) {
                    console.error('Current user ID not found');
                    return;
                }

                // Create a consistent channel name
                const ids = [parseInt(currentUserId), parseInt(otherUserId)].sort();
                const channelName = `private-chat.${ids[0]}.${ids[1]}`;

                // Subscribe to the channel
                channel = pusher.subscribe(channelName);

                // Listen for new messages
                channel.bind('App\\Events\\NewChatMessage', function(data) {
                    // Only render if the message is from the other user
                    if (data.message.sender_id != currentUserId) {
                        renderMessages([data.message], currentUserId);
                        scrollToBottom();
                    }
                });

                // Handle subscription error
                // channel.bind('pusher:subscription_error', function(status) {
                //     console.error('Pusher subscription error:', status);
                //     chatMessages.innerHTML +=
                //         '<div class="alert alert-danger">حدث خطأ في الاتصال. يرجى تحديث الصفحة.</div>';
                // });
            }

            // Send a new message
            if (chatForm) {
                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (!messageInput.value.trim()) return;

                    const formData = new FormData(chatForm);

                    fetch('/chat/send', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                receiver_id: formData.get('receiver_id'),
                                message: formData.get('message')
                            })
                        })

                        .then(response => response.json())
                        .then(data => {
                            // Add the sent message to the chat
                            renderMessages([data], data.sender_id);
                            scrollToBottom();

                            // Clear input
                            messageInput.value = '';
                        })
                        .catch(error => {
                            console.error('Error sending message:', error);
                            alert('حدث خطأ أثناء إرسال الرسالة');
                        });
                });
            }

            // Scroll chat to bottom
            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
@endsection
