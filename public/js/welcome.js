let moto = document.getElementById('moto');
let bg = document.getElementById('bg');
let text = document.getElementById('text');

window.addEventListener('scroll', function(){
    let value = window.scrollY;
    moto.style.left = value * 0.1 + 60 + '%';
    text.style.right = value * 0.1 + 40 + '%';
    bg.style.top = value * 0.7;
    bg.style.opacity = 1 - ((value * 1) / 300);
    // bg.style.width = value * 0.5 + 85 + '%';
    // bg.style.height = value * 0.3 + 100 + '%';
})

// function showContent(){
//     let brand = document.getElementById('brands');
//     let header = document.getElementById('header');

//     brand.style.display = 'flex';

// }
