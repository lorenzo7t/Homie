const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const square = entry.target.querySelector('.step');
  
      if (entry.isIntersecting) {
        square.classList.add('wipe-animation');
        return; // if we added the class, exit the function
      }
  
      // We're not intersecting, so remove the class!
      square.classList.remove('wipe-animation');
    });
  });
  
  observer.observe(document.querySelector('.step'));