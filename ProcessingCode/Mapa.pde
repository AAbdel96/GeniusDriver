class Mapa
{
  public void mostrarMapaImagen(String mapa)
  {
    //creamos objeto Imagen
    PImage laFoto = loadImage("\\ImagenesMapas\\"+mapa);
    //Mostramos la imagen y la colocamos en la posición 0,0
    image(laFoto, 0, 0);
  }
  //____________________________________________________________________________________
  public void mostrarMapaProcessing(String mapa)
  {
    switch(mapa)
    {

    case "mapa1":
      {
        noStroke();
        fill(0);
        rect(0, 0, 1200, 250);
        rect(0, 400, 1200, 250);
      }
    }
  }
}