// ======= ASSIGNMENT 05 (Alicia Feng) ======= 
// Potion Shelf
// ** Avatar interacts with non-avatar

Player player;
Potion[] potion;
PFont font;
PImage bg;

void setup() {
  size(400, 600);
  bg = loadImage("images/bg.png");
  bg.resize(400,600);
  font = loadFont("Silkscreen.vlw");

  player = new Player(width/2, height/2);
  potion = new Potion[9];
  for (int i = 0; i < 9; i++) {
    potion[i] = new Potion(i+1, round(random(0, 2)));
  }
}

void draw() {
  background(bg);
  for (int i = 0; i < 9; i++) {
    potion[i].display();
    potion[i].detect(player.posX, player.posY);
  }

  player.display();
  player.move();

  fill(255);
  textAlign(CENTER);
  textFont(font, 16);
  text("Press 1-3 to swap potions.", width/2, height-20);
}