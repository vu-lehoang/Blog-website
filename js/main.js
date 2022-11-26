const navItem = document.querySelector(".nav__items");
const openBtn = document.querySelector("#open__nav-btn");
const closeBtn = document.querySelector("#close__nav-btn");
if (openBtn) {
  openBtn.addEventListener("click", () => {
    navItem.style = "display: block";
    openBtn.style = "display: none";
    closeBtn.style = "display: block";
  });
}

const closeNav = () => {
  navItem.style = "display: none";
  closeBtn.style = "display: none";
  openBtn.style = "display: block";
};
if (closeBtn) {
  closeBtn.addEventListener("click", closeNav);
}

const sidebar = document.querySelector("aside");
const showSidebarBtn = document.querySelector("#show__sidebar-btn");
const hideSidebarBtn = document.querySelector("#hide__sidebar-btn");

function showSidebar() {
  sidebar.style.left = "0";
  showSidebarBtn.style = "display: none";
  hideSidebarBtn.style.display = "inline-block";
}
const hiddenSidebar = () => {
  sidebar.style.left = "-100%";
  showSidebarBtn.style = "display: inline-block";
  hideSidebarBtn.style.display = "none";
};
if (sidebar) {
  showSidebarBtn.addEventListener("click", showSidebar);
}
if (sidebar) {
  hideSidebarBtn.addEventListener("click", hiddenSidebar);
}

const linkEls = document.querySelectorAll(".dashboard aside ul li a");
