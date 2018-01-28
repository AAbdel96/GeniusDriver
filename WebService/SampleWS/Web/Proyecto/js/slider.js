var slider = $('.contenido-slider');

var siguiente = $('.btn-next');
var anterior = $('.btn-prev');

$('.contenido-slider article:last').insertBefore('.contenido-slider article:first');

//Agregar un estilo css a slider.css para mostrar la primera imagen con un margen de -100%
slider.css('margin-left', '-'+100+'%');

function moverDerecha()
{
  slider.animate({marginLeft:'-'+200+'%'}, 700, function()
  {
    $('.contenido-slider article:first').insertAfter('.contenido-slider article:last');
    slider.css('margin-left', '-'+100+'%');
  });
}

function moverIzquierda()
{
  slider.animate({marginLeft: 0}, 700, function()
  {
    $('.contenido-slider article:last').insertBefore('.contenido-slider article:first');
    slider.css('margin-left', '-'+100+'%');
  });
}

function autoplay()
{
  interval = setInterval(function()
  {
    moverDerecha();
  }, 3000);
}

siguiente.on('click', function()
{
  moverDerecha();
  clearInterval(interval); //Limpia el intervalo de 3 segundos para que no se active cuando le damos manualmente
  autoplay(); //Tenemos que poner el autoplay para que funcione tanto si le damos al boton como si no
});

anterior.on('click', function()
{
  moverIzquierda();
  clearInterval(interval);
  autoplay();
});

autoplay();