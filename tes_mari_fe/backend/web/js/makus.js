/**
 * @ Author: Karen Dharmakusuma
 * @ Description: karendk.github.io
 * @ Email: karenmakus@gmail.com
 * @ Modified by: Karen Dharmakusuma
 * @ Create Time: 2019-12-21 00:56:10
 * @ Modified time: 2023-06-27 13:28:35
 */

$(function() {
    // makusPreloader()
    // slideAnimation()
    $("body").tooltip({ selector: '[data-toggle=tooltip]' })
        // animateCSS('.box-primary','fadeIn')
    animateCSS('.card', '')
    animateCSS('.back-button', 'zoomIn')
    animateCSS('.active', 'pulse')
    animateCSS('.breadcrumb', 'fadeInDown')
    autoHideSearch()
})

$(document).on('pjax:complete', function() {
    // slideAnimation()
    // autoHideSearch()
})

function preview(file, path, textOk, textCancel) {
    var folder;
    let src = path + '/' + file
    let pathArray = window.location.pathname.split('/')
    if (pathArray[1] == 'cis') {
        folder = 'cis'
    } else {
        folder = ''
    }
    let base_url = window.location.origin + '/' + folder
    let src2 = base_url + '/plugin/ViewerJS/index.html#../..' + src.replace('backend/web/', '')
        // console.log(src2)

    var fileArray = file.split('.')
    var doc = fileArray[fileArray.length - 1] == 'doc' || fileArray[fileArray.length - 1] == 'docx' || fileArray[fileArray.length - 1] == 'xls' || fileArray[fileArray.length - 1] == 'xlsx'
    var html = ''
    if (fileArray[fileArray.length - 1] == 'pdf') {
        html += '<object data=\"' + src + '\"  width=\"100%\" height=\"100%\">'
        html += '<iframe src=\"' + src2 + '\" width=\"100%\" height=\"100%\" allowfullscreen webkitallowfullscreen></iframe>'
        html += '</object>'
    } else if (doc) {
        // html+='<iframe src=\"https://docs.google.com/gview?url='+window.location.origin+src+'&embedded=true\" width=\"100%\" height=\"100%\" allowfullscreen webkitallowfullscreen></iframe>'
        // html+='<iframe src=\"https://view.officeapps.live.com/op/embed.aspx?src='+encodeURI(base_url)+encodeURI(src)+'\" width=\"100%\" height=\"100%\" allowfullscreen webkitallowfullscreen></iframe>'
        // html+='<iframe src=\"https://view.officeapps.live.com/op/embed.aspx?src='+encodeURI(base_url)+encodeURI(src)+'\" width=\"100%\" height=\"100%\" allowfullscreen webkitallowfullscreen></iframe>'
        html += '<div style="display: flex; justify-content: center; align-items: center;width:100%; height:100%;">'
        html += '<i>' + file + '&nbsp;<a href="' + src + '">Download</a></i>'
        html += '</div>'
    } else {
        html += '<div class="img-wrapper">'
        html += '<img src=\"' + src + '\" >'
        html += '</div>'
    }

    alertify.confirm(file, html, function() {
            window.open(src, '_blank')
        }, function() {})
        //.maximize()
        .set({ transition: 'zoom' }).show()
        .set('padding', false)
        .set('resizable', true)
        .set('maximizable', true)
        .set('overflow', false)
        .resizeTo('30%', '70%')
        // .resizeTo('500px','550px')
        // .set('labels', {ok:'".Yii::t('app','Download')."', cancel:'".Yii::t('app','Back')."'})
        .set('labels', { ok: textOk, cancel: textCancel })
}

function slideAnimation() {
    // Add slideDown animation to Bootstrap dropdown when expanding.
    $('.dropdown').on('show.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
    })

    // Add slideUp animation to Bootstrap dropdown when collapsing.
    $('.dropdown').on('hide.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    })
}

//preloader
function makusPreloader() {
    $('#preloader').fadeOut(500, function() { //slow bisa diganti dengan angka misal 2000 
        $(this).hide()
    })
}

function makusDatepicker() {
    //Date picker
    // var language=window.navigator.userLanguage || window.navigator.language;
    // if(language=='en-US'){
    //     language='en'
    // }else{
    //     language='id'
    // }
    // alert(language)
    $.fn.datepicker.dates['id'] = {
        days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        daysShort: ["Mi", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        daysMin: ["Mi", "Se", "Sl", "Ra", "Ka", "Ju", "Sa"],
        months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        today: "Hari ini",
        clear: "Bersihkan",
        //format: "mm/dd/yyyy",
        titleFormat: "MM yyyy",
        /* Leverages same syntax as 'format' */
        weekStart: 0
    }

    $('.datepicker').datepicker({
        // title:'Plan-On',
        // multidate:true,
        language: 'id',
        todayHighlight: true,
        disableTouchKeyboard: false,
        // format:'yyyy-mm-dd',
        format: 'dd MM yyyy',
        // viewMode: "months", 
        // minViewMode: "months",
        startView: "months",
        orientation: 'bottom',
        autoclose: true,
        todayBtn: "linked",
        // clearBtn:true,
    })
    $('.datepicker').keydown(function() {
        return false
    })
}

function makusSelect() {
    $('.select2').select2()
}


const animateCSS = (element, animation, prefix = 'animate__') =>
    // We create a Promise and return it
    new Promise((resolve, reject) => {
        const animationName = `${prefix}${animation}`;
        const node = document.querySelector(element);

        node.classList.add(`${prefix}animated`, animationName);

        // When the animation ends, we clean the classes and resolve the Promise
        function handleAnimationEnd(event) {
            event.stopPropagation();
            node.classList.remove(`${prefix}animated`, animationName);
            resolve('Animation ended');
        }

        node.addEventListener('animationend', handleAnimationEnd, { once: true });
    });

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};


function goBack() {
    window.history.back();
}

function autoHideSearch() {
    // var table = $('table')
    // var thead = $('thead')
    // var filter = $('#w0-filters ')
    // filter.children('td')
    //     .animate({ 'padding-top': 0, 'padding-bottom': 0 }) // first remove vertical padding
    //     .wrapInner('<div />') // wrap contents in divs, because THOSE can be animated
    //     .children()
    //     .hide()
    // thead.hover(
    //     function() {
    //         filter.children('td')
    //             .animate({ 'padding-top': 5, 'padding-bottom': 5 }) // first remove vertical padding
    //             .children()
    //             .slideDown(100, 'linear')
    //     },
    //     function() {
    //         filter.children('td')
    //             .animate({ 'padding-top': 0, 'padding-bottom': 0 }) // first remove vertical padding
    //             .wrapInner('<div />') // wrap contents in divs, because THOSE can be animated
    //             .children()
    //             .slideUp(50)
    //     }
    // )
}

// var getUrlParameter = function getUrlParameter(sParam) {
//     var sPageURL = window.location.search.substring(1),
//         sURLVariables = sPageURL.split('&'),
//         sParameterName,
//         i;

//     for (i = 0; i < sURLVariables.length; i++) {
//         sParameterName = sURLVariables[i].split('=');

//         if (sParameterName[0] === sParam) {
//             return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
//         }
//     }
// }

/* -------------------------------------------------------------------------- */
/*                               WIZARD PROGRESS                              */
/* -------------------------------------------------------------------------- */
function wizardProgress(active, data) {
    var i = 0
    if (i == 0) {
        i = 1;
        var elem = document.getElementById('myBar');
        var width = 0;
        var id = setInterval(frame, 10);
        var data_active = (100 * (active / data.length))
        var data_active_progress
        if (active >= data.length) {
            data_active_progress = 100
        } else {
            data_active_progress = ((100 / data.length) / 2) + data_active
        }

        function frame() {
            if (width >= data_active_progress) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + '%';
                // elem.innerHTML = width  + '%';
                $('.clearfix').css({
                    'width': '100%',
                })
                $('.step').css({
                    'width': (100 / data.length) + '%',
                    // 'width': (4/5*(100/data.length))+'%',
                    // 'margin-right': (1/5*(100/data.length))+'%',
                })
                $('.step-num:after').css({
                    'left': '62%',
                })
            }
        }

        var html = ''
        html += '<div class=\"\">'
        html += '<ol class=\"wizard-progress clearfix center-block\">'
        for (let i = 0; i < data.length; i++) {


            if (i == (active)) {
                html += '<li class=\"step step-active\">'
            } else if (i < (active)) {
                html += '<li class=\"step step-done\">'
            } else {
                html += '<li class=\"step\">'
            }
            html += '<span class=\"step-num ' + data[i].icon + '\"></span>'
            html += '<span class=\"step-name\">' + data[i].label + '</span>'
            html += '</li>'
        }
        html += '</ol>'
        html += '</div>'

        $('.myWizard').html(html)
    }
}