(function() {
    'use strict';
    // pagination css
    if (!$(".page-item").hasClass("page-link")) {
        $(".page-item a").addClass("page-link")
    }
})()

function copyTo(name) {
    var copyText = document.getElementById(name)
    // console.log(copyText.value)
    copyText.select()
    copyText.setSelectionRange(0, 99999) /* For mobile devices */
    navigator.clipboard.writeText(copyText.value)
}