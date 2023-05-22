<div x-data="readerText()">
    <div id="text" class="text-content">
        {!! $text !!}
    </div>
    <div class="fixed bottom-2 right-2">
        <x-button @click.prevent="play" x-show="!playingAudio"
            class="!rounded-full">
            <x-icon.play />
        </x-button>
        <div x-show="playingAudio" class="flex gap-1">
            <x-secondary-button @click.prevent="pause" x-show="!pauseAudio"
                class="!rounded-full">
                <x-icon.pause />
            </x-secondary-button>
            <x-button @click.prevent="resume" x-show="pauseAudio"
                class="!rounded-full">
                <x-icon.play />
            </x-button>
            <x-danger-button @click.prevent="finish" class="!rounded-full">
                <x-icon.x-mark />
            </x-danger-button>
        </div>
    </div>

    <script>
        function readerText() {
            return {
                text: @entangle('text'),

                user: @entangle('user'),
                chapterId: @entangle('chapterId'),
                initialCharacter: 0,

                synth: window.speechSynthesis,
                speech: new SpeechSynthesisUtterance(),
                textoSinFormato: document.querySelector('#text').innerText,
                charIndex: 0,

                playingAudio: false,
                pauseAudio: false,

                init() {
                    this.getDataFromCookie(`user-${this.user}`);

                    window.addEventListener("beforeunload", () => {
                        this.synth.cancel();

                        if (this.charIndex != 0) {
                            let data = {
                                user: this.user,
                                chapter: this.chapterId,
                                initialCharacter: this.charIndex,
                            };

                            document.cookie =
                                `user-${this.user}=${JSON.stringify(data)}; max-age= ${(60 * 60 * 24 * 7)}; SameSite=Strict`;
                        }
                    });

                    this.speech.addEventListener('boundary', (event) => {
                        if (event.name == 'word') {
                            this.charIndex = this.initialCharacter + event
                                .charIndex;
                        }
                    });

                    this.speech.addEventListener('end', () => {
                        this.finish();
                    })
                },

                play() {
                    this.speech.lang = "es-ES";
                    this.speech.text = this.textoSinFormato
                        .substring(this.initialCharacter);
                    this.speech.rate = 1;

                    this.synth.speak(this.speech);

                    this.playingAudio = true;
                    this.pauseAudio = false;
                },

                pause() {
                    this.synth.pause();

                    this.pauseAudio = true;
                },

                resume() {
                    this.synth.resume();

                    this.pauseAudio = false;
                },

                finish() {
                    this.synth.cancel();

                    this.initialCharacter = 0;
                    this.charIndex = 0;
                    this.deleteCookie(`user-${this.user}`);

                    this.playingAudio = false;
                },

                getCookie(name) {
                    const regex = new RegExp(
                        `(?:(?:^|.*;\\s*)${name}\\s*=\\s*([^;]*).*$)|^.*$`
                    );
                    return document.cookie.replace(regex, "$1");
                },

                deleteCookie(name) {
                    document.cookie =
                        `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC`;
                },

                getDataFromCookie(name) {
                    let cookie = this.getCookie(name);
                    if (cookie) {
                        cookie = JSON.parse(cookie);

                        if (cookie['user'] == this.user &&
                            cookie['chapter'] == this.chapterId) {
                            this.initialCharacter = cookie['initialCharacter'];
                        }
                    }
                },
            }
        }
    </script>
</div>
