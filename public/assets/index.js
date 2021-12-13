"use strict";
(self["webpackChunkkrylasova_ru"] = self["webpackChunkkrylasova_ru"] || []).push([[826],{

/***/ 506:
/***/ ((__unused_webpack_module, __unused_webpack___webpack_exports__, __webpack_require__) => {

/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(755);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var bootstrap_dist_js_bootstrap_bundle_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(577);
/* harmony import */ var bootstrap_dist_js_bootstrap_bundle_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(bootstrap_dist_js_bootstrap_bundle_js__WEBPACK_IMPORTED_MODULE_1__);






jquery__WEBPACK_IMPORTED_MODULE_0___default()(function () {
  var $window = jquery__WEBPACK_IMPORTED_MODULE_0___default()(window),
      $navbar = jquery__WEBPACK_IMPORTED_MODULE_0___default()('header.page-header .navbar');
  $navbar.css('transition', 'box-shadow 0.2s ease-in');
  $window.on('scroll', function () {
    if ($window.scrollTop() > 0) {
      $navbar.css('box-shadow', '0 .125rem .7rem rgba(0,0,0,.075)');
    } else {
      $navbar.css('box-shadow', '0 .0rem .0rem rgba(0,0,0,0)');
    }
  });

  var TxtRotate = function TxtRotate(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.isDeleting = false;
    this.tick();
  };

  TxtRotate.prototype.tick = function () {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
      this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
      this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';
    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) {
      delta /= 4;
    }

    if (!this.isDeleting && this.txt === fullTxt) {
      delta = this.period;
      this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
      this.isDeleting = false;
      this.loopNum++;
      delta = 700;
    }

    setTimeout(function () {
      that.tick();
    }, delta);
  };

  var elements = document.getElementsByClassName('txt-rotate');

  for (var i = 0; i < elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');

    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  } // INJECT CSS


  var css = document.createElement("style");
  css.innerHTML = "\n        .typed-cursor {\n            opacity: 1;\n        }\n        .typed-cursor.typed-cursor-blink {\n            animation: typedjsBlink 0.7s infinite;\n            -webkit-animation: typedjsBlink 0.7s infinite;\n            animation: typedjsBlink 0.7s infinite;\n        }\n        @keyframes typedjsBlink{\n            50% { opacity: 0.0; }\n        }\n        @-webkit-keyframes typedjsBlink{\n            0% { opacity: 1; }\n            50% { opacity: 0.0; }\n            100% { opacity: 1; }\n        }\n    ";
  document.body.appendChild(css);

  (function () {
    var Animation = function Animation(id, period) {
      this.id = id || 'animation';
      this.period = parseInt(period, 10) || 2000;
      this.$root = document.getElementById(this.id);

      if (!this.$root) {
        return;
      }

      this.$slides = this.$root.querySelectorAll('[data-animation-slide]');

      if (!this.$slides) {
        return;
      }

      this.currentSlide = 1;
      this.go();
    };

    Animation.prototype.getCurrentSlide = function () {
      return this.$slides[this.currentSlide - 1];
    };

    Animation.prototype.nextSlide = function () {
      if (++this.currentSlide > this.$slides.length) {
        this.currentSlide = 1;
      }
    };

    Animation.prototype.go = function () {
      var currentSlide = this.getCurrentSlide();
      currentSlide.style.opacity = '1';
      var that = this;
      setTimeout(function () {
        currentSlide.style.opacity = '0';
        that.nextSlide();
        that.go();
      }, this.period);
    };

    new Animation();
  })();
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, [216], () => (__webpack_exec__(506)));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);