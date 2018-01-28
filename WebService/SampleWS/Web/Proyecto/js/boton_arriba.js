$(document).ready(function()
{
	$('.boton-arriba').hide();
	
	$(window).scroll(function()
	{
		if($(this).scrollTop() > 500)
		{
			$('.boton-arriba').fadeIn(400);
		}
		else
		{
			$('.boton-arriba').fadeOut(400);
		}
});

	$('.boton-arriba').click(function()
	{
		$('body, html').animate(
		{
			scrollTop: '0px'
		}, 2000);
	});
});