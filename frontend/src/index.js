import "./style.css"
import $ from "jquery";

$(function () {
    const $window = $(window), $navbar = $('header.page-header .navbar');
    $navbar.css('transition', 'box-shadow 0.2s ease-in');

    $window.on('scroll', function () {
        if ($window.scrollTop() > 0) {
            $navbar.css('box-shadow', '0 .125rem .7rem rgba(0,0,0,.075)');
        } else {
            $navbar.css('box-shadow', '0 .0rem .0rem rgba(0,0,0,0)');
        }
    });

    const TxtRotate = function (el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.isDeleting = false;
        this.tick();
    };

    TxtRotate.prototype.tick = function () {
        const i = this.loopNum % this.toRotate.length;
        const fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

        const that = this;
        let delta = 200 - Math.random() * 100;

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

    const elements = document.getElementsByClassName('txt-rotate');
    for (let i = 0; i < elements.length; i++) {
        const toRotate = elements[i].getAttribute('data-rotate');
        const period = elements[i].getAttribute('data-period');
        if (toRotate) {
            new TxtRotate(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    const css = document.createElement("style");
    css.innerHTML = `
        .typed-cursor {
            opacity: 1;
        }
        .typed-cursor.typed-cursor-blink {
            animation: typedjsBlink 0.7s infinite;
            -webkit-animation: typedjsBlink 0.7s infinite;
            animation: typedjsBlink 0.7s infinite;
        }
        @keyframes typedjsBlink{
            50% { opacity: 0.0; }
        }
        @-webkit-keyframes typedjsBlink{
            0% { opacity: 1; }
            50% { opacity: 0.0; }
            100% { opacity: 1; }
        }
    `;
    document.body.appendChild(css);

    (function () {
        const Animation = function (id, period) {
            this.id = id || 'animation'
            this.period = parseInt(period, 10) || 2000

            this.$root = document.getElementById(this.id)
            if (!this.$root) {
                return
            }

            this.$slides = this.$root.querySelectorAll('[data-animation-slide]')
            if (!this.$slides) {
                return
            }

            this.currentSlide = 1;
            this.go();

        }

        Animation.prototype.getCurrentSlide = function () {
            return this.$slides[this.currentSlide - 1];
        }

        Animation.prototype.nextSlide = function () {
            if (++this.currentSlide > this.$slides.length) {
                this.currentSlide = 1;
            }
        }

        Animation.prototype.go = function () {
            const currentSlide = this.getCurrentSlide();
            currentSlide.style.opacity = '1'

            const that = this;
            setTimeout(function () {
                currentSlide.style.opacity = '0';
                that.nextSlide();
                that.go();
            }, this.period);
        }

        new Animation();
    })()
})
