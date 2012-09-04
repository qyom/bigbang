var surface;
var arrow;
var currentAngle;

jQuery(document).ready(function(){
	
	currentAngle = parseFloat(0+jQuery(".speedometer").attr('data-average'))*90;	
	drawCanvas();
	jQuery(".btn").hover(function(){
		average = currentAngle;
		count = parseFloat(0+jQuery(".speedometer").attr('data-count'));
		score = jQuery(this).hasClass('rocks') ? 1 : -1;
		endAngle = 90*(average*count + score)/(count+1) ;
		animate(endAngle);
	}, function(){
		drawArrow(angle);
	});
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
    drawArrow(angle);
}
function animate(endAngle) {
	var iteration = 3;
	var angle = currentAngle*90;
	
	var intervalID = setInterval(function(){
		if(Math.abs(angle-endAngle)<=iteration) {
			clearInterval(intervalID);
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