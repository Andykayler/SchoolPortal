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
  
  // Function to change the background image of the hero section
  function changeHeroBackground() {
      currentImageIndex = (currentImageIndex + 1) % heroImages.length; // Cycle through the array
      heroSection.style.backgroundImage = heroImages[currentImageIndex];
  }
  
  // Change the background every 5 seconds
  setInterval(changeHeroBackground, 5000);
  
  // Set the initial background image
  heroSection.style.backgroundImage = heroImages[currentImageIndex];