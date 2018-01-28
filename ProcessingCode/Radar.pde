
class Radar
{
  //  Atributos
  String idRadar;
  PVector puntoA = new PVector();
  PVector puntoB = new PVector();
  float alcanceRadar;


  //  Constructor
  Radar (String idRadar, PVector pntoA, PVector pntoB, float alcnRadar)
  {
    this.idRadar=idRadar;
    this.puntoA=pntoA;
    this.puntoB=pntoB;
    this.alcanceRadar=alcnRadar;
  }
  //____________________________________________________________________________________
  //  Métodos
  public void iniciarRadar()
  {
   // dibujarVector();
    dibujarVectorRadar();
    reconocimientoDistancia();
  }
  //____________________________________________________________________________________
  //  Con este método dibujamos el vector del coche
  public void dibujarVector()
  {
    stroke(0, 0, 0);
    line(puntoA.x, puntoA.y, puntoB.x, puntoB.y);
  }
  //____________________________________________________________________________________
  public void  dibujarVectorRadar()
  {
    PVector puntoC=calculoPuntoC();
    stroke(250, 0, 0);
    line(puntoB.x, puntoB.y, puntoC.x, puntoC.y);
  }
    //____________________________________________________________________________________
  public PVector calculoPuntoC()
  {
    //  Calculo del módulo |AB|
    float restaX=puntoB.x-puntoA.x;
    float restaY=puntoB.y-puntoA.y;
    float sqx =sq(restaX);
    float sqy =sq(restaY);
    float modAB = sqrt(sqx+sqy);

    //Hallar angulo del vector respecto a la horizontal
    float angulo = acos(restaX/modAB);
    //print(angulo);

    //Cálculo punto C
    float progresionX = cos(angulo)*alcanceRadar;
    float progresionY= sin(angulo)*alcanceRadar;
    PVector puntoC = new PVector(puntoB.x+progresionX, puntoB.y+progresionY);

    return puntoC;
  }
  //____________________________________________________________________________________

  boolean primeraDistancia=true;
  boolean primerObstaculo=true;
  float ecuacioRectaY;
  float x1=puntoB.x;
    //____________________________________________________________________________________
  public void reconocimientoDistancia( )
  {

    PVector puntoC=calculoPuntoC();
    while (x1<puntoC.x)
    {
      ecuacioRectaY = ((puntoB.y-puntoA.y)/(puntoB.x-puntoA.x))*(x1-puntoA.x)+puntoA.y; 
      x1++;
      //print("\nX="+x1+"Y="+ecuacioRectaY);

      color c = get((int)x1+1, (int)ecuacioRectaY);
      if (red(c)==0)
      {
        //  print("\nBlanco");
        //print("\nDistnacia = "+(puntoB.x-x1));
      } else
      {
        //print("\negro");
      }
    }
  }
    //____________________________________________________________________________________
}