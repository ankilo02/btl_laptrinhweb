$(document).ready(function () {
  const path = location.pathname.slice(1);
  switch (path) {
    case "cart.php":
      loadCartDetail();
      break;

    case "checkout.php":
      loadCartCheckout();
      break;

    case "store.php":
      loadSidebarBrands();

    default:
      break;
  }

  loadMainNavbar();

  loadProductsBySelectedCategory();
  loadPagePanigation();

  loadOthersState();

  //define functions
  function loadMainNavbar() {
    const path = location.pathname.slice(1);
    const query = new URLSearchParams(location.search);
    const catId = query.get("cat");

    $.ajax({
      url: "homeaction.php",
      method: "POST",
      data: { categoryhome: 1 },
      success: function (data) {
        $("#get_category_home").html(data);
        if (path === "store.php" && catId) {
          $("#cat-" + catId).addClass("active");
        } else if (path === "index.php" || path === "") {
          $("#home").addClass("active");
        }
      },
    });
  }

  function loadSidebarBrands() {
    $.ajax({
      url: "homeaction.php",
      method: "POST",
      data: { brand: 1 },
      success: function (data) {
        $("#get_brand").html(data);
      },
    });
  }

  function loadOthersState() {
    const cartLength = localStorage.getItem("cart")
      ? JSON.parse(localStorage.getItem("cart")).length
      : 0;
    $(".badge.qty").html(cartLength);
  }

  function loadProductsBySelectedCategory() {
    const path = location.pathname.slice(1);
    const query = new URLSearchParams(location.search);
    const catId = query.get("cat");
    const sort_opt = document
      .getElementById("sort-select")
      ?.getAttribute("value");

    if (path === "store.php" && catId) {
      $.ajax({
        url: "homeaction.php",
        method: "POST",
        data: {
          get_seleted_Category: 1,
          cat_id: catId,
          pageNo: 1,
          sort_opt: sort_opt,
        },
        success: function (data) {
          $("#get_product").html(data);
          if ($("body").width() < 480) {
            $(document).scrollTop(640);
          } else {
            $(document).scrollTop(0);
          }
        },
      });
    }
  }

  function loadPagePanigation(brandId) {
    const path = location.pathname.slice(1);
    const query = new URLSearchParams(location.search);
    const catId = query.get("cat");
    const keyword = query.get("keyword");
    if (path !== "store.php") return;
    const postData = {
      page: 1,
      brandId,
    };

    if (keyword) postData.keyword = keyword;
    if (catId) postData.cat_id = catId;

    $.ajax({
      url: "homeaction.php",
      method: "POST",
      data: postData,
      success: function (data) {
        $("#pageno").html(data);
        document
          .getElementById("pageno")
          .firstElementChild.classList.add("active");
      },
    });
  }

  function loadCartDetail() {
    const cart = localStorage.getItem("cart")
      ? JSON.parse(localStorage.getItem("cart"))
      : [];

    let html = cart
      .map(
        (item, index) => `
      <tr id="cart-item-${index}">
        <td data-th="Product">
            <div class="row">
                <div class="col-sm-4 ">
                    <img src="${item.image}" style="height: 70px;width:75px;" />
                   
                </div>
                <div class="col-sm-6">
                     <h4 class="nomargin product-name header-cart-item-name">
                        <a href="product.php?p=${item.id}">${item.title}</a>
                    </h4>
                </div>


            </div>
        </td>
  
        <td data-th="Price">
            <input type="text" class="form-control price" value="${item.price}" readonly="readonly">
        </td>
        <td data-th="Quantity">
            <input type="text" data-index="${index}" class="form-control qty" value="${item.quantity}">
        </td>
        <td data-th="Subtotal" class="text-center hidden-xs">
            <input type="text" class="form-control total" value="${item.price}" readonly="readonly">
        </td>
        <td class="actions" data-th="">
            <button type="button" class="btn btn-danger btn-sm remove" data-index="${index}">
                    <i class="fa fa-trash-o"></i>
            </button>
        </td>
    </tr>
    `
      )
      .join("\r\n");

    if (html === "") {
      const checkoutBtn = document.getElementById("ready-checkout-btn");
      checkoutBtn.setAttribute("disabled", true);
      checkoutBtn.onclick = () => false;

      html =
        "<div style='padding:10px'>There is no product here. Shop now</div>";
    }
    $("#cart_checkout tbody").html(html);
    net_total();
  }

  function loadCartCheckout() {
    const cart = JSON.parse(localStorage.getItem("cart"));
    let total = 0;
    const html = cart
      .map((item, index) => {
        total += item.quantity * item.price;

        return `
                    <tr>
                        <td><p>${index + 1}</p></td>
                        <td><p>${item.title}</p></td>
                        <td ><p>${item.price}</p></td>
                        <td ><p>${item.quantity}</p></td>
                    </tr>
        `;
      })
      .join("\r\n");

    $(".container-checkout tbody").html(html);
    $("#checkout-total b").html(total);

    const cartSubmit = cart.map((item) => ({
      id: item.id,
      quantity: item.quantity,
    }));
    document.getElementById("cart-submit").value = JSON.stringify(cartSubmit);
    document.getElementById("total-submit").value = total;
    if (cartSubmit.length === 0) {
      document.getElementById("submit").setAttribute("disabled", true);
    }
  }

  function updateCartItemQuantity(index, quantity) {
    const cart = JSON.parse(localStorage.getItem("cart"));
    const newCart = cart.map((item, _index) =>
      _index == index ? { ...item, quantity } : item
    );
    localStorage.setItem("cart", JSON.stringify(newCart));
  }

  /* Handle envent */

  $("#search_btn").click(function (e) {
    e.preventDefault();
    const keyword = $("#search").val();
    if (keyword != "") {
      window.location.href = "store.php?keyword=" + keyword;
    }
  });

  $("body").delegate(".add-to-cart", "click", (e) => {
    const id = e.target.getAttribute("data-id");
    const title = e.target.getAttribute("data-title");
    const price = e.target.getAttribute("data-price");
    const image = e.target.getAttribute("data-image");
    addToCart(id, title, price, image);
  });

  function addToCart(id, title, price, image, qty = 1) {
    let cart = localStorage.getItem("cart")
      ? JSON.parse(localStorage.getItem("cart"))
      : [];
    const cartItem = {
      id,
      title,
      price,
      image: `/product_images/${image}`,
    };
    if (cart.find((item) => item.id === id)) {
      cart = cart.map((item) =>
        item.id == id
          ? {
              ...item,
              quantity: item.quantity + qty,
            }
          : item
      );
    } else {
      cartItem.quantity = qty;
      cart.push(cartItem);
    }
    $(".badge.qty").html(cart.length);
    localStorage.setItem("cart", JSON.stringify(cart));
  }

  $("body").delegate(".dropdown", "click", () => {
    const cart = localStorage.getItem("cart")
      ? JSON.parse(localStorage.getItem("cart"))
      : [];

    let html = cart
      .map(
        (item) => `
      <div class="product-widget">
        <div class="product-img">
          <img src="${item.image}" alt="">
        </div>
        <div class="product-body">
          <h3 class="product-name"><a href="#">${item.title}</a></h3>
          <h4 class="product-price"><span class="qty">${item.quantity}</span>${item.price}</h4>
        </div>
			</div>
      `
      )
      .join("\r\n");
    if (cart.length === 0) {
      html = "<div>There is no product in your cart. Shop now</div>";
    }
    $("#cart_product").html(html);
  });

  $("body").delegate("#page", "click", function (e) {
    e.preventDefault();
    const pn = $(this).attr("data-page");
    const query = new URLSearchParams(location.search);
    const cat_id = query.get("cat");
    const keyword = query.get("keyword");
    const sort_opt = document
      .getElementById("sort-select")
      ?.getAttribute("value");
    const brandId = document
      .querySelector(".selectBrand.active")
      ?.getAttribute("bid");

    document.querySelectorAll("#page").forEach((item) => {
      item.classList.remove("active");
    });
    e.target.classList.add("active");

    const postData = { pageNo: pn, sort_opt, cat_id, keyword, brandId };
    if (cat_id) postData.get_seleted_Category = 1;
    else if (keyword) postData.search = 1;

    $.ajax({
      url: "homeaction.php",
      method: "POST",
      data: postData,
      success: function (data) {
        $("#get_product").html(data);
        if ($("body").width() < 480) {
          $(document).scrollTop(640);
        } else {
          $(document).scrollTop(0);
        }
      },
    });
  });

  $("body").delegate(".selectBrand", "click", function (event) {
    event.preventDefault();
    const query = new URLSearchParams(location.search);
    const catId = query.get("cat");
    const keyword = query.get("keyword");
    var brandId = $(this).attr("bid");
    loadPagePanigation(brandId);

    document.querySelectorAll(".selectBrand").forEach((item) => {
      item.classList.remove("active");
    });
    event.target.classList.add("active");

    const sort_opt = document
      .getElementById("sort-select")
      ?.getAttribute("value");

    const postData = {
      get_seleted_brand: 1,
      brandId,
      keyword,
      cat_id: catId,
      pageNo: 1,
      sort_opt,
    };

    if (catId) postData.get_seleted_Category = 1;
    if (keyword) postData.search = 1;

    $.ajax({
      url: "homeaction.php",
      method: "POST",
      data: postData,
      success: function (data) {
        $("#get_product").html(data);
        if ($("body").width() < 480) {
          $(document).scrollTop(640);
        } else {
          $(document).scrollTop(0);
        }
      },
    });
  });

  $("body").delegate("#clear-filter", "click", function (e) {
    e.stopPropagation();
    location.reload();
  });

  $("body").delegate("#sort-select", "change", function (e) {
    const query = new URLSearchParams(location.search);
    const catId = query.get("cat");
    const keyword = query.get("keyword");
    const sortOption = e.target.value;
    document.querySelector("#sort-select").setAttribute("value", sortOption);
    const brandId = document
      .querySelector(".selectBrand.active")
      ?.getAttribute("bid");

    const postData = {
      cat_id: catId,
      sort_opt: sortOption,
      pageNo: 1,
      brandId: brandId,
      keyword,
    };
    if (catId) postData.get_seleted_Category = 1;
    if (keyword) postData.search = 1;
    if (brandId) postData.get_seleted_brand = 1;

    $("#page.active").removeClass("active");
    document.querySelectorAll("#page")[0].classList.add("active");

    $.ajax({
      url: "homeaction.php",
      method: "POST",
      data: postData,
      success: function (data) {
        $("#get_product").html(data);
        if ($("body").width() < 480) {
          $(document).scrollTop(640);
        } else {
          $(document).scrollTop(0);
        }
      },
    });
  });

  $("body").delegate(".qty", "keyup", function (event) {
    event.preventDefault();
    const row = $(this).parent().parent();
    const price = row.find(".price").val();
    let qty = row.find(".qty").val();
    if (isNaN(qty)) {
      qty = 1;
    }
    if (qty < 1) {
      qty = 1;
    }

    const index = event.target.getAttribute("data-index");
    updateCartItemQuantity(index, qty);
    let total = price * qty;
    row.find(".total").val(total);
    let net_total = 0;
    $(".total").each(function () {
      net_total += $(this).val() - 0;
    });
    $(".net_total").html("Total : $ " + net_total);
  });

  function net_total() {
    var net_total = 0;
    $(".qty").each(function () {
      var row = $(this).parent().parent();
      var price = row.find(".price").val();
      var total = price * $(this).val() - 0;
      row.find(".total").val(total);
    });
    $(".total").each(function () {
      net_total += $(this).val() - 0;
    });
    $(".net_total").html("Tổng cộng : " + net_total + "&#x20AB;");
  }

  $("body").delegate(".remove", "click", function (event) {
    const index =
      event.target.getAttribute("data-index") ??
      event.target.parentElement.getAttribute("data-index");

    const cart = JSON.parse(localStorage.getItem("cart"));
    const newCart = cart.filter((item, _index) => _index != index);
    localStorage.setItem("cart", JSON.stringify(newCart));
    $(`#cart-item-${index}`).remove();
    net_total();
    if (newCart.length === 0) {
      const checkoutBtn = document.getElementById("ready-checkout-btn");
      checkoutBtn.setAttribute("disabled", true);
      checkoutBtn.onclick = () => false;
    }
  });

  $("body").delegate("#pay-type", "change", function (e) {
    const html = `
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>


            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" class="form-control" pattern="^[a-zA-Z ]+$" required>

            <div class="form-group" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
            </div>

            <label for="expdate">Exp Date</label>
            <input type="text" id="expdate" name="expdate" class="form-control" pattern="^[1-9][0-2]\/(\\d{2})$" placeholder="12/22" required>


            <div class="row">

                <div class="col-50">
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" name="cvv" id="cvv" required>
                    </div>
                </div>
            </div>
        `;
    const payType = e.target.value;
    if (payType == 2) {
      $("#pay-by-card").html(html);
    } else {
      $("#pay-by-card").html(null);
    }
  });

  $(document).scroll(function () {
    const y = window.scrollY;
    if (y > 750) {
      document.getElementById("go-to-top").style.visibility = "visible";
    } else {
      document.getElementById("go-to-top").style.visibility = "hidden";
    }
  });

  $("body").delegate("#go-to-top", "click", function () {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: "smooth",
    });
  });

  $("#login").on("submit", function (event) {
    event.preventDefault();
    $(".overlay").show();
    $.ajax({
      url: "login.php",
      method: "POST",
      data: $("#login").serialize(),
      success: function (data) {
        $(".overlay").hide();
        if (data == "successful") {
          $("#e_msg").html("Đăng nhập thành công");
          setTimeout(() => location.reload(), 500);
        } else {
          $("#e_msg").html(data);
        }
      },
    });
  });

  $("#signup_form").on("submit", function (event) {
    event.preventDefault();
    $(".overlay").show();
    $.ajax({
      url: "register.php",
      method: "POST",
      data: $("#signup_form").serialize(),
      success: function (data) {
        $(".overlay").hide();
        if (data == "successful") {
          $("#signup_msg").html("Đăng ký tài khoản thành công");
          setTimeout(() => location.reload(), 500);
        } else {
          $("#signup_msg").html(data);
        }
      },
    });
  });

  $(".menu-toggle > a").on("click", function (e) {
    e.preventDefault();
    $("#responsive-nav").toggleClass("active");
  });

  // Fix cart dropdown from closing
  $(".cart-dropdown").on("click", function (e) {
    e.stopPropagation();
  });

  // Products Slick
  $(".products-slick").each(function () {
    var $this = $(this),
      $nav = $this.attr("data-nav");

    $this.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      infinite: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });

  // Products Widget Slick
  $(".products-widget-slick").each(function () {
    var $this = $(this),
      $nav = $this.attr("data-nav");

    $this.slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
    });
  });
});
