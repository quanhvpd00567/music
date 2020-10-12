/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/audio-animation.js":
/*!*****************************************!*\
  !*** ./resources/js/audio-animation.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  window.oncontextmenu = function () {// return false;
  };

  var isPlayed = false;
  urlAudio = urlAudio.replace(/&amp;/g, "&");
  $('#mix-pause').hide();
  $('#mix-mute').hide();
  var $audio = $("#jquery_jplayer_2");
  var audio = new Audio(urlAudio);
  audio.crossOrigin = "anonymous";
  var $element = $('#canvas');
  $audio.jPlayer({
    ready: function ready() {
      $(this).jPlayer("setMedia", {
        mp3: urlAudio
      });
      var $j_0 = $("#jp_audio_0");
      $j_0.attr('crossOrigin', 'anonymous');
    },
    supplied: "mp3",
    useStateClassSkin: true,
    keyEnabled: true,
    timeupdate: function timeupdate(event) {
      audio.currentTime = event.jPlayer.status.currentTime;
    },
    ended: function ended(event) {
      $element.removeClass('addAnimation');
      $('#mix-play').show();
      $('#mix-pause').hide();
    }
  });
  $('#mix-play').on('click', function () {
    $audio.jPlayer('play');
    audio.play();
    start(audio);
    $element.addClass('addAnimation');
    $(this).hide();
    isPlayed = true;
    $('#mix-pause').show();
  });
  $('#mix-pause').on('click', function () {
    $audio.jPlayer('pause');
    $(this).hide();
    audio.pause();
    isPlayed = false;
    $('#mix-play').show();
    $element.removeClass('addAnimation');
  });
  $('#mix-unmute').on('click', function () {
    $audio.jPlayer('mute', true);
    $(this).hide();
    audio.muted = true;
    $('#mix-mute').show();
  });
  $('#mix-mute').on('click', function () {
    $audio.jPlayer('mute', false);
    $(this).hide();
    audio.muted = false;
    $('#mix-unmute').show();
  });
  $(document).keypress(function (event) {
    var keyCode = event.keyCode;

    if (keyCode === 32) {
      if (isPlayed) {
        $audio.jPlayer('pause');
        audio.pause();
        $element.removeClass('addAnimation');
        $('#mix-pause').hide();
        $('#mix-play').show();
      } else {
        $audio.jPlayer('play');
        audio.play(); // audio.muted = true

        start(audio);
        $element.addClass('addAnimation');
        $('#mix-pause').show();
        $('#mix-play').hide();
      }

      isPlayed = !isPlayed;
    }
  });
});
window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;

function start(audio) {
  try {
    // loop
    var renderFrame = function renderFrame() {
      var array = new Uint8Array(analyser.frequencyBinCount);
      analyser.getByteFrequencyData(array);
      var step = Math.round(array.length / meterNum);
      ctx.clearRect(0, 0, cwidth, cheight);

      for (var i = 0; i < meterNum; i++) {
        var value = array[i * step];

        if (capYPositionArray.length < Math.round(meterNum)) {
          capYPositionArray.push(value);
        }

        ctx.fillStyle = capStyle;

        if (value < capYPositionArray[i]) {
          ctx.fillRect(i * 25, cheight - --capYPositionArray[i], meterWidth, capHeight);
        } else {
          ctx.fillRect(i * 25, cheight - value, meterWidth, capHeight);
          capYPositionArray[i] = value;
        }

        ctx.fillStyle = gradient;
        ctx.fillRect(i * 25, cheight - value + capHeight, meterWidth, cheight);
        ctx.font = '28px serif';
        ctx.fillStyle = 'red';
        ctx.fillText('vietmix.vn', cwidth / 2 - 40, 50);
      }

      requestAnimationFrame(renderFrame);
    };

    var ctx = new AudioContext();
    var analyser = ctx.createAnalyser();
    var audioSrc = ctx.createMediaElementSource(audio);
    audioSrc.connect(analyser);
    analyser.connect(ctx.destination);
    var canvas = document.getElementById('canvas');
    var cwidth = canvas.width;
    var cheight = canvas.height;
    var meterWidth = 15;
    var capHeight = 1;
    var capStyle = '#AD1717';
    var meterNum = 800 / (10 + 1);
    var capYPositionArray = [];
    ctx = canvas.getContext('2d');
    var gradient = ctx.createLinearGradient(200, 100, 300, 500);
    gradient.addColorStop(1, '#fff');
    gradient.addColorStop(0.5, '#fff');
    gradient.addColorStop(0, '#fff');
    renderFrame();
  } catch (e) {}
}

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/audio-animation.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/macos/MyProject/php/music_all/resources/js/audio-animation.js */"./resources/js/audio-animation.js");


/***/ })

/******/ });