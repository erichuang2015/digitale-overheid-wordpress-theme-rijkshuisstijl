function hideMenuButton(e,t,n){header.classList.remove("menu-met-js"),header.classList.remove("active"),header.classList.add("geen-menu-button"),menu.setAttribute("aria-hidden","false");var u=e.getElementById("menu-button");u&&header.removeChild(menuButton)}function showMenuButton(e,t,n){"use strict";header.classList.add("menu-met-js"),header.classList.remove("geen-menu-button"),menuButton=e.createElement("button"),menuButton.classList.add("menu-button"),menuButton.setAttribute("id","menu-button"),menuButton.setAttribute("aria-label","Menu"),menuButton.setAttribute("aria-expanded","false"),menuButton.setAttribute("aria-controls","menu"),menuButton.innerHTML="<i>&#x2261;</i><b>&nbsp;menu</b>",menu.setAttribute("aria-hidden","true"),menu.setAttribute("aria-labelledby","menu-button"),header.insertBefore(menuButton,menu),menuButton.addEventListener("click",function(){menu.classList.contains("active")?(header.classList.remove("active"),menu.classList.remove("active"),menu.setAttribute("aria-hidden","true"),menuButton.setAttribute("aria-label","Open menu"),menuButton.innerHTML="<i>&#x2261;</i><b>&nbsp;menu</b>",menuButton.setAttribute("aria-expanded","false")):(header.classList.add("active"),menu.classList.add("active"),menu.setAttribute("aria-hidden","false"),menuButton.setAttribute("aria-label","Sluit menu"),menuButton.innerHTML="<i>X</i><b>&nbsp;Sluit menu</b>",menuButton.setAttribute("aria-expanded","true"))},!1)}function WidthChange(e){e.matches?hideMenuButton(document,window):showMenuButton(document,window)}var header=document.querySelector("#menu-container"),menu=document.querySelector(".nav-primary"),menuButton=document.querySelector(".menu-button");if(matchMedia){var mq=window.matchMedia("(min-width: 900px)");mq.addListener(WidthChange),WidthChange(mq)}