class Player {
  PImage[] idleFrames = new PImage[4];
  PImage current;
  
  int currentFrame = 0;
  int toNextFrame = 12;
  int frameRefill = toNextFrame;
  
  float posX, posY;
  int sizeX = 64;
  int sizeY = 96;
  int speed = 5;
  
  Player(float x, float y) {
    posX = x;
    posY = y;

    //load idle frames
    for (int i = 0; i < idleFrames.length; i++) {
      idleFrames[i] = loadImage("images/player_idle_" + i + ".png");
    }
  }
  
  void display() {
    animatePlayer();
    imageMode(CENTER);
    image(current, posX, posY, sizeX, sizeY);
  }
  
  void animatePlayer() {
    toNextFrame--;
    if (toNextFrame <= 0) {
      toNextFrame = frameRefill;
      currentFrame++;
    }
    
    if (currentFrame > idleFrames.length-1) {
      currentFrame = 0;
    }
    
    current = idleFrames[currentFrame];
  }
  
  void move() {
    if (keyPressed) {
      //UP DOWN LEFT RIGHT
      if (key == CODED) {
        if (keyCode == UP) {
          posY -= speed;
        } else if (keyCode == DOWN) {
          posY += speed;
        } else if (keyCode == RIGHT) {
          posX += speed;
        } else if (keyCode == LEFT) {
          posX -= speed;
        }
      }
      //WASD
      key = Character.toLowerCase(key);
      if (key == 'w') {
        posY -= speed;
      } else if (key == 's') {
        posY += speed;
      } else if (key == 'd') {
        posX += speed;
      } else if (key == 'a') {
        posX -= speed;
      }
    }
  }
}