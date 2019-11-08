const toggle = document.getElementById("toggle");
const toggle2 = document.getElementById("toggle2");
toggle2.style.display = "none";

function clickhere(){
  toggle.style.display = "none";
  toggle2.style.display = "block";
}

function goback(){
  toggle2.style.display = "none";
  toggle.style.display = "block";
}
