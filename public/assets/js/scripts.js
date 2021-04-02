$(document).ready(function () {

  // Give the first class to the first content
  // var firstClass = $('.tab-nav li:first').attr('class');
  // $('.content:first').addClass(firstClass);

  // Align classes of tabs and contents
  // $('.tab-nav li').each(function(index, val) {
  //   var allClass = $(this).attr('class');
  //   $('.content').eq(index).addClass(allClass);
  // });

  // On click event to change contents
  $('.tab-nav li a').on('click', function() {
    var hrefAttr = $(this).attr('href');
    $(this).parent('li').addClass('active');
    $(this).parent('li').siblings().removeClass('active');

    $('.content').removeClass('active');
    $(hrefAttr + '.content').attr('id', hrefAttr.slice(1)).addClass('active');

  });


});
