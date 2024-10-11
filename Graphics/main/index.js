 //nút menu
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const menuContent = document.getElementById('menuContent');

        menuButton.addEventListener('click', function() {
            menuContent.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuContent.contains(event.target) && !menuButton.contains(event.target)) {
                menuContent.classList.remove('active');
            }
        });
        menuContent.addEventListener('click', function(event) {
            if (event.target.tagName === 'A') {
                menuContent.classList.remove('active');
            }
        });
    });

  //slide
  let slideIndex = 1;
  showSlides(slideIndex);
  function changeSlide(n) {
      showSlides(slideIndex += n);
  }
  function currentSlide(n) {
      showSlides(slideIndex = n);
  }
  function showSlides(n) {
      let i;
      const slides = document.getElementsByClassName("slides");
      const dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
  }
  setInterval(() => {changeSlide(1)}, 6000);

  //giỏ hàng
  let cart = []; 
  // Lấy các phần tử DOM
  const cartBtn = document.getElementById('cart-btn');
  const cartModal = document.getElementById('cart-modal');
  const closeBtn = document.querySelector('.close');
  const cartItems = document.getElementById('cart-items');
  const totalPriceEl = document.getElementById('total-price');
  

  cartBtn.addEventListener('click', function() {
      updateCartDisplay();
      cartModal.style.display = 'block';
  });
 
  closeBtn.addEventListener('click', function() {
      cartModal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
      if (event.target == cartModal) {
          cartModal.style.display = 'none';
      }
  });
  
  // Thêm sản phẩm vào giỏ hàng
  function addToCart(productId, productName, price, quantity) {
      const existingProduct = cart.find(item => item.MaSP === productId);
      if (existingProduct) {
          existingProduct.soluong += quantity; 
      } else {
          cart.push({
              MaSP: productId,
              ten: productName,
              giaban: price,
              soluong: quantity
          });
      }
      updateCartDisplay();
  }
  
  function updateCartDisplay() {
      cartItems.innerHTML = '';
      let total = 0;
      cart.forEach(item => {
          const li = document.createElement('li');
          li.textContent = `${item.ten} - Số lượng: ${item.soluong} - Giá: ${item.giaban} VND`;
          cartItems.appendChild(li);
          total += item.giaban * item.soluong;
      });
  
      totalPriceEl.textContent = total;
  
      cartBtn.textContent = `Giỏ Hàng (${cart.length})`;
  }
  
  document.getElementById('checkout-button').addEventListener('click', function() {
      checkout();
  });
  function checkout() {
    const total = totalPriceEl.textContent;

    fetch('checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            cart: cart,
            tongtien: total
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Thanh toán thành công!');
            cart = []; 
            updateCartDisplay();
            cartModal.style.display = 'none';
        } else {
            alert('Đã có lỗi xảy ra: ' + data.message);
        }
    });
}
 
 // Nút hiển thị thêm
 function showMoreItems(className, buttonClass) {
    const hiddenItems = document.querySelectorAll(`.${className}[style*="display: none"]`);
    for (let i = 0; i < 5 && i < hiddenItems.length; i++) {
        hiddenItems[i].style.display = 'block';
    }
    // Nếu không còn sản phẩm ẩn, ẩn nút "Hiển thị thêm"
    if (document.querySelectorAll(`.${className}[style*="display: none"]`).length === 0) {
        document.querySelector(`.${buttonClass}`).style.display = 'none';
    }
}
//for SPTS items
document.querySelector('.SHowmore').addEventListener('click', () => showMoreItems('SPTS-itemhidden','SHowmore'));
//for Đồ uống items
document.querySelector('.Hienthi').addEventListener('click', () => showMoreItems('Douong-itemhidden','Hienthi'));
//for Đồ khô items
document.querySelector('.HienThi').addEventListener('click', () => showMoreItems('Dokho-itemhidden','HienThi'));
//for Bánh kẹo items
document.querySelector('.hienThi').addEventListener('click', () => showMoreItems('BKS-itemhidden','hienThi'));
//for Đồ dùng cá nhân items
document.querySelector('.hienthi').addEventListener('click', () => showMoreItems('DDCN-itemhidden','hienthi'));
//for Đồ gia dụng items
document.querySelector('.More').addEventListener('click', () => showMoreItems('DGD-itemhidden','More'));
//for Vệ sinh nhà cửa items
document.querySelector('.more').addEventListener('click', () => showMoreItems('VS-itemhidden','more'));
//for Hoa quả items
document.querySelector('.MORE').addEventListener('click', () => showMoreItems('Hoaqua-itemhidden','MORE'));


