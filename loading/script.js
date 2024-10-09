window.addEventListener("load", function() {
    const loader = document.querySelector('.loader-container');
    setTimeout(() => {
      loader.style.opacity = "0";
      loader.style.visibility = "hidden";
    }, 3000); 
  });

        
        setTimeout(function() {
            window.location.href = 'new.html';
        }, 3000); 
   