const slideshowImages = [
  { img: "s1.png", id: "slide1" },
  { img: "s2.png", id: "slide2" },
  { img: "s3.png", id: "slide3" },
  { img: "s4.png", id: "slide4" },
];

let slideNum = 0;

const showSlide = (images, num) => {
  for (let i = 0; i < images.length; i++) {
    if (i === num) {
      document.getElementById(images[i].id).style.opacity = 1;
    } else {
      document.getElementById(images[i].id).style.opacity = 0;
    }
  }
};

const creatSlideshow = (container, images) => {
  const elCont = document.getElementById(container);

  // images.length

  images.forEach((imgObj) => {
    const tempDiv = document.createElement("div");
    tempDiv.id = imgObj.id;
    tempDiv.classList.add("slideshow-image");
    tempDiv.style.backgroundImage = "url(img/" + imgObj.img + ")";
    elCont.append(tempDiv);
  });

  showSlide(images, slideNum);

  let intervalMove;

  const move = function () {
    intervalMove = setInterval(() => {
      slideNum = (slideNum + 1) % images.length;
      showSlide(images, slideNum);
    }, 2000);
  };

  move();

  elCont.addEventListener("mouseover", () => {
    clearInterval(intervalMove);
  });
  elCont.addEventListener("mouseout", () => {
    move();
  });
};

creatSlideshow("slideshow", slideshowImages);
