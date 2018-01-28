class Radar2
{
  float x, y;
  float alcanceRadar;
  float rotacion;
  String id;
  boolean stop=false;

  //____________________________________________________________________________________
  public void recibirDatos(String id, float x, float y, float rotate, float alcanceRadar)
  {
    this.id=id;
    this.x=x;
    this.y=y;
    this.rotacion=rotate;
    this.alcanceRadar=alcanceRadar;
  }
  //____________________________________________________________________________________
  public boolean iniciarRadar()
  {
    stop=false;
    dibujarVector();
    getPixeles();
    return stop;
  }
  //____________________________________________________________________________________

  //  Lineas del Radar para hacer los giros
  public void dibujarVector()
  {
    PVector vec1= calculoPuntosAlcance();
    stroke(250, 0, 0);
    line(x, y, vec1.x, vec1.y);
  }
  //____________________________________________________________________________________
  public PVector calculoPuntosAlcance()
  {
    float angulo = radians(rotacion);
    float x1=cos(angulo)*alcanceRadar+x;
    float y1=sin(angulo)*alcanceRadar+y;

    //  Prueba del Punto
    /* noStroke();
     fill(0);
     rect(x1, y1, 1, 1);
     */

    //  PuntoAlcanceMáximo
    PVector vec1 = new PVector(x1, y1);
    return vec1;
  }
  //____________________________________________________________________________________

  public int getPixeles()
  {
    int i=0;
    int negro=0, blanco=0;
    float angulo = radians(rotacion);

    for ( i=34; i<alcanceRadar; i++)
    {
      float x1=cos(angulo)*i+(x+1);
      float y1=sin(angulo)*i+(y+1);
      color c = get((int)(x1+1), (int)(y1+1));

      //print("\n"+i+"--" + c);
      if (c<=-3735552)
      {
        negro++;
        //print("\nRadar: "+id+" Color"+ c +" x1 "+ x1 +" x1 " +y1 );
      } else if (c>=-3733496 )

      {
        blanco++;
      } else
      {
      }
    }
    if (negro>=10)
    {
      stop=true;
    }
    print("\nID "+id+" Negros: "+negro+"\nBlancos: "+blanco);
    print("\n--------------------------------------------");
    print("\nRadar devuelve true Si hay un obstaulo =" +stop);
    return blanco;
  }
  //____________________________________________________________________________________
  /*public int comprobarRuta()
  {
    float angulo = radians(rotacion);
    float x1=cos(angulo)*alcanceRadar+(x+1);
    float y1=sin(angulo)*alcanceRadar+(y+1);

    int instruccionGiro=0;
    fill(250, 250, 0);
    rect(x1, y1-25, 1, 1);
    rect(x1, y1+25, 1, 1);

    color pixIzq =get((int)x1+2, (int)y1-25);
    color pixDer =get((int) x1+2, (int)y1+50);
    if (pixDer==-1)
    {
      instruccionGiro=2;
    }
    if (pixIzq==-1)
    {
      instruccionGiro=1;
    }

    print("\nSe ha parado! va a girar a 1(izq) 2(der) = "+instruccionGiro);
    return instruccionGiro;
  }*/
    //____________________________________________________________________________________
 
}