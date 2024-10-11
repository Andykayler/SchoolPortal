const heroImages = [
    "url('mary.jpeg')",
    "url('kelz.jpeg')",
    "url('godf.jpeg')",
    "url('yammie.jpeg')"
  ];
  
  // Get the hero section element
  const heroSection = document.querySelector('.hero');
  
  // Initialize the current index to track the image
  let currentImageIndex = 0;
  
  function changeHeroBackground() {
      currentImageIndex = (currentImageIndex + 1) % heroImages.length; 
      heroSection.style.backgroundImage = heroImages[currentImageIndex];
  }
  
  // Change the background every 5 seconds
  setInterval(changeHeroBackground, 5000);
  
  // Set the initial background image
  heroSection.style.backgroundImage = heroImages[currentImageIndex];
  


