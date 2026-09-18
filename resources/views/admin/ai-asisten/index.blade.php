@extends('layouts.admin')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">
            <div class="page-header-title">
                <h2 class="mb-0 text-xl font-bold text-gray-800 dark:text-white">
                    AI Asisten Akademik
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="grid grid-cols-12">
    <div class="col-span-12">
        <div class="card border-0 shadow-sm rounded-xl overflow-hidden h-[calc(100vh-200px)] flex flex-col">
            <div class="card-header px-6 py-4 bg-white dark:bg-themedark-cardbg border-b border-gray-200 dark:border-themedark-border">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-primary-500/10 flex items-center justify-center shrink-0">

                        <img
                            src="{{ asset('templates/backend/images/user/ai-logo.jpeg') }}"
                            class="w-full h-full object-cover"
                            alt="SIPAF AI"
                        >

                    </div>
                    <div>

                        <h5 class="mb-0 font-semibold text-gray-800 dark:text-white">
                            SIPAF Intellect AI
                        </h5>

                        <span class="text-xs text-success-500 flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-success-500 inline-block animate-pulse"></span>
                            Online & Siap Membantu
                        </span>
                    </div>
                </div>
            </div>

            <div
                id="chat-box"
                class="card-body grow p-6 overflow-y-auto space-y-5 bg-gray-50/60 dark:bg-themedark-bodybg"
            >

                <div class="w-full flex items-end gap-3 justify-start">
                    <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 shadow-sm">

                        <img
                            src="{{ asset('templates/backend/images/user/ai-logo.jpeg') }}"
                            class="w-full h-full object-cover"
                            alt="AI"
                        >

                    </div>


                    <div class="max-w-[75%] sm:max-w-[65%]">
                        <div class="ai-message bg-white dark:bg-themedark-cardbg
                            p-4
                            rounded-2xl
                            rounded-tl-none
                            shadow-sm
                            border
                            border-gray-100
                            dark:border-themedark-border
                            text-sm
                            text-gray-800
                            dark:text-gray-200
                            leading-relaxed
                            break-words
                        ">

                            <p class="mb-3">
                                Halo Admin SIPAF!
                            </p>

                            <p>
                                Ada masalah pengaduan mahasiswa yang perlu saya analisis
                                atau bantu carikan solusi/draft balasannya?
                            </p>

                            <p class="mt-3 mb-0">
                                Silakan ketik pertanyaan atau pengaduan di bawah.
                            </p>

                        </div>


                        <div class="text-[10px] text-gray-400 mt-1 ml-1">
                            SIPAF Intellect AI
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-footer p-4 bg-white dark:bg-themedark-cardbg border-t border-gray-200 dark:border-themedark-border">
                <form id="chat-form" class="flex gap-3 items-center">
                    @csrf

                    <div class="relative grow">
                        <input
                            type="text"
                            id="user-input"
                            autocomplete="off"
                            maxlength="5000"
                            class="form-control w-full rounded-xl
                                border-gray-300
                                dark:bg-themedark-inputbg
                                dark:border-themedark-border
                                placeholder-gray-400
                                text-sm
                                py-3
                                pl-4
                                pr-4"
                            placeholder="Tulis pengaduan atau pertanyaan di sini..."
                        >

                    </div>

                    <button
                        type="submit"
                        id="send-button"
                        class="btn btn-primary
                            px-5
                            py-3
                            rounded-xl
                            transition-all
                            font-medium
                            text-sm
                            flex
                            items-center
                            gap-2
                            shadow-sm
                            shrink-0"
                    >

                        <i
                            id="send-icon"
                            class="ti ti-send text-base"
                        ></i>

                        <span id="send-text">
                            Kirim
                        </span>

                    </button>

                </form>


                <div class="text-[10px] text-gray-400 mt-2 text-center">

                    SIPAF Intellect AI dapat membantu menganalisis dan menyusun
                    draft tanggapan pengaduan akademik.

                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

