var images = new Array ('../upload/default/140817151116slide1.jpg','../upload/default/140817151116slide2.jpg','../upload/default/140817151116slide3.jpg','../upload/default/140817151116slide4.jpg','../upload/default/140817151116slide5.jpg');
var index = 1;
 
function rotateImage()
{
  $('#myImage').fadeOut('slow', function()
  {
    $(this).attr('src', images[index]);
 
    $(this).fadeIn('slow', function()
    {
      if (index == images.length-1)
      {
        index = 0;
      }
      else
      {
        index++;
      }
    });
  });
}

var images2 = new Array ('../upload/default/140817151116slide2.jpg','../upload/default/140817151116slide3.jpg','../upload/default/140817151116slide4.jpg','../upload/default/140817151116slide5.jpg','../upload/default/140817151116slide1.jpg');
var index2 = 1;
 
function rotateImage2()
{
  $('#myImage2').fadeOut('slow', function()
  {
    $(this).attr('src', images2[index2]);
 
    $(this).fadeIn('slow', function()
    {
      if (index2 == images2.length-1)
      {
        index2 = 0;
      }
      else
      {
        index2++;
      }
    });
  });
}

var images3 = new Array ('../upload/default/140817151116slide3.jpg','../upload/default/140817151116slide4.jpg','../upload/default/140817151116slide5.jpg','../upload/default/140817151116slide1.jpg','../upload/default/140817151116slide2.jpg');
var index3 = 1;
 
function rotateImage3()
{
  $('#myImage3').fadeOut('slow', function()
  {
    $(this).attr('src', images3[index3]);
 
    $(this).fadeIn('slow', function()
    {
      if (index3 == images3.length-1)
      {
        index3 = 0;
      }
      else
      {
        index3++;
      }
    });
  });
}

var images4 = new Array ('../upload/default/140817151116slide4.jpg','../upload/default/140817151116slide5.jpg','../upload/default/140817151116slide1.jpg','../upload/default/140817151116slide2.jpg','../upload/default/140817151116slide3.jpg');
var index4 = 1;
 
function rotateImage4()
{
  $('#myImage4').fadeOut('slow', function()
  {
    $(this).attr('src', images4[index4]);
 
    $(this).fadeIn('slow', function()
    {
      if (index4 == images4.length-1)
      {
        index4 = 0;
      }
      else
      {
        index4++;
      }
    });
  });
}

var images5 = new Array ('../upload/default/140817151116slide5.jpg','../upload/default/140817151116slide1.jpg','../upload/default/140817151116slide2.jpg','../upload/default/140817151116slide3.jpg','../upload/default/140817151116slide4.jpg');
var index5 = 1;
 
function rotateImage5()
{
  $('#myImage5').fadeOut('slow', function()
  {
    $(this).attr('src', images5[index5]);
 
    $(this).fadeIn('slow', function()
    {
      if (index5 == images5.length-1)
      {
        index5 = 0;
      }
      else
      {
        index5++;
      }
    });
  });
}

function myfirstfnc(){
    setInterval (rotateImage, 5000);
}

function mysecondfnc(){
    setInterval (rotateImage2, 5000);
}

function mysthirdfnc(){
    setInterval (rotateImage3, 5000);
}
function myfourthfnc(){
    setInterval (rotateImage4, 5000);
}
function myfifthfnc(){
    setInterval (rotateImage5, 5000);
}
$(document).ready(function()
{
    setTimeout(myfirstfnc, 1000);
    setTimeout(mysecondfnc, 1300);
    setTimeout(mysthirdfnc, 1600);
    setTimeout(myfourthfnc, 1100);
    setTimeout(myfifthfnc, 1400);
});