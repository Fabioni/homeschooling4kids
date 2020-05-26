jQuery(function () {

/*  let callback = (entries, observer) => {
    entries.forEach(entry => {
      // Each entry describes an intersection change for one observed
      // target element:
      //   entry.boundingClientRect
      //   entry.intersectionRatio
      //   entry.intersectionRect
      //   entry.isIntersecting
      //   entry.rootBounds
      //   entry.target
      //   entry.time

      console.log(entry);
      if (entry.isIntersecting){
        jQuery(entry.target).css('visibility', 'hidden');
      }else{
        jQuery(entry.target).css('visibility', 'none');
      }
    });
  };

  let options = {
    root: document.querySelector('.site-info'),
    rootMargin: '0px',
    threshold: 1.0
  }


  let observer = new IntersectionObserver(callback, options);
  let target1 = document.querySelector('#donatecup');
  let target2 = document.querySelector('.backtotop');

  if(target1 != null){observer.observe(target1);}
  observer.observe(target2);


// the callback we setup for the observer will be executed now for the first time
// it waits until we assign a target to our observer (even if the target is currently not visible)*/
})