@endsection

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <!-- HTML Sanitizer -->
    <script src="https://cdn.jsdelivr.net/npm/dompurify@3.2.6/dist/purify.min.js"></script>

    <style>
        .ai-message {
            line-height: 1.7;
        }
        .ai-message p {
            margin-top: 0;
            margin-bottom: 0.75rem;
        }
        .ai-message p:last-child {
            margin-bottom: 0;
        }
        .ai-message ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin-top: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .ai-message ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-top: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .ai-message li {
            margin-bottom: 0.5rem;
            padding-left: 0.2rem;
        }
        .ai-message li:last-child {
            margin-bottom: 0;
        }
        .ai-message li > ul,
        .ai-message li > ol {
            margin-top: 0.35rem;
            margin-bottom: 0.35rem;
        }
        .ai-message strong {
            font-weight: 700;
        }
        .ai-message h1,
        .ai-message h2,
        .ai-message h3,
        .ai-message h4 {
            font-weight: 700;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }


        .ai-message h1:first-child,
        .ai-message h2:first-child,
        .ai-message h3:first-child,
        .ai-message h4:first-child {
            margin-top: 0;
        }
        .ai-message h3 {
            font-size: 1rem;
        }
        .ai-message h4 {
            font-size: 0.95rem;
        }
        .ai-message code {
            background: rgba(0, 0, 0, 0.06);
            padding: 0.15rem 0.35rem;
            border-radius: 0.3rem;
            font-size: 0.85em;
        }
        .ai-message blockquote {
            border-left: 3px solid currentColor;
            padding-left: 1rem;
            margin: 0.75rem 0;
            opacity: 0.8;
        }
        .ai-message a {
            text-decoration: underline;
        }
    </style>


    <script>
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const chatBox = document.getElementById('chat-box');
        const sendButton = document.getElementById('send-button');
        const sendIcon = document.getElementById('send-icon');
        const sendText = document.getElementById('send-text');

        let conversation = [];

        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const pesanText = userInput.value.trim();

            if (!pesanText) {
                userInput.focus();
                return;
            }

            appendMessage('User', pesanText);

            conversation.push({
                role: 'user',
                content: pesanText
            });

            userInput.value = '';

            setLoading(true);

            const loadingId = appendLoading();


            scrollToBottom();

            try {

                const response = await fetch(
                    "{{ route('admin.ai-asisten.tanya') }}",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },

                        body: JSON.stringify({
                            messages: conversation
                        })
                    }
                );

                const data = await response.json();

                const loadingElement =
                    document.getElementById(loadingId);

                if (loadingElement) {
                    loadingElement.remove();
                }

                if (response.ok && data.status === 'success') {

                    appendMessage(
                        'AI',
                        data.jawaban
                    );

                    conversation.push({
                        role: 'assistant',
                        content: data.jawaban
                    });

                } else {

                    appendMessage(
                        'AI',
                        data.jawaban || 'Maaf, terjadi kesalahan pada sistem.'
                    );
                }

            } catch (error) {

                console.error(
                    'SIPAF AI Error:',
                    error
                );

                const loadingElement =
                    document.getElementById(loadingId);

                if (loadingElement) {
                    loadingElement.remove();
                }

                appendMessage(
                    'AI',
                    'Gagal terhubung ke server. Silakan coba lagi.'
                );

            } finally {

                setLoading(false);
                scrollToBottom();
                userInput.focus();
            }
        });

        function appendMessage(sender, text) {

            const isAI = sender === 'AI';

            const msgDiv =
                document.createElement('div');


            msgDiv.className = `
                w-full
                flex
                items-end
                gap-3
                ${isAI ? 'justify-start' : 'justify-end'}
            `;

            const avatarDiv =
                document.createElement('div');

            if (isAI) {

                avatarDiv.className = `
                    w-8
                    h-8
                    rounded-full
                    overflow-hidden
                    shrink-0
                    shadow-sm
                `;

                const img =
                    document.createElement('img');


                img.src =
                    "{{ asset('templates/backend/images/user/ai-logo.jpeg') }}";

                img.className = `
                    w-full
                    h-full
                    object-cover
                `;

                img.alt = 'AI';

                avatarDiv.appendChild(img);

            } else {

                avatarDiv.className = `
                    w-8
                    h-8
                    rounded-full
                    bg-primary-500
                    text-white
                    flex
                    items-center
                    justify-center
                    text-xs
                    font-bold
                    shrink-0
                    shadow-sm
                `;

                avatarDiv.textContent = 'AD';
            }

            const messageWrapper =
                document.createElement('div');

            messageWrapper.className = `
                max-w-[75%]
                sm:max-w-[65%]
                ${isAI ? '' : 'flex flex-col items-end'}
            `;

            const contentDiv =
                document.createElement('div');

            contentDiv.className = `

                p-4
                rounded-2xl
                shadow-sm
                text-sm
                leading-relaxed
                break-words
                ${
                    isAI

                    ? `
                        ai-message
                        bg-white
                        dark:bg-themedark-cardbg
                        rounded-tl-none
                        border
                        border-gray-100
                        dark:border-themedark-border
                        text-gray-800
                        dark:text-gray-200
                    `

                    : `
                        bg-primary-500
                        text-white
                        rounded-tr-none
                        whitespace-pre-line
                    `
                }

            `;

            if (isAI) {

                const markdownHtml =
                    marked.parse(text || '', {
                        breaks: true,
                        gfm: true
                    });


                contentDiv.innerHTML =
                    DOMPurify.sanitize(markdownHtml);

            } else {

                contentDiv.textContent =
                    text;

            }


            const labelDiv =
                document.createElement('div');


            labelDiv.className = `

                text-[10px]

                text-gray-400

                mt-1

                ${isAI ? 'ml-1' : 'mr-1'}

            `;


            labelDiv.textContent =
                isAI
                    ? 'SIPAF Intellect AI'
                    : 'Anda';

            messageWrapper.appendChild(contentDiv);

            messageWrapper.appendChild(labelDiv);

            if (isAI) {

                msgDiv.appendChild(avatarDiv);

                msgDiv.appendChild(messageWrapper);

            } else {

                msgDiv.appendChild(messageWrapper);

                msgDiv.appendChild(avatarDiv);

            }

            chatBox.appendChild(msgDiv);

            scrollToBottom();

        }

        function appendLoading() {


            const id =
                'loading-' + Date.now();

            const loadDiv =
                document.createElement('div');

            loadDiv.id = id;

            loadDiv.className = `
                w-full
                flex
                items-end
                gap-3
                justify-start
            `;

            const avatarDiv =
                document.createElement('div');

            avatarDiv.className = `
                w-8
                h-8
                rounded-full
                overflow-hidden
                shrink-0
                shadow-sm
            `;

            const img =
                document.createElement('img');

            img.src =
                "{{ asset('templates/backend/images/user/ai-logo.jpeg') }}";


            img.className = `
                w-full
                h-full
                object-cover
            `;


            img.alt = 'AI';


            avatarDiv.appendChild(img);

            const contentDiv =
                document.createElement('div');

            contentDiv.className = `
                bg-white
                dark:bg-themedark-cardbg
                px-4
                py-3
                rounded-2xl
                rounded-tl-none
                shadow-sm
                border
                border-gray-100
                dark:border-themedark-border
            `;

            contentDiv.innerHTML = `

                <div class="flex items-center gap-1.5">

                    <span
                        class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                        style="animation-delay: 0ms"
                    ></span>

                    <span
                        class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                        style="animation-delay: 150ms"
                    ></span>

                    <span
                        class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"
                        style="animation-delay: 300ms"
                    ></span>

                </div>

            `;

            loadDiv.appendChild(avatarDiv);

            loadDiv.appendChild(contentDiv);

            chatBox.appendChild(loadDiv);


            return id;

        }

        function setLoading(loading) {


            sendButton.disabled = loading;


            if (loading) {


                sendIcon.className = `
                    ti
                    ti-loader-2
                    text-base
                    animate-spin
                `;


                sendText.textContent =
                    'Memproses...';


                sendButton.classList.add(
                    'opacity-70',
                    'cursor-not-allowed'
                );


            } else {


                sendIcon.className = `
                    ti
                    ti-send
                    text-base
                `;


                sendText.textContent =
                    'Kirim';


                sendButton.classList.remove(
                    'opacity-70',
                    'cursor-not-allowed'
                );

            }

        }

        function scrollToBottom() {

            chatBox.scrollTo({

                top: chatBox.scrollHeight,

                behavior: 'smooth'

            });

        }

        userInput.addEventListener(
            'keydown',
            function(e) {

                if (e.key === 'Enter') {

                    e.preventDefault();

                    chatForm.requestSubmit();

                }

            }
        );

        userInput.focus();

    </script>

@endpush
