@extends('layouts.admin', ['title' => 'AI Asisten - SIPAF'])

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="flex items-center justify-between flex-wrap gap-4 py-3">
            <div class="page-header-title">
                <h2 class="mb-0 text-xl font-bold text-gray-800 dark:text-white">AI Asisten Akademik</h2>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="grid grid-cols-12">
    <div class="col-span-12">
        <div class="card border-0 shadow-sm rounded-xl overflow-hidden h-[calc(100vh-200px)] flex flex-col">

            <!-- Chat Header -->
            <div class="card-header px-6 py-4 bg-white dark:bg-themedark-cardbg border-b border-gray-200 dark:border-themedark-border flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary-500/10 text-primary-500 flex items-center justify-center font-bold">
                        AI
                    </div>
                    <div>
                        <h5 class="mb-0 font-semibold text-gray-800 dark:text-white">SIPAF Intellect AI</h5>
                        <span class="text-xs text-success-500 flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-success-500 inline-block animate-pulse"></span> Online & Siap Membantu
                        </span>
                    </div>
                </div>
            </div>

            <!-- Chat Body / Box -->
            <div id="chat-box" class="card-body grow p-6 overflow-y-auto space-y-4 bg-gray-50/60 dark:bg-themedark-bodybg">
                <!-- Pesan Awal AI -->
                <div class="flex gap-3 max-w-[85%] sm:max-w-[75%]">
                    <div class="w-8 h-8 rounded-full bg-primary-500 text-white flex items-center justify-center text-xs shrink-0 font-bold shadow-sm">AI</div>
                    <div class="bg-white dark:bg-themedark-cardbg p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 dark:border-themedark-border text-sm text-gray-800 dark:text-gray-200 whitespace-pre-line leading-relaxed">
                        Halo Admin SIPAF! Ada masalah pengaduan mahasiswa yang perlu saya analisis atau bantu carikan solusi/draft balasannya? Silakan ketik di bawah.
                    </div>
                </div>
            </div>

            <!-- Chat Footer / Input Form -->
            <div class="card-footer p-4 bg-white dark:bg-themedark-cardbg border-t border-gray-200 dark:border-themedark-border">
                <form id="chat-form" class="flex gap-3 items-center">
                    @csrf
                    <div class="relative grow">
                        <input type="text" id="user-input" autocomplete="off" class="form-control w-full rounded-xl border-gray-300 dark:bg-themedark-inputbg dark:border-themedark-border placeholder-gray-400 text-sm py-3 pl-4 pr-10" placeholder="Tulis pengaduan atau pertanyaan di sini...">
                    </div>
                    <button type="submit" class="btn btn-primary px-5 py-3 rounded-xl transition-all font-medium text-sm flex items-center gap-2 shadow-sm shrink-0">
                        <i class="ti ti-send text-base"></i> Kirim
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection

@push('scripts')
<script>
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const chatBox = document.getElementById('chat-box');

    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const pesanText = userInput.value.trim();
        if (!pesanText) return;

        appendMessage('User', pesanText);
        userInput.value = '';

        const loadingId = appendLoading();
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
            const response = await fetch("{{ route('admin.ai-asisten.tanya') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ pesan: pesanText })
            });

            const data = await response.json();
            document.getElementById(loadingId).remove();

            if (data.status === 'success') {
                appendMessage('AI', data.jawaban);
            } else {
                appendMessage('AI', 'Maaf, terjadi kesalahan sistem.');
            }
        } catch (error) {
            document.getElementById(loadingId).remove();
            appendMessage('AI', 'Gagal terhubung ke server.');
        }

        chatBox.scrollTop = chatBox.scrollHeight;
    });

    function appendMessage(sender, text) {
        const isAI = sender === 'AI';
        const msgDiv = document.createElement('div');
        msgDiv.className = `flex gap-3 max-w-[85%] sm:max-w-[75%] ${!isAI ? 'ml-auto flex-row-reverse' : ''}`;

        const avatarDiv = document.createElement('div');
        avatarDiv.className = `w-8 h-8 rounded-full ${isAI ? 'bg-primary-500 text-white' : 'bg-gray-700 text-white'} flex items-center justify-center text-xs shrink-0 font-bold shadow-sm`;
        avatarDiv.textContent = isAI ? 'AI' : 'AD';

        const contentDiv = document.createElement('div');
        contentDiv.className = `${isAI ? 'bg-white dark:bg-themedark-cardbg rounded-tl-none border border-gray-100 dark:border-themedark-border text-gray-800 dark:text-gray-200' : 'bg-primary-500 text-white rounded-tr-none'} p-4 rounded-2xl shadow-sm text-sm whitespace-pre-line leading-relaxed`;

        contentDiv.textContent = text;

        msgDiv.appendChild(avatarDiv);
        msgDiv.appendChild(contentDiv);
        chatBox.appendChild(msgDiv);
    }

    function appendLoading() {
        const id = 'loading-' + Date.now();
        const loadDiv = document.createElement('div');
        loadDiv.id = id;
        loadDiv.className = 'flex gap-3 max-w-[85%] sm:max-w-[75%]';

        const avatarDiv = document.createElement('div');
        avatarDiv.className = 'w-8 h-8 rounded-full bg-primary-500 text-white flex items-center justify-center text-xs shrink-0 font-bold shadow-sm';
        avatarDiv.textContent = 'AI';

        const contentDiv = document.createElement('div');
        contentDiv.className = 'bg-white dark:bg-themedark-cardbg p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 dark:border-themedark-border text-sm text-gray-400 animate-pulse';
        contentDiv.textContent = 'Sedang memikirkan solusi...';

        loadDiv.appendChild(avatarDiv);
        loadDiv.appendChild(contentDiv);
        chatBox.appendChild(loadDiv);

        return id;
    }
</script>
@endpush
