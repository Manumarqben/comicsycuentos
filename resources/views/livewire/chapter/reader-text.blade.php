<div x-data="readerText()">
    @empty($text)
        {{ __('The chapter still has no content') }}
    @else
        <div class="flex flex-row justify-center pb-2 w-full"
            x-bind:class="playingAudio ? 'sticky top-16' : ''">
            <div class="flex gap-3 border border-gray-800 dark:border-gray-300 bg-gray-500 bg-opacity-95 rounded-full py-2 px-2"
                x-show="!playingAudio" x-transition:enter.duration.200ms>
                <x-button @click.prevent="play" class="!rounded-full aspect-square">
                    <x-icon.play />
                </x-button>
            </div>
            <div x-show="playingAudio"
                class="flex gap-3 border border-gray-800 dark:border-gray-300 bg-gray-500 bg-opacity-95 rounded-full py-2 px-2"
                x-transition:enter.duration.200ms>
                <div x-show="!pauseAudio" x-transition:enter.duration.100ms>
                    <x-secondary-button @click.prevent="pause"
                        class="!rounded-full aspect-square">
                        <x-icon.pause />
                    </x-secondary-button>
                </div>
                <div x-show="pauseAudio" x-transition:enter.duration.100ms>
                    <x-button @click.prevent="resume"
                        class="!rounded-full aspect-square">
                        <x-icon.play />
                    </x-button>
                </div>
                <x-danger-button @click.prevent="finish"
                    class="!rounded-full aspect-square">
                    <x-icon.x-mark />
                </x-danger-button>
            </div>

        </div>
        <div id="text" class="text-content">
            <div>
                {!! $text !!}
            </div>
        </div>
    @endempty

    <script>
        function readerText() {
            return {
                text: @entangle('text'),

                user: @entangle('user'),
                chapterId: @entangle('chapterId'),
                initialCharacter: -20,

                synth: window.speechSynthesis,
                speech: new SpeechSynthesisUtterance(),
                textoSinFormato: document.querySelector('#text').innerText,
                charIndex: 0,

                playingAudio: false,
                pauseAudio: false,

                init() {
                    this.getDataFromCookie(`user-${this.user}`);

                    window.addEventListener("beforeunload", () => {
                        this.speech.removeEventListener('end', this.finish);

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

                    this.speech.addEventListener('end', this.finish);

                    document.addEventListener("keydown", (event) => {
                        if (event.code === "Space") {
                            event.preventDefault();
                            if (this.playingAudio) {
                                if (this.pauseAudio) {
                                    this.resume();
                                } else {
                                    this.pause();
                                }
                            } else {
                                this.play();
                            }
                        }
                    });
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
                        `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; SameSite=Strict`;
                },

                getDataFromCookie(name) {
                    let cookie = this.getCookie(name);
                    if (cookie) {
                        cookie = JSON.parse(cookie);

                        if (cookie['user'] == this.user &&
                            cookie['chapter'] == this.chapterId) {
                            this.initialCharacter += cookie['initialCharacter'];
                        }
                    }
                },
            }
        }
    </script>
</div>
