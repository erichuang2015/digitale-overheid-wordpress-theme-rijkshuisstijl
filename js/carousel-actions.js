//
// Rijkshuisstijl (Digitale Overheid) - carousel-actions.js
// ----------------------------------------------------------------------------------
// Actions for slider
// ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 0.8.39
// * @desc.   Toegankelijkheidscheck - slideshow
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl

/*
  * Focusin/out event polyfill (for Firefox) by nuxodin
  * Source: https://gist.github.com/nuxodin/9250e56a3ce6c0446efa
*/

!function(){
  var w = window,
  d = w.document;

  function addPolyfill(e){
    var type = e.type === 'focus' ? 'focusin' : 'focusout';
    var event = new CustomEvent(type, { bubbles:true, cancelable:false });
    event.c1Generated = true;
    e.target.dispatchEvent( event );
  }
  function removePolyfill(e){
    if(!e.c1Generated){ // focus after focusin, so chrome will the first time trigger tow times focusin
      d.removeEventListener('focus' ,addPolyfill ,true);
      d.removeEventListener('blur' ,addPolyfill ,true);
      d.removeEventListener('focusin' ,removePolyfill ,true);
      d.removeEventListener('focusout' ,removePolyfill ,true);
    }
    setTimeout(function(){
      d.removeEventListener('focusin' ,removePolyfill ,true);
      d.removeEventListener('focusout' ,removePolyfill ,true);
    });
  }

  if( w.onfocusin === undefined ){
    d.addEventListener('focus' ,addPolyfill ,true);
    d.addEventListener('blur' ,addPolyfill ,true);
    d.addEventListener('focusin' ,removePolyfill ,true);
    d.addEventListener('focusout' ,removePolyfill ,true);
  }
  
}();

