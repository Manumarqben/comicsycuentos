<div x-data="readerText()">
    <div id="text" class="text-justify">
        {!! $text !!}
    </div>
    <div @click.prevent="play">
        Habla
    </div>
    <div @click.prevent="pause">
        Pausa
    </div>
    <div @click.prevent="resume">
        Continuar
    </div>

    <script>
        function readerText() {
            return {
                text: @entangle('text'),

                user: @entangle('user'),
                chapterId: @entangle('chapterId'),
                initialCharacter: 0,

                speech: new SpeechSynthesisUtterance(),
                textoSinFormato: document.querySelector('#text').innerText,
                charIndex: 0,

                init() {
                    // TODO: obtener la cookie

                    window.addEventListener("beforeunload", () => {
                        if (this.initialCharacter < this.charIndex) {
                            let data = {
                                chapter: this.chapterId,
                                initialCharacter: this.charIndex,
                            };
                            document.cookie = "user-" + this.user + "=" +
                                JSON.stringify(data) + "; SameSite=Strict";
                        }
                    });

                    this.speech.addEventListener('boundary', (event) => {
                        if (event.name == 'word') {
                            this.charIndex = this.initialCharacter + event
                                .charIndex;
                        }
                    });

                    this.speech.addEventListener('end', function(event) {

                    })
                },

                play() {
                    localStorage.user = this.user;
                    localStorage.chapterId = this.chapterId;

                    this.speech.lang = "es-ES";
                    this.speech.text = this.textoSinFormato;
                    this.speech.rate = 1;

                    window.speechSynthesis.speak(this.speech);
                },

                pause() {
                    window.speechSynthesis.pause();
                },

                resume() {
                    window.speechSynthesis.resume();
                },
            }
        }
    </script>
</div>
