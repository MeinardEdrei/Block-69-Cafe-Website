
document.addEventListener("DOMContentLoaded", function() {
  var nav = document.getElementById("mainNav");

  var listItems = nav.getElementsByTagName("li");

  for (var i = 0; i < listItems.length; i++) {
      listItems[i].style.display = "none";

      listItems[0].style.display = "block";
      listItems[0].innerHTML = "<span style='font-weight: lighter;'>|</span>" + "<span style='margin-left: 1em;'>Shopping Cart</span>";
      listItems[0].style.fontWeight = "bold";
      listItems[0].style.fontFamily = "League Spartan";
      listItems[0].style.fontSize = "30px";
  }
  document.getElementById('Cart').style.display = "none";
});

// document.addEventListener("DOMContentLoaded", function() {
//   var selectAllCheckbox = document.getElementById('select-all');
//   var selectAllCheckout = document.getElementById('select-all-checkout');
//   var itemCheckboxes = document.querySelectorAll('.select');

//   // Add event listener to the select-all checkbox
//   selectAllCheckbox.addEventListener('change', function() {
//     if (this.checked) {
//       // Check all item checkboxes
//       itemCheckboxes.forEach(function(checkbox) {
//         checkbox.checked = true;
//       });
//     } else {
//       // Uncheck all item checkboxes
//       itemCheckboxes.forEach(function(checkbox) {
//         checkbox.checked = false;
//       });
//     }
//   });
//   // Add event listener to the select-all checkbox
//   selectAllCheckout.addEventListener('change', function() {
//     if (this.checked) {
//       // Check all item checkboxes
//       itemCheckboxes.forEach(function(checkbox) {
//         checkbox.checked = true;
//       });
//     } else {
//       // Uncheck all item checkboxes
//       itemCheckboxes.forEach(function(checkbox) {
//         checkbox.checked = false;
//       });
//     }
//   });
// });