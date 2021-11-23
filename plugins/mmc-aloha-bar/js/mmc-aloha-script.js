//this is JavaScript!
console.log('Aloha!');

//$ is disabled by default (noconflict mode). this is the noconflict wrapper
jQuery(document).ready( function($){
	//$ is now defined
	//add a dismiss button
	$('<span class="aloha-dismiss">&times;</span>').appendTo('#mmc-aloha-bar');

	//when the X button is clicked, hide the whole bar
	$('#mmc-aloha-bar').on( 'click', '.aloha-dismiss', function(){
		$('#mmc-aloha-bar').fadeOut();
	} );

} );

