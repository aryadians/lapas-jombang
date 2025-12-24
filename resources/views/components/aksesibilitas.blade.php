@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/opendyslexic@latest/open-dyslexic.min.css">
{{-- Hapus Font Awesome jika di layout utama sudah ada, tapi biarkan untuk jaga-jaga --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="//unpkg.com/alpinejs" defer></script>
@endonce

<script>
    window.accessibilityWidget = function() {
        return {
            open: false,
            textSize: 100,
            isGrayscale: false,
            isDyslexia: false,
            isCursorBig: false,
            volume: 1,
            isSpeaking: false,
            synth: window.speechSynthesis,
            utterance: null,

            initWidget() {
                const saved = JSON.parse(localStorage.getItem('acc_settings'));
                if (saved) {
                    this.textSize = saved.textSize || 100;
                    this.isGrayscale = saved.isGrayscale || false;
                    this.isDyslexia = saved.isDyslexia || false;
                    this.isCursorBig = saved.isCursorBig || false;
                }
                this.applyStyles();
            },
            saveSettings() {
                localStorage.setItem('acc_settings', JSON.stringify({
                    textSize: this.textSize,
                    isGrayscale: this.isGrayscale,
                    isDyslexia: this.isDyslexia,
                    isCursorBig: this.isCursorBig
                }));
            },
            applyStyles() {
                const html = document.documentElement;
                const body = document.body;
                html.style.fontSize = this.textSize + '%';
                html.style.filter = this.isGrayscale ? 'grayscale(100%)' : 'none';

                if (this.isDyslexia) {
                    body.setAttribute('style', (body.getAttribute('style') || '') + '; font-family: "OpenDyslexic", sans-serif !important;');
                } else {
                    if (body.getAttribute('style') && body.getAttribute('style').includes('OpenDyslexic')) {
                        let newStyle = body.getAttribute('style').replace('; font-family: "OpenDyslexic", sans-serif !important;', '');
                        body.setAttribute('style', newStyle);
                    }
                }

                const cursorStyleId = 'acc-cursor-style';
                let cursorStyle = document.getElementById(cursorStyleId);
                if (this.isCursorBig) {
                    if (!cursorStyle) {
                        cursorStyle = document.createElement('style');
                        cursorStyle.id = cursorStyleId;
                        cursorStyle.innerHTML = `body, a, button, input { cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="%23EAB308" stroke="%23000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3l7.07 16.97 2.51-7.39 7.39-2.51L3 3z"/><path d="M13 13l6 6"/></svg>'), auto !important; }`;
                        document.head.appendChild(cursorStyle);
                    }
                } else {
                    if (cursorStyle) cursorStyle.remove();
                }
                this.saveSettings();
            },
            changeSize(amount) {
                this.textSize = Math.min(Math.max(this.textSize + amount, 80), 150);
                this.applyStyles();
            },
            toggleGrayscale() {
                this.isGrayscale = !this.isGrayscale;
                this.applyStyles();
            },
            toggleDyslexia() {
                this.isDyslexia = !this.isDyslexia;
                this.applyStyles();
            },
            toggleCursor() {
                this.isCursorBig = !this.isCursorBig;
                this.applyStyles();
            },
            resetAll() {
                this.textSize = 100;
                this.isGrayscale = false;
                this.isDyslexia = false;
                this.isCursorBig = false;
                this.stop();
                this.applyStyles();
            },
            speak() {
                this.stop();
                let text = window.getSelection().toString() || (document.querySelector('main') || document.body).innerText;
                if (text) {
                    this.utterance = new SpeechSynthesisUtterance(text);
                    this.utterance.lang = 'id-ID';
                    this.utterance.volume = this.volume;
                    this.utterance.onstart = () => {
                        this.isSpeaking = true;
                    };
                    this.utterance.onend = () => {
                        this.isSpeaking = false;
                    };
                    this.synth.speak(this.utterance);
                }
            },
            stop() {
                if (this.synth.speaking) {
                    this.synth.cancel();
                    this.isSpeaking = false;
                }
            },
            updateVolume() {
                if (this.isSpeaking) {
                    this.stop();
                    this.speak();
                }
            }
        }
    }
</script>

<div x-data="accessibilityWidget()" x-init="initWidget()" class="fixed bottom-6 left-6 z-[99999] print:hidden font-sans text-gray-800">
    <button @click="open = !open" :class="open ? 'bg-yellow-500 text-gray-900 rotate-90' : 'bg-gray-900 text-yellow-500'" class="p-3 rounded-full shadow-2xl border-4 border-yellow-500 transition-all duration-300 hover:scale-110 focus:outline-none w-14 h-14 flex items-center justify-center">
        <i class="fas fa-universal-access text-2xl"></i>
    </button>

    <div x-show="open" @click.outside="open = false" x-transition class="absolute bottom-20 left-0 w-[300px] bg-gray-900 rounded-xl shadow-2xl border border-gray-700 overflow-hidden text-white" style="display: none;">
        <div class="bg-gray-800 p-3 flex justify-between items-center border-b border-gray-700">
            <h3 class="font-bold text-sm uppercase"><i class="fas fa-universal-access text-yellow-500"></i> Aksesibilitas</h3>
            <button @click="open = false" class="text-gray-400 hover:text-white"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-4 space-y-4 max-h-[60vh] overflow-y-auto">
            <div class="bg-gray-800 p-2 rounded">
                <div class="flex gap-2 mb-2">
                    <button @click="speak" class="flex-1 bg-green-700 py-1 rounded text-xs">Mulai</button>
                    <button @click="stop" class="flex-1 bg-red-700 py-1 rounded text-xs">Stop</button>
                </div>
                <input type="range" min="0" max="1" step="0.1" x-model="volume" @input="updateVolume" class="w-full h-1 accent-yellow-500">
            </div>
            <div class="flex justify-between items-center bg-gray-800 p-2 rounded">
                <button @click="changeSize(-10)" class="px-3 bg-gray-700 rounded">-</button>
                <span x-text="textSize + '%'" class="text-yellow-500 font-bold"></span>
                <button @click="changeSize(10)" class="px-3 bg-gray-700 rounded">+</button>
            </div>
            <button @click="toggleGrayscale" class="w-full text-left p-2 bg-gray-800 rounded text-sm flex justify-between">
                <span>Hitam Putih</span>
                <div :class="isGrayscale ? 'bg-yellow-500' : 'bg-gray-600'" class="w-8 h-4 rounded-full relative">
                    <div class="w-4 h-4 bg-white rounded-full shadow absolute transition-all" :style="isGrayscale ? 'right:0' : 'left:0'"></div>
                </div>
            </button>
            <button @click="toggleDyslexia" class="w-full text-left p-2 bg-gray-800 rounded text-sm flex justify-between">
                <span>Font Disleksia</span>
                <div :class="isDyslexia ? 'bg-yellow-500' : 'bg-gray-600'" class="w-8 h-4 rounded-full relative">
                    <div class="w-4 h-4 bg-white rounded-full shadow absolute transition-all" :style="isDyslexia ? 'right:0' : 'left:0'"></div>
                </div>
            </button>
            <button @click="toggleCursor" class="w-full text-left p-2 bg-gray-800 rounded text-sm flex justify-between">
                <span>Kursor Besar</span>
                <div :class="isCursorBig ? 'bg-yellow-500' : 'bg-gray-600'" class="w-8 h-4 rounded-full relative">
                    <div class="w-4 h-4 bg-white rounded-full shadow absolute transition-all" :style="isCursorBig ? 'right:0' : 'left:0'"></div>
                </div>
            </button>
            <button @click="resetAll" class="w-full py-2 text-xs text-red-400 border border-red-900 rounded">Reset</button>
        </div>
    </div>
</div>