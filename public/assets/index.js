"use strict";(self.webpackChunkkrylasova_ru=self.webpackChunkkrylasova_ru||[]).push([[826],{506:(t,i,e)=>{var s=e(755),n=e.n(s);n()((function(){var t=n()(window),i=n()("header.page-header .navbar");i.css("transition","box-shadow 0.2s ease-in"),t.on("scroll",(function(){t.scrollTop()>0?i.css("box-shadow","0 .125rem .7rem rgba(0,0,0,.075)"):i.css("box-shadow","0 .0rem .0rem rgba(0,0,0,0)")}));var e=function(t,i,e){this.toRotate=i,this.el=t,this.loopNum=0,this.period=parseInt(e,10)||2e3,this.txt="",this.isDeleting=!1,this.tick()};e.prototype.tick=function(){var t=this.loopNum%this.toRotate.length,i=this.toRotate[t];this.isDeleting?this.txt=i.substring(0,this.txt.length-1):this.txt=i.substring(0,this.txt.length+1),this.el.innerHTML='<span class="wrap">'+this.txt+"</span>";var e=this,s=200-100*Math.random();this.isDeleting&&(s/=4),this.isDeleting||this.txt!==i?this.isDeleting&&""===this.txt&&(this.isDeleting=!1,this.loopNum++,s=700):(s=this.period,this.isDeleting=!0),setTimeout((function(){e.tick()}),s)};for(var s=document.getElementsByClassName("txt-rotate"),o=0;o<s.length;o++){var r=s[o].getAttribute("data-rotate"),a=s[o].getAttribute("data-period");r&&new e(s[o],JSON.parse(r),a)}var h,l=document.createElement("style");l.innerHTML="\n        .typed-cursor {\n            opacity: 1;\n        }\n        .typed-cursor.typed-cursor-blink {\n            animation: typedjsBlink 0.7s infinite;\n            -webkit-animation: typedjsBlink 0.7s infinite;\n            animation: typedjsBlink 0.7s infinite;\n        }\n        @keyframes typedjsBlink{\n            50% { opacity: 0.0; }\n        }\n        @-webkit-keyframes typedjsBlink{\n            0% { opacity: 1; }\n            50% { opacity: 0.0; }\n            100% { opacity: 1; }\n        }\n    ",document.body.appendChild(l),h=function(t,i){this.id=t||"animation",this.period=parseInt(i,10)||2e3,this.$root=document.getElementById(this.id),this.$root&&(this.$slides=this.$root.querySelectorAll("[data-animation-slide]"),this.$slides&&(this.currentSlide=1,this.go()))},h.prototype.getCurrentSlide=function(){return this.$slides[this.currentSlide-1]},h.prototype.nextSlide=function(){++this.currentSlide>this.$slides.length&&(this.currentSlide=1)},h.prototype.go=function(){var t=this.getCurrentSlide();t.style.opacity="1";var i=this;setTimeout((function(){t.style.opacity="0",i.nextSlide(),i.go()}),this.period)},new h}))}},t=>{t.O(0,[216],(()=>(506,t(t.s=506)))),t.O()}]);