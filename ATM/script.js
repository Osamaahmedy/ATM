let ad = document.querySelector('.adde');
let re = document.querySelector('.removee');
let co = document.querySelector('.cover');

ad.addEventListener('click', () => {
    co.classList.add('visible');
});

re.addEventListener('click', () => {
    co.classList.remove('visible');
});