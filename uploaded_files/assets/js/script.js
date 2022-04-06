$('.navTrigger').click(function(){
  $('html').toggleClass('actNav');
})

$('.backDrop').click(function(){
  $('html').removeClass('actNav');
})

$('.colorCol').click(function(){
  $(this).parent().siblings().find('a').removeClass('actColor');
  $(this).addClass('actColor');
})
