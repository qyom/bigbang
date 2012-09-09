var surface;
var arrow;
var currentAngle;
var intervalID;
var speedometer;

jQuery(document).ready(function(){
	speedometer = jQuery(".speedometer");
	currentAngle = parseFloat(speedometer.attr('data-average'));	
	drawCanvas();
	//console.log(speedometer.attr('data-average'), currentAngle);
	jQuery(".btn").hover(function(){
		average = currentAngle;
		count = parseFloat(0+speedometer.attr('data-count'));
		score = jQuery(this).hasClass('rocks') ? 1 : -1;
		endAngle = 90*(average*count + score)/(count+1) ;
		animate(endAngle);
	}, function(){
		if(intervalID) {
			clearInterval(intervalID);
			intervalID = 0;
		}
		if(!is_being_rated) {
			drawArrow(currentAngle*90);
		}
	}).click(function(){
        rate = jQuery(this).attr("data-rate");
        post_id = speedometer.attr("data-post_id");
        
        rate_post_V(post_id, rate);
    });
   
    //console.log(ratingsL10n);
});


function drawCanvas() {
    // Get our Canvas element
    surface = document.getElementById("arrow");

    if (surface.getContext) {
        // If Canvas is supported, load the image
        arrow = new Image();
        arrow.onload = loadingComplete;
        arrow.src = "/wp-content/themes/responsive/images/rating/arrow.png";
    }else{
    	// If doesn't support HTML5 say something!
    	alert("Whaat");
    }
}

function loadingComplete(e) {
	//alert("arrow laoded" + currentAngle); 
	angle = currentAngle*90;
    // When the image has loaded begin the loop  
    //console.log(angle);  
    drawArrow(angle);
}
function animate(endAngle) {
	var iteration = 3;
	var angle = currentAngle*90;
	
	intervalID = setInterval(function(){
		if(Math.abs(angle-endAngle)<=iteration) {
			clearInterval(intervalID);
			intervalID = 0;
		}
		// Increment our rotation angle
    	angle+=iteration*(angle>endAngle ? -1 : 1);
		drawArrow(angle)
	}, 25);
   	
    
}

function drawArrow(angle)
{
	 // Each loop we rotate the image
    // Grab the context
    var surfaceContext = surface.getContext('2d');

    // Clear the canvas to White
    surfaceContext.fillStyle = "rgb(255,255,255)";
    surfaceContext.fillRect(0, 0, surface.width, surface.height);

    // Save the current context
    surfaceContext.save();
    // Translate to the center point of our image
//    console.log(surface.width * 0.5-arrow.width * 0.5);
//    console.log(surface.height);
    surfaceContext.translate(surface.width * 0.5-arrow.width * 0.5, surface.height-12);
    // Perform the rotation
    surfaceContext.rotate(DegToRad(180+angle));
    // Translate back to the top left of our image
   // surfaceContext.translate(-arrow.width * 0.5, -arrow.height * 0.5);
    // Finally we draw the image
    surfaceContext.drawImage(arrow, -(arrow.width/2), -9);
    // And restore the context ready for the next loop
    surfaceContext.restore();

}
function DegToRad(d) {
    // Converts degrees to radians
    return d * 0.0174532925199432957;
}







// Process Post Ratings Success

function rate_post_success_V(data) {

	//jQuery('#post-ratings-' + post_id).html(data);
    //console.log(data);
    if(data == -1) {
        alert("You need to log in to be able to rate");
    }
    else {
    	data = jQuery.parseJSON(data);
    	// How much it sucks
    	count = ((data.breakdown["-1"]==undefined) || (data.breakdown["-1"].count == undefined)) ? 0 : parseInt(data.breakdown["-1"].count);    	
    	jQuery('.count.sucks').text(count);    	
    	// How much it rocks
    	count = ((data.breakdown["1"]==undefined) || (data.breakdown["1"].count == undefined)) ? 0 : parseInt(data.breakdown["1"].count);
    	jQuery('.count.rocks').text(count);
    	
    	speedometer.attr('data-count', data.count);
    	speedometer.attr('data-average', data.average);
    	currentAngle = parseFloat(data.average);
    	drawArrow(currentAngle*90);
    	alert('We thought so, thanks!');
    	//console.log(data);
    }
	set_is_being_rated(false);
}

// Process Post Ratings

function rate_post_V(post_id, rate) {
	
	//console.log('rating: ', post_id, rate);
	//console.log(ratingsL10n);
	
	if(!is_being_rated) {
    
        post_ratings_nonce = speedometer.attr('data-nonce');
		set_is_being_rated(true);
		speedometer.find('.count').text('...');
		drawArrow(180);
		jQuery.ajax({type: 'GET', url: ratingsL10n.ajax_url, data: 'action=postratings&pid=' + post_id + '&rate=' + rate + '&postratings_' + post_id + '_nonce=' + post_ratings_nonce, cache: false, success: rate_post_success_V});
        
	} else {

		alert(ratingsL10n.text_wait);

	}

}