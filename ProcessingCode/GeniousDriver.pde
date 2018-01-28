Mapa mp, mp2;
Coche c1, c2;

void setup() {
  size(1200, 700);
  smooth();

  //  Creamos los Objetos
  c1= new Coche("Coche1", 100, 250, 60, 40, 3); //Parámetros: posX,posY, tamX,tamY,speed
  mp= new Mapa();
  mp2= new Mapa();
}

void draw() {
  background(255);
  iniciarGeniousDriver();
}

void iniciarGeniousDriver()
{
  //  Mostramos mapa
  mp.mostrarMapaImagen("mapaCurva.png"); //Iniciar en pos y = 250 para mejor resultado

  //Recuadro blanco para los datos
  noStroke();
  fill(-1);
  rect(width-120, 100, 200, 300);

  //Obstaculo
  noStroke();
  fill(0);
  rect(mouseX, mouseY, 50, 50);


  //  Inciamos el coche 1
  c1.iniciarCoche();
}


//mp.mostrarMapaImagen("mapaCurva2.png"); //y=106
//mp2.mostrarMapaImagen("regilla.png");
//mp.mostrarMapaImgen("IMG2.jpg");
//mp.mostrarMapaImagen("mp3.jpeg");
//mp.mostrarMapaProcessing("mapa1");