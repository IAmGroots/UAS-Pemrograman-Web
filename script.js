const button = document.querySelector(".btn-more");
button.addEventListener("click", function view() {
  let read = "";
  const teks = document.querySelector(".teks");
  if (teks.style.display == "block") {
    // Manipulasi DOM 2
    teks.style.display = "none";
    read = "Read More <i class='uil uil-arrow-right'></i>";
  } else {
    teks.style.display = "block";
    read = "Read Less <i class='uil uil-arrow-right'></i>";
  }
  document.querySelector(".btn-more").innerHTML = read;
  document.querySelector(".btn-more").style.padding = "8px 4px 8px 8px";
});
