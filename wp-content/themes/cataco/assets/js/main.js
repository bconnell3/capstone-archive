const openNav=document.querySelector(".toggle-icon-open"),closeNav=document.querySelector(".toggle-icon-close");openNav.addEventListener("click",()=>{document.querySelector("nav").classList.toggle("show-nav")}),closeNav.addEventListener("click",()=>{document.querySelector("nav").classList.toggle("show-nav")});const filterToggle=document.querySelector(".filter-toggle"),filtersContainer=document.querySelector(".filters"),horSpan=document.querySelector(".horizontal-filter"),vertSpan=document.querySelector(".vertical-filter");null!=filterToggle&&filterToggle.addEventListener("click",()=>{horSpan.classList.toggle("open"),vertSpan.classList.toggle("open"),filtersContainer.classList.toggle("showfilters")}),window.onload=function(){document.getElementById("signup")},signup.addEventListener("click",function(e){showPopupSmart11420(!0),e.preventDefault()});
jQuery(document).ready(function($){
    $('#selection').on('change', function() {
        if ($("input[type='radio'][name='selection']:checked").val() === 'Other') {
            document.querySelector(".other").classList.remove('hide-other');
        } else {
            document.querySelector(".other").classList.add('hide-other');
        }
    });
});