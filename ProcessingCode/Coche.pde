Radar rFront;
Radar2 rFrontal, rIzq, rDer;
Giro giro;

class Coche
{
  //Atributos
  float x;
  float y;
  float midaX;
  float midaY;
  float speed, speedAux;
  String idCoche;
  float rotacion=0, rot=0;
  float posInix=0, posIniy=0;
  boolean stopRadar=false;

 //____________________________________________________________________________________
  //Constructor
  public Coche(String id, int x, int y, int midaX, int midaY, float speed)
  {
    this.posInix=x;
    this.posIniy=y;
    this.x=x;
    this.y=y;
    this.midaX=midaX;
    this.midaY=midaY;
    this.idCoche=id;
    this.speed=speed;
    this.speedAux=speed;
  }
  //____________________________________________________________________________________
  public void iniciarCoche()
  {
    //Creamos Objetos
    rFrontal= new Radar2();
    rIzq= new Radar2();
    rDer= new Radar2();
    giro=new Giro();

    //Mostramos el coche con o sin rotación
    displayCar(x, y, rotacion); 

    //Centrar coche
    centrarCoche(x, y, rotacion);

    //Radar Frontal - Si detecta un Obstáculo se para si no, sigue
    radarFrontal(x, y, rotacion);

    //Control de giro con Teclado
    float rot = giro.giroTeclado();
    rotacion=rot+rotacion;  //rotacion=0;// Con esta linea hacemos que no gire

    //  Llamamos al método datos
    datos();
  }

  //____________________________________________________________________________________
  void displayCar(float x, float y, float rotate)
  {
    pushMatrix();
    rectMode(CENTER);
    translate(x, y);
    rotate(radians (rotate));
    dibujarCar();
    popMatrix();
    rotate=0;
    //Informacion para mostrar
    fill(0);
    textSize(10);
    text("Coordenadas ["+x+" , "+y+"]", width-210, 10);
  }
  //____________________________________________________________________________________
  public void dibujarCar()
  {
    //  Creación del coche
    noStroke();
    fill(34);
    rect(0, 0, 70, 50);

    fill(250);
    rect(0, 0, 35, 50);
  }
  //____________________________________________________________________________________
  public void moverDelante()
  {  
    //  Mover coordenada X e Y 
    x = speed * cos(radians(rotacion)) + x;   
    y = speed * sin(radians(rotacion)) + y;

    //  Cuando el coche se salga de la pista volverá a la posición original
    if (x>width || x<0 ||y>height || y<0)
    {
      x=posInix;
      y=posIniy;
    }
  }
  //____________________________________________________________________________________
  public void parar()
  {
    if (stopRadar==true) {
      speed=0;
    }
  }
  //____________________________________________________________________________________
  public void centrarCoche(float x, float y, float rotacion)
  {
    //RadarIzquierdo
    float distanciaIzq = radarIzquierdo(x, y, rotacion);

    //RadarDerecho
    float distanciaDer = radarDerecho(x, y, rotacion);

    //CentrarCoche
    int respuesta=giro.centrarCoche((int)distanciaIzq, (int)distanciaDer);
    giro.Rotar(respuesta);

    //Informacion para mostrar
    fill(0);
    textSize(10);
    text("Distancia Izq = "+distanciaIzq, width-210, 25);
    text("Distancia Der = "+distanciaDer, width-210, 40);
  }
  //____________________________________________________________________________________
  public int radarIzquierdo(float x, float y, float rotacion)
  {
    rIzq.recibirDatos("rIzq", x, y, rotacion-90, 100);
    rIzq.dibujarVector();
    int pixelesBlancosIzq=rIzq.getPixeles();
    return pixelesBlancosIzq;
  }

  //____________________________________________________________________________________
  public int radarDerecho(float x, float y, float rotacion)
  {
    rDer.recibirDatos("rDer", x, y, rotacion+90, 100);
    rDer.dibujarVector();
    int pixelesBlancosDer=rDer.getPixeles();
    return pixelesBlancosDer;
  }
  //____________________________________________________________________________________
  public void radarFrontal(float x, float y, float rotacion)
  {
    rFrontal.recibirDatos("RadarFrontal", x, y, rotacion, 100);
    stopRadar=rFrontal.iniciarRadar();

    if (stopRadar || key == 's')
    {
      parar();
    } else if (!stopRadar ||key == 'd')
    {
      //  Mover cocher
      speed=speedAux;
      moverDelante();
    }
    text("Obstáculo = "+stopRadar, width-210, 55);
  }
  //____________________________________________________________________________________
  public void datos()
  {
    //Datos Coche
    text("Controles s=parar, d=continuar", width-210, 70);
    text("Up=rotacioDer, Down=rotacionIzq", width-210, 85);
  }
}