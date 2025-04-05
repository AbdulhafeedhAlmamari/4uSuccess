<!-- Chat Modal -->
<div class="modal fade chat-modal" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="chat-header">
                <img src="{{  asset('build/assets/images/consultant-05.png') }}" alt="User">
                <strong>المستشار وجد أحمد</strong>
            </div>
            <div class="chat-body d-flex flex-column">
                <div class="chat-message sent">هل يمكنك مساعدتي؟</div>
                <div class="chat-message received">مرحباً! كيف يمكنني مساعدتك؟</div>
            </div>
            <div class="modal-footer d-flex justify-content-start w-100">
                <input type="text" id="chatInput" class="form-control " style="width: 70%;"
                    placeholder="اكتب رسالتك هنا...">
                <button class="btn " id="sendMessage">إرسال</button>
            </div>
        </div>
    </div>
</div>