/* Carousel by Eric Eggert for W3C */
var myCarousel = (function() {

  "use strict";

  // Some variables for the instance of the carousel
  var carousel,
  slides,
  index,
  slidenav,
  settings,
  timer,
  setFocus,
  animationSuspended,
  announceSlide = 'false';

  // Helper function for removing classes
  function removeClass(el, className) {
    if (el.classList) {
      el.classList.remove(className);
    } else {
      el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
    }
  }

  // Helper function for detecting if an element has a class
  function hasClass(el, className) {
    if (el.classList) {
      return el.classList.contains(className);
    } else {
      return new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
    }
  }
  
  // Helper function for prepending instead of appending
  function prependElement(parent, child) {
    parent.insertBefore(child, parent.firstChild);
  };

  // Initialization for the carousel
  // Argument: set = an object of settings
  // Possible settings:
  // id <string> ID of the carousel wrapper element (required).
  // slidenav <bool> If true, a list of slides is shown.
  // animate <bool> If true, the slides can be animated.
  // startAnimated <bool> If true, the animation begins
  //                        immediately.
  //                      If false, the animation needs
  //                        to be initiated by clicking
  //                        the play button.
  function init(set) {
    // Make settings available to all functions
    settings = set;

    // Select the element and the individual slides
    carousel  = document.getElementById(settings.id);
    slides    = carousel.querySelectorAll('.slide');

    carousel.className = 'active carousel';

    settings.starttext = 'Speel diashow af';
    settings.stoptext = 'Stop diashow';


    if ( ! settings.duration ) {
      settings.duration = 10000;
    }


    // Add list of slides and/or play/pause button
    if ( ( settings.slidenav || settings.animate) && ( slides.length > 1) ) {

      slidenav = document.getElementById(settings.slidenavid);

      var listspan = document.createElement('span');

      if (settings.animate) {

        // Add Play/Pause button if the slider is animated
        if (settings.startAnimated) {
          listspan.innerHTML = '<button data-stop=true id="slideshowbutton">' + settings.stoptext + '</button>';
        } else {
          listspan.innerHTML = '<button data-start=true id="slideshowbutton">' + settings.starttext + '</button>';
        }

        slidenav.appendChild(listspan);

      }


      // Register click event on the slidenav
      slidenav.addEventListener('click', function(event) {
        console.log('button click for slide show');
        var button = event.target;
        if (button.localName === 'button') {
          if (button.getAttribute('data-stop')) {
            // Stop animation if the stop button is activated
            stopAnimation();
          } else if (button.getAttribute('data-start')) {
            // Start animation if the stop button is activated
            startAnimation();
          }
        }
      }, true);


      carousel.className = 'active carousel with-slidenav';

    }

    // Register a transitionend event so the slides can be
    // hidden after the transition
    slides[0].parentNode.addEventListener('transitionend', function (event) {
      var slide = event.target;
      removeClass(slide, 'in-transition');
      if (hasClass(slide, 'current')) {
        // Also, if the global setFocus variable is set
        // and the transition ended on the current slide,
        // set the focus on this slide.
        if (setFocus) {
          // This is done if the user clicks a slidenav button.
          slide.setAttribute('tabindex', '-1');
          slide.focus();
          setFocus = false;
        }
        if (announceSlide) {
          slide.removeAttribute('aria-live');
          announceSlide = false;
        }
      }
    });

    // Suspend the animation if the mouse enters the carousel
    // or if an element of the carousel (that is not the current
    // slide) receives focus.
    // (Re-)start animation when the mouse leaves or the focus
    // is removed.
//    carousel.addEventListener('mouseenter', suspendAnimation);
//    carousel.addEventListener('mouseleave', startAnimation);

    carousel.addEventListener('focusin', function(event) {
      if (!hasClass(event.target, 'slide')) {
        suspendAnimation();
      }
    });
    carousel.addEventListener('focusout', function(event) {
      if (!hasClass(event.target, 'slide')) {
        startAnimation();
      }
    });

    // Set the index (=current slide) to 0 – the first slide
    index = 0;
    setSlides(index);

    // If the carousel is animated, advance to the
    // next slide after 5s
    if (settings.startAnimated) {
      timer = setTimeout(nextSlide, settings.duration);
    }
  }

  // Function to set a slide the current slide
  function setSlides(new_current, focus, transition) {
    // Both, focus and transition are optional parameters.
    // focus denotes if the focus should be set after the
    // carousel advanced to slide number new_current.
    // transition denotes if the transition is going into the
    // next or previous direction.
    // Here defaults are set:
    setFocus      = typeof focus !== 'undefined' ? focus : false;
    transition    = typeof transition !== 'undefined' ? transition : 'none';

    new_current   = parseFloat(new_current);

    var length    = slides.length;
    var new_next  = new_current+1;
    var new_prev  = new_current-1;

    // If the next slide number is equal to the length,
    // the next slide should be the first one of the slides.
    // If the previous slide number is less than 0.
    // the previous slide is the last of the slides.
    if(new_next === length) {
      new_next = 0;
    } 
    else if(new_prev < 0) {
      new_prev = length-1;
    }

    // Reset slide classes
    for (var i = slides.length - 1; i >= 0; i--) {
      slides[i].className = "slide";
      
//      slides[i].querySelector('.img-container').setAttribute('aria-hidden', 'true');
    }


    if ( length > 1 ) {
  
      // Add classes to the previous, next and current slide
      slides[new_next].className = 'next slide';
      if (transition === 'next') {
        slides[new_next].className = 'next slide in-transition';
      }
  
      slides[new_prev].className = 'prev slide';
      if (transition === 'prev') {
        slides[new_prev].className = 'prev slide in-transition';
      }
  
      slides[new_current].className = 'current slide';
  //    slides[new_current].removeAttribute('aria-hidden');
//      slides[new_current].querySelector('.img-container').removeAttribute('aria-hidden');
  
      if (announceSlide) {
        slides[new_current].setAttribute('aria-live', 'polite');
      }
  
  
      // Set the global index to the new current value
      index = new_current;
    
    }
    else {
      slides[0].className = 'current slide';
    }


  }

  // Function to advance to the next slide
  function nextSlide() {

    var length = slides.length,
    new_current = index + 1;

    if(new_current === length) {
      new_current = 0;
    }

    announceSlide = true;

    // If we advance to the next slide, the previous needs to be
    // visible to the user, so the third parameter is 'prev', not
    // next.
    setSlides(new_current, false, 'prev');

    // If the carousel is animated, advance to the next
    // slide after 5s
    if (settings.animate) {
      timer = setTimeout(nextSlide, settings.duration);
    }

  }

  // Function to advance to the previous slide
  function prevSlide() {
    var length = slides.length,
    new_current = index - 1;

    if(new_current < 0) {
      new_current = length-1;
    }

    announceSlide = true;

    // If we advance to the previous slide, the next needs to be
    // visible to the user, so the third parameter is 'next', not
    // prev.
    setSlides(new_current, false, 'next');

  }

  // Function to stop the animation
  function stopAnimation() {
    clearTimeout(timer);
    settings.animate = false;
    animationSuspended = false;
    var _this = document.getElementById('slideshowbutton');
    _this.innerHTML = settings.starttext;
    _this.removeAttribute('data-stop');
    _this.setAttribute('data-start', 'true');
  }

  // Function to start the animation
  function startAnimation() {
    settings.animate = true;
    animationSuspended = false;
    timer = setTimeout(function () {
      nextSlide();
    }, 5000);
    var _this = document.getElementById('slideshowbutton');
    _this.innerHTML = settings.stoptext;
    _this.setAttribute('data-stop', 'true');
    _this.removeAttribute('data-start');
  }

  // Function to suspend the animation
  function suspendAnimation() {
    if(settings.animate) {
      clearTimeout(timer);
      settings.animate = false;
      animationSuspended = true;
    }
  }

  // Making some functions public
  return {
    init:init,
    next:nextSlide,
    prev:prevSlide,
    goto:setSlides,
    stop:stopAnimation,
    start:startAnimation
  };
});



if ( document.getElementById("carousel") ) {
  
  var carousel = new myCarousel();
  carousel.init({
    id: 'carousel',
    slidenav: true,
    slidenavid: 'slidenavid',
    animate: true,
    startAnimated: true,
    duration: 100000
  });

}



var collapsiblelist = document.querySelectorAll("tabs");

if ( collapsiblelist.length > 0 ) {

  var selectedelement = collapsiblelist[0].querySelectorAll("selected"), t,
      i = selectedelement[0].getElementsByTagName("a");
      
  collapsiblelist[0].className = 'tabs collapsed';

  t = i.length > 0 ? i : selectedelement;
  t[0].onclick = function(e) {
    if ( collapsiblelist[0].className === 'tabs collapsed' ) {
      collapsiblelist[0].className = 'tabs';      
    }
    else {
      collapsiblelist[0].className = 'tabs collapsed';      
    }
  };


}

