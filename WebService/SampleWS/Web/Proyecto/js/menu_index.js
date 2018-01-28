$(document).ready(function()
{
	$(window).scroll(function()
	{
		if($(this).scrollTop() > 0)
		{
			$('header').addClass('cabecera');
		} 
		else 
		{
			$('header').removeClass('cabecera');
		}
	});
});