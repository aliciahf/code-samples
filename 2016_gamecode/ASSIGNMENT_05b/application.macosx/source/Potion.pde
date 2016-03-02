class Potion {
  PImage[] potionFrames = new PImage[3];
  PImage current;
  int potionState = 0; //0 - inactive, 1 - active, 2 - hover
  
  float posX, posY;
  int sizeX = 64;
  int sizeY = 64;
  
  int glowR, glowG, glowB;
  int glowA = 60;
  int glowSize = 180;
  
  Potion(int id, int roll) {
    //determine if potion is switched on/off
    potionState = roll;
    setGlow();
    
    //load images
    for (int i = 0; i < potionFrames.length; i++) {
      potionFrames[i] = loadImage("images/potion_state_" + i + ".png");
    }
    
    //set posX
    if (id == 1 || id == 4 || id == 7) {
      posX = width/4;
    } else if (id == 2 || id == 5 || id == 8) {
      posX = width/2;
    } else if (id == 3 || id == 6 || id == 9) {
      posX = 3*width/4;
    }
    
    //set posY
     if (id == 1 || id == 2 || id == 3) {
      posY = height/4;
    } else if (id == 4 || id == 5 || id == 6) {
      posY = height/2;
    } else if (id == 7 || id == 8 || id == 9) {
      posY = 3*height/4;
    }
  }
  
  void display() {
    //glow
    setGlow();
    noStroke();
    fill(glowR, glowG, glowB, glowA);
    ellipse(posX, posY, glowSize, glowSize);
    
    //potion
    current = potionFrames[potionState];
    imageMode(CENTER);
    image(current, posX, posY, sizeX, sizeY);
  }
  
  void detect(float playerX, float playerY) {
    if (playerX >= posX - sizeX/2+20 && playerX <= posX + sizeX/2+20 && playerY >= posY - sizeY/2+50 && playerY <= posY + sizeY/2+50) {
      glowA = 80;
      keyPressed();
    } else {
      glowA = 60;
    }
  }
  
  void keyPressed() {
    if (key == '1') {
      potionState = 0;
    } else if (key == '2') {
      potionState = 1;
    } else if (key == '3') {
      potionState = 2;
    }
  }
  
  void setGlow() {
    if (potionState == 0) {
      glowR = 255;
      glowG = 0;
      glowB = 80;
    } else if (potionState == 1) {
      glowR = 80;
      glowG = 200;
      glowB = 0;
    } else if (potionState == 2) {
      glowR = 0;
      glowG = 255;
      glowB = 255;
    }
  }
}