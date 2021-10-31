let loginCard = document.getElementById('login-card');
let signupCard = document.getElementById('signup-card');

let registerLink = document.getElementById('register-link');
let loginLink = document.getElementById('login-link');

registerLink.addEventListener('click', (e)=>{
  console.log('yudbsgc');
  loginCard.style.display = 'none';
  signupCard.style.display = 'block';
});

loginLink.addEventListener('click', (e)=>{
  console.log(loginCard);
  loginCard.style.display = 'block';
  signupCard.style.display = 'none';
});
