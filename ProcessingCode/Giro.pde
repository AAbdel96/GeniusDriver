Radar2 rFrontalRuta = new Radar2();
class Giro
{
  float rotate=0;
  float valorRotacion=1;
  //____________________________________________________________________________________
  public float giroTeclado()
  {
    //  Control de la rotación por teclado...
    if (keyPressed == true ) {
      if (keyCode == DOWN)
      {
        //devuelve rotación para girar a la Derecha
        rotate=rotate+valorRotacion; 
      } else if (keyCode==UP)
      {
        //devuelve rotación para girar a la Izquiera
        rotate=rotate-valorRotacion; 
      }
    }
    return rotate;
  }
  //____________________________________________________________________________________
  public float Rotar(int respuesta)
  {
    if (respuesta==0)
    {
      rotate=0;
    } else if ( respuesta==1)
    {
      valorRotacion=3;
      rotate=rotate-valorRotacion;
    } else if (respuesta==2)
    {
      valorRotacion=3;
      rotate=rotate+valorRotacion;
    } else if (respuesta==3)
    {
      valorRotacion=0.6;
      rotate=rotate-valorRotacion;
    } else if (respuesta==4)
    {
      //Rotacion para centrarCoche
      valorRotacion=0.6;
      rotate=rotate+valorRotacion;
    }
    return rotate;
  }
  //____________________________________________________________________________________
  public int centrarCoche(int pbi, int pbd)
  {
    int respuesta=0;
    print("\nPBI ="+pbi+" PBD ="+pbd);
    if (pbi>pbd)
    {
      print("\nRotaIzq");
      respuesta=3;
    } else if (pbi<pbd)
    {
      print("\nRotaDer");
      respuesta=4;
    } else
    {
      respuesta=0;
    }
    return respuesta;
  }
}