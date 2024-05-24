function generatePopup(id, category) {
  const popupEspresso = document.getElementById("popup-espresso");
  const popupBrew = document.getElementById("popup-brew");  
  const popupNcat = document.getElementById("popup-ncat");  
  const popupMatcha = document.getElementById("popup-matcha");  
  const popupBeverages = document.getElementById("popup-beverages");
  const popupAdb = document.getElementById("popup-adb");
  const popupSilog = document.getElementById("popup-silog");
  const popupPasta = document.getElementById("popup-pasta");
  const popupBargainBites = document.getElementById("popup-bargainBites");
  const popupSidesAndNibbles = document.getElementById("popup-sidesAndNibbles");
  const popupCarbsAndCaffeine = document.getElementById("popup-carbsAndCaffeine");  
  
  const price12OzMap = {
    "Dirty Matcha": 109,
    "Green & Sweet": 109,
    "Ichigo Matcha": 109,
    "Spanish Latte": 99,
    "White Choco Latte": 99,
    "Mocha Latte": 99,
    "Cafe Latte": 99,
    "Dark Berry": 99,
    "Strawyberry & Mango": 99,
    "Matcha Mango": 99,
    "Nutty Green Tea": 99,
    "Vanilla Kissed Matcha": 99,
    "Spicy Matcha": 99,
    "Tita Maggie's Matcha": 99,
    "Whiteout Matcha": 99,
    "Matcha Latte": 99,
    "Cinamon Brown Latte": 89,
    "Caramel-Vanilla Macchiato": 89,
    "Salted Caramel Latte": 89,
    "Iced Triple Chocolate": 89,
    "Midnight Cherry": 79,
    "Vanilla": 79,
    "Hazelnut": 79,
    "Caramel": 79,
    "Hot Chocolate": 79,
    "Pink Paradise": 79,
    "Tropical Cloud": 79,
    "Caramel Candy": 79,
    "Vanilla McDreamy": 79,
    "Hibiscus Tea": 79,
    "Coca-Cola Zero": "N/A",
    "Regular Coca-Cola": "N/A",
    "Pepsi": "N/A"
  };
  const price160zMap = {
    "Cold Brew": 109,
    "Hot Brewed Coffee": 109,
    "Midnight Cherry": 119,
    "Vanila Cafe Latte": 119,
    "Hazelnute Cafe Latte": 119,
    "Iced Coffee": 119,
    "Chamomile Tea": 119,
    "Purple Bloom": 119,
    "Lavender Tea": 119,
    "Pure Green Tea": 119,
    "English Breakfast Tea": 119,
    "Espresso Cloud": 129,
    "Vanilla": 129,
    "Hazelnut": 129,
    "Caramel": 129,
    "Hot Chocolate": 129,
    "Pink Paradise": 129,
    "Tropical Cloud": 129,
    "Caramel Candy": 129,
    "Vanilla McDreamy": 129,
    "Hibiscus Tea": 129,
    "Salted Caramel Latte": 139,
    "Americano": 139,
    "Caramel-Vanilla Macchiato": 139,
    "Cinamon Brown Latte": 139,
    "Iced Triple Chocolate": 139,
    "Dirty Matcha": 159,
    "Green & Sweet": 159,
    "Ichigo Matcha": 159,
  };
  const priceSoloMap = {
    "Fluffy Pancakes": 139,
    "French Toast": 139,
    "Classic Waffles": 129,
    "Marga's Fave": 250,
    "Breakfast Platter": 250,
    "Chicksilog": 180,
    "Tapsilog": 180,
    "Luncheonsilog": 180,
    "Bacsilog": 180,
    "Carrot Rice": 35,
    "Plain Rice": 25,
    "Chicken Pesto": 260,
    "Gourment Tuyo": 245,
    "Aglio Olio": 245,
    "Garlic Bread": 35,
    "Chicken Poppers": 99,
    "Chicken Teriyaki": 100,
    "Pork Teriyaki": 160,
    "Chicken Katsudon": 110,
    "Pork Katsudon": 170,
    "Fries": 99,
    "Fries Before Guys": "N/A",
    "Mozarella Balls": "N/A",
    "Nachos Overload": 190,
    "Chicken Balls": "N/A",
    "Chicken Balls Mix": "N/A",
    "Calamari": "N/A",
    "Calamari Mix": "N/A",
    "Hashbrown": 65,
    "Pain Au Chocolat": 90,
    "Butter Croissant": 90,
    "Plain": 100,
  };
  const priceSavorMap = {
    "Poffertjes": "N/A",
    "Fluffy Pancakes": 169,
    "French Toast": "N/A",
    "Classic Waffles": "N/A",
    "Marga's Fave": "N/A",
    "Breakfast Platter": "N/A",
    "Chicksilog": 340,
    "Tapsilog": 340,
    "Luncheonsilog": 340,
    "Bacsilog": 340,
    "Carrot Rice": "N/A",
    "Plain Rice": "N/A",
    "Chicken Pesto": 380,
    "Gourment Tuyo": 360,
    "Aglio Olio": 360,
    "Garlic Bread": "N/A",
    "Pork Teriyaki": 260,
    "Pork Katsudon": 320,
    "Mozarella Balls": 115,
    "Nachos Overload": 350,
    "Hashbrown": "N/A",
    "Clubhouse Sandwich": 200,
    "Pain Au Chocolat": 150,
    "Butter Croissant": 150,
    "Croissanwich": 190,
    "Plain": 140,
    "Strawberry Field": 150,
    "Mango Tango": 150,
    "Choco Traffle": 150
  };

  const defaultPrice12Oz = 69;
  const defaultPrice160z = 149;
  const defaultPriceSolo = 120;
  const defaultPriceSavor = 250;

  const price12Oz = price12OzMap[id] || defaultPrice12Oz;
  const price160z = price160zMap[id] || defaultPrice160z;
  const priceSolo = priceSoloMap[id] || defaultPriceSolo;
  const priceSavor = priceSavorMap[id] || defaultPriceSavor; 

  const items = id;
  let popupImage = items.toUpperCase();
  let popupHTML = "";
  
  if(category === "espresso" || category === "brew" || category === "noncofeeandtea" || category === "matcha" || category === "beverages") {
      popupHTML = ` 
      <div class="popupImage">
        <img src="BLK/${popupImage}.png">
      </div>
      <div class="popupContent">
        <div class="btnClose">
          <button onclick="closePopup()"><img src="icons/x.png"></button>
        </div>
        <div class="productName">
          <h1>${items}</h1>
        </div>
        <div class="description">
          <p>Enjoy our creamy ${items}, made with premium espresso, sweetened condensed milk, and whole milk. Perfectly balanced for a smooth, sweet coffee experience.</p>
        </div>
        <div class="price">
          <div class="txt-price"><p>Price:</p></div>
          <div class="price-list">
            <p><input type="radio" name="size" value="${price12Oz}"> 12oz: <span>₱${price12Oz}</span> &nbsp | &nbsp <input type="radio" name="size" value="${price160z}"> 16oz: <span>₱${price160z}</span></p>
          </div>
        </div>
        <div class="quantity">
          <div><p>Quantity:</p></div>
          <div class="addMinus">
            <button class="btnMinus" onclick="updateQuantity(-1, '${category}')">-</button>
            <input class="quantityInput" type="text" value="1" readonly>
            <button class="btnAdd" onclick="updateQuantity(1, '${category}')">+</button>
          </div>
        </div>
        <div class="total">
          <p class="totalPrice">Total: <span></span></p>
        </div>
        <div class="addBuy">
          <button class="addCart"><img src=""><i class="fa-solid fa-cart-shopping" style="font-size: 12px;"></i> Add to Cart</button>
          <button class="buyNow">Buy Now</button>
        </div>
      </div>
    `;
    popupEspresso.innerHTML = popupHTML;
    popupBrew.innerHTML = popupHTML;
    popupNcat.innerHTML = popupHTML; 
    popupMatcha.innerHTML = popupHTML; 
    popupBeverages.innerHTML = popupHTML; 
  } 
  else {
    popupHTML = ` 
      <div class="popupImage">
        <img src="BLK/${popupImage}.png">
      </div>
      <div class="popupContent">
        <div class="btnClose">
          <button onclick="closePopup()"><img src="icons/x.png"></button>
        </div>
        <div class="productName">
          <h1>${items}</h1>
        </div>
        <div class="description">
          <p>Enjoy our creamy ${items}, made with premium espresso, sweetened condensed milk, and whole milk. Perfectly balanced for a smooth, sweet coffee experience.</p>
        </div>
        <div class="price">
          <div class="txt-price"><p>Price:</p></div>
          <div class="price-list">
          <p><input type="radio" name="size" value="${priceSolo}"> Solo: <span>₱${priceSolo}</span> &nbsp | &nbsp <input type="radio" name="size" value="${priceSavor}"> Savor: <span>₱${priceSavor}</span></p>
          </div>
        </div>
        <div class="quantity">
          <div><p>Quantity:</p></div>
          <div class="addMinus">
            <button class="btnMinus" onclick="updateQuantity(-1, '${category}')">-</button>
            <input class="quantityInput" type="text" value="1" readonly required>
            <button class="btnAdd" onclick="updateQuantity(1, '${category}')">+</button>
          </div>
        </div>
        <div class="total">
          <p class="totalPrice">Total: <span></span></p>
        </div>
        <div class="addBuy">
          <button class="addCart"><img src=""><i class="fa-solid fa-cart-shopping" style="font-size: 12px;"></i> Add to Cart</button>
          <button class="buyNow">Buy Now</button>
        </div>
      </div>
    `;
    popupAdb.innerHTML = popupHTML;  
    popupSilog.innerHTML = popupHTML;  
    popupPasta.innerHTML = popupHTML;  
    popupBargainBites.innerHTML = popupHTML;  
    popupSidesAndNibbles.innerHTML = popupHTML;  
    popupCarbsAndCaffeine.innerHTML = popupHTML;  
  } 
}

function openPopup() {
  const elementsToBlur = [
    document.getElementById("mainNav"),
    document.getElementById("sidebar"),
    document.getElementById("espresso-container"),
    document.getElementById("brew-container"),
    document.getElementById("ncat-container"),
    document.getElementById("matcha-container"),
    document.getElementById("beverages-container"),
    document.getElementById("adb-container"),
    document.getElementById("silog-container"),
    document.getElementById("pasta-container"),
    document.getElementById("bargainBites-container"),
    document.getElementById("sidesAndNibbles-container"),
    document.getElementById("carbsAndCaffeine-container"),
    document.getElementById("footer"),
    document.getElementById("privacy")
  ];

  const elementsToPopup = [
    document.getElementById("popup-espresso"),
    document.getElementById("popup-brew"),
    document.getElementById("popup-ncat"),
    document.getElementById("popup-matcha"),
    document.getElementById("popup-beverages"),
    document.getElementById("popup-adb"),
    document.getElementById("popup-silog"),
    document.getElementById("popup-pasta"),
    document.getElementById("popup-bargainBites"),
    document.getElementById("popup-sidesAndNibbles"),
    document.getElementById("popup-carbsAndCaffeine")
  ];

  elementsToPopup.forEach(element => element.classList.add("open-popup"));
  elementsToBlur.forEach(element => element.classList.add("blur-background"));
}
function closePopup() {
  const elementsToBlur = [
    document.getElementById("mainNav"),
    document.getElementById("sidebar"),
    document.getElementById("espresso-container"),
    document.getElementById("brew-container"),
    document.getElementById("ncat-container"),
    document.getElementById("matcha-container"),
    document.getElementById("beverages-container"),
    document.getElementById("adb-container"),
    document.getElementById("silog-container"),
    document.getElementById("pasta-container"),
    document.getElementById("bargainBites-container"),
    document.getElementById("sidesAndNibbles-container"),
    document.getElementById("carbsAndCaffeine-container"),
    document.getElementById("footer"),
    document.getElementById("privacy")
  ];

  const elementsToPopup = [
    document.getElementById("popup-espresso"),
    document.getElementById("popup-brew"),
    document.getElementById("popup-ncat"),
    document.getElementById("popup-matcha"),
    document.getElementById("popup-beverages"),
    document.getElementById("popup-adb"),
    document.getElementById("popup-silog"),
    document.getElementById("popup-pasta"),
    document.getElementById("popup-bargainBites"),
    document.getElementById("popup-sidesAndNibbles"),
    document.getElementById("popup-carbsAndCaffeine")
  ];

  elementsToPopup.forEach(element => element.classList.remove("open-popup"));
  elementsToBlur.forEach(element => element.classList.remove("blur-background"));
}