function setup() {
	var cnv = createCanvas(500, 500);
	  var x = (windowWidth - width) / 2;
	  var y = (windowHeight - height) / 2;
	  cnv.position(x, y);
	  background(255, 0, 200);

}

function draw() {
	
	if (mouseX>180 && mouseY>180 && mouseX<420 && mouseY<420)
		{
  fill(random(256));
  ellipse(mouseX, mouseY, 80, 80);
		}
}
