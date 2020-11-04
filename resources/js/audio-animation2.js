let eAudio = document.getElementById("audio_xx");
let $element = $('#canvas')
let isPlayed = false
eAudio.onplay = function() {
    start(eAudio)
    // $element.addClass('addAnimation')
    isPlayed = true
};
eAudio.onpause = function () {
    // $element.removeClass('addAnimation')
    isPlayed = false
}


eAudio.addEventListener('volumechange',function(e){
    if(this.muted) {
        // $element.removeClass('addAnimation')
    }
}, false);

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
                // ctx.fillText('vietmix.vn', cwidth/2 - 40, 50);
            }

            requestAnimationFrame(renderFrame);
        }

        renderFrame();
    } catch (e) {

    }
}

$(document).keypress(function (event) {
    let keyCode = event.keyCode
    if (keyCode === 32) {
        if (isPlayed) {
            eAudio.pause()
        }else{
            eAudio.play()
        }
        isPlayed = !isPlayed
    }
})
