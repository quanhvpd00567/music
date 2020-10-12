$(document).ready(function () {

    window.oncontextmenu = function ()
    {
        // return false;
    }

    let isPlayed = false;
    urlAudio = urlAudio.replace(/&amp;/g, "&");
    $('#mix-pause').hide();
    $('#mix-mute').hide();

    let $audio = $("#jquery_jplayer_2");

    let audio = new Audio(urlAudio);
    audio.crossOrigin = "anonymous";
    let $element = $('#canvas')


    $audio.jPlayer({
        ready: function () {
            $(this).jPlayer("setMedia", {
                mp3: urlAudio
            });
            let $j_0 = $("#jp_audio_0");
            $j_0.attr('crossOrigin', 'anonymous')
        },
        supplied: "mp3",
        useStateClassSkin: true,
        keyEnabled: true,
        timeupdate: function(event) {
            audio.currentTime = event.jPlayer.status.currentTime
        },
        ended: function (event) {
            $element.removeClass('addAnimation')
            $('#mix-play').show();
            $('#mix-pause').hide();
        }
    });


    $('#mix-play').on('click', function () {
        $audio.jPlayer('play')
        audio.play()
        start(audio)
        $element.addClass('addAnimation')
        $(this).hide()
        isPlayed = true
        $('#mix-pause').show();
    })

    $('#mix-pause').on('click', function () {
        $audio.jPlayer('pause')
        $(this).hide()
        audio.pause()
        isPlayed = false
        $('#mix-play').show();
        $element.removeClass('addAnimation')
    })

    $('#mix-unmute').on('click', function () {
        $audio.jPlayer('mute', true)
        $(this).hide()
        audio.muted = true

        $('#mix-mute').show();
    })

    $('#mix-mute').on('click', function () {
        $audio.jPlayer('mute', false)
        $(this).hide()
        audio.muted = false
        $('#mix-unmute').show();
    })

    $(document).keypress(function (event) {
        let keyCode = event.keyCode
        if (keyCode === 32) {
            if (isPlayed) {
                $audio.jPlayer('pause')
                audio.pause()
                $element.removeClass('addAnimation')
                $('#mix-pause').hide()
                $('#mix-play').show()
            }else{
                $audio.jPlayer('play')
                audio.play()
                // audio.muted = true
                start(audio)
                $element.addClass('addAnimation')
                $('#mix-pause').show()
                $('#mix-play').hide()
            }
            isPlayed = !isPlayed
        }
    })
});

window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;

function start (audio) {
    try  {
        let ctx = new AudioContext();
        let analyser = ctx.createAnalyser();
        let audioSrc = ctx.createMediaElementSource(audio);
        audioSrc.connect(analyser);
        analyser.connect(ctx.destination);
        let canvas = document.getElementById('canvas')

        let cwidth = canvas.width
        let cheight = canvas.height
        let meterWidth = 15
        let capHeight = 1
        let capStyle = '#AD1717'
        let meterNum = 800 / (10 + 1)
        let capYPositionArray = []
        ctx = canvas.getContext('2d')

        let gradient = ctx.createLinearGradient(200, 100, 300, 500);
        gradient.addColorStop(1, '#fff');
        gradient.addColorStop(0.5, '#fff');
        gradient.addColorStop(0, '#fff');

        // loop
        function renderFrame() {
            let array = new Uint8Array(analyser.frequencyBinCount);
            analyser.getByteFrequencyData(array);
            let step = Math.round(array.length / meterNum)
            ctx.clearRect(0, 0, cwidth, cheight);

            for (let i = 0; i < meterNum; i++) {
                let value = array[i * step] ;
                if (capYPositionArray.length < Math.round(meterNum)) {
                    capYPositionArray.push(value);
                }
                ctx.fillStyle = capStyle;

                if (value < capYPositionArray[i]) {
                    ctx.fillRect(i * 25, cheight - (--capYPositionArray[i]), meterWidth, capHeight);
                } else {
                    ctx.fillRect(i * 25, cheight - value, meterWidth, capHeight);
                    capYPositionArray[i] = value;
                }
                ctx.fillStyle = gradient;

                ctx.fillRect(i * 25, cheight - value + capHeight, meterWidth, cheight)

                ctx.font = '28px serif';
                ctx.fillStyle = 'red'
                ctx.fillText('vietmix.vn', cwidth/2 - 40, 50);
            }

            requestAnimationFrame(renderFrame);
        }

        renderFrame();
    } catch (e) {

    }
}
