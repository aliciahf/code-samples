import processing.core.*; 
import processing.data.*; 
import processing.event.*; 
import processing.opengl.*; 

import java.util.HashMap; 
import java.util.ArrayList; 
import java.io.File; 
import java.io.BufferedReader; 
import java.io.PrintWriter; 
import java.io.InputStream; 
import java.io.OutputStream; 
import java.io.IOException; 

public class ASSIGNMENT_05b extends PApplet {

// ======= ASSIGNMENT 05 (Alicia Feng) ======= 
// Potion Shelf
// ** Avatar interacts with non-avatar

Player player;
Potion[] potion;
PFont font;
PImage bg;

public void setup() {
  
  bg = loadImage("images/bg.png");
  bg.resize(400,600);
  font = loadFont("Silkscreen.vlw");

  player = new Player(width/2, height/2);
  potion = new Potion[9];
  for (int i = 0; i < 9; i++) {
    potion[i] = new Potion(i+1, round(random(0, 2)));
  }
}

public void draw() {
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
  
  public void display() {
    animatePlayer();
    imageMode(CENTER);
    image(current, posX, posY, sizeX, sizeY);
  }
  
  public void animatePlayer() {
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
  
  public void move() {
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
  
  public void display() {
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
  
  public void detect(float playerX, float playerY) {
    if (playerX >= posX - sizeX/2+20 && playerX <= posX + sizeX/2+20 && playerY >= posY - sizeY/2+50 && playerY <= posY + sizeY/2+50) {
      glowA = 80;
      keyPressed();
    } else {
      glowA = 60;
    }
  }
  
  public void keyPressed() {
    if (key == '1') {
      potionState = 0;
    } else if (key == '2') {
      potionState = 1;
    } else if (key == '3') {
      potionState = 2;
    }
  }
  
  public void setGlow() {
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
  public void settings() {  size(400, 600); }
  static public void main(String[] passedArgs) {
    String[] appletArgs = new String[] { "ASSIGNMENT_05b" };
    if (passedArgs != null) {
      PApplet.main(concat(appletArgs, passedArgs));
    } else {
      PApplet.main(appletArgs);
    }
  }
}
