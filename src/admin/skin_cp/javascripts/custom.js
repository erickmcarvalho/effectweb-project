var IMAGE_URL = 'skin_cp/images/';
//jQuery.noConflict();
jQuery(function ($) {
    $('.box > h2').append('<img src="' + IMAGE_URL + 'icons/arrow_state_grey_expanded.png" class="toggle" />');
    $('img.toggle').click(function () {
        $(this).parent().next().slideToggle(200)
    });
    $('.box + .closed > section').hide();
    var b = function (e, a) {
            a.children().each(function () {
                $(this).width($(this).width())
            });
            return a
        };
    $('table.sortable tbody').sortable({
        handle: 'img.move',
        helper: b,
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true
    }).disableSelection();
    $('ul.sortable').sortable({
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true
    });
    var c = false;
    $('#table1 .checkall').click(function () {
        $('#table1 :checkbox').attr('checked', !c);
        c = !c
    });
    var d = false;
    $('#table2 .checkall').click(function () {
        $('#table2 :checkbox').attr('checked', !d);
        d = !d
    });
    $('table.detailtable tr.detail').hide();
    $('table.detailtable > tbody > tr:nth-child(4n-3)').addClass('odd');
    $('table.detailtable > tbody > tr:nth-child(4n-1)').removeClass('odd').addClass('even');
    $('a.detail-link').click(function () {
        $(this).parent().parent().next().fadeToggle();
        return false
    });
    $('ul.sf-menu').superfish({
        delay: 200,
        //animation: true,
       autoArrows: true,
    });
    $('.msg').click(function () {
        $(this).fadeTo('slow', 0);
        $(this).slideUp(341)
    });
    $('#wysiwyg').wysiwyg();
    $('textarea[set*=htmlEditor]').wysiwyg();
    $('a[rel*=facebox]').facebox();
    $('input[set*=dateSet]').datepicker({
        changeMonth: true,
        changeYear: true
    });
    $('#newsdate').datepicker();
    $('.accordion > h3:first-child').addClass('active');
    $('.accordion > div').hide();
    $('.accordion > h3:first-child').next().show();
    $('.accordion > h3').click(function () {
        if ($(this).hasClass('active')) {
            return false
        }
        $(this).parent().children('h3').removeClass('active');
        $(this).addClass('active');
        $(this).parent().children('div').slideUp(200);
        $(this).next().slideDown(200)
    });
    $('.tabcontent > div').hide();
    $('.tabcontent > div:first-child').show();
    $('.tabs > li:first-child').addClass('selected');
    $('.tabs > li a').click(function () {
        var a = $(this).attr('href');
        $(a).parent().children().hide();
        $(a).fadeIn();
        $(this).parent().parent().children().removeClass('selected');
        $(this).parent().addClass('selected');
        return false
    });
    $('.uniform').validate();
    $('.uniform input[type*=checkbox], .uniform input[type*=radio], .uniform input[set*=file]').uniform();
    Cufon.replace('#site-title');
    Cufon.replace('article > h1');
    Cufon.replace('article > h2');
    Cufon.replace('article > h3');
    Cufon.replace('article > h4');
    Cufon.replace('article > h5');
    Cufon.replace('article > h6')
});