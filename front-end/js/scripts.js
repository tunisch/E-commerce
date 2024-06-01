function addToCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let product = cart.find(p => p.id === productId);
    if (product) {
        product.quantity++;
    } else {
        cart.push({ id: productId, quantity: 1 });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    alert('Ürün sepete eklendi');
}

document.addEventListener('DOMContentLoaded', () => {
    let cartItems = document.getElementById('cart-items');
    if (cartItems) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartItems.innerHTML = cart.map(item => `<p>Ürün ID: ${item.id} - Adet: ${item.quantity}</p>`).join('');
    }
});

let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
};


document.querySelector('#close-edit').onclick = () =>{
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = 'admin.php';
};