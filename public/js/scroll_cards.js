
const scrollContainer = document.getElementById("scrollContainer");
const scrollContainerConsltant = document.getElementById("scrollContainerConsltant");
const scrollContainerCompany = document.getElementById("scrollContainerCompany");
let isDown = false;
let startX;
let scrollLeft;

// rooms section
scrollContainer.addEventListener("mousedown", (e) => {
    isDown = true;
    scrollContainer.classList.add("active");
    startX = e.pageX - scrollContainer.offsetLeft;
    scrollLeft = scrollContainer.scrollLeft;
});

scrollContainer.addEventListener("mouseleave", () => {
    isDown = false;
    scrollContainer.classList.remove("active");
});

scrollContainer.addEventListener("mouseup", () => {
    isDown = false;
    scrollContainer.classList.remove("active");
});

scrollContainer.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - scrollContainer.offsetLeft;
    const walk = (x - startX) * 2;
    scrollContainer.scrollLeft = scrollLeft - walk;
});

// consltant section
scrollContainerConsltant.addEventListener("mousedown", (e) => {
    isDown = true;
    scrollContainerConsltant.classList.add("active");
    startX = e.pageX - scrollContainerConsltant.offsetLeft;
    scrollLeft = scrollContainerConsltant.scrollLeft;
});

scrollContainerConsltant.addEventListener("mouseleave", () => {
    isDown = false;
    scrollContainerConsltant.classList.remove("active");
});

scrollContainerConsltant.addEventListener("mouseup", () => {
    isDown = false;
    scrollContainerConsltant.classList.remove("active");
});

scrollContainerConsltant.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - scrollContainerConsltant.offsetLeft;
    const walk = (x - startX) * 2;
    scrollContainerConsltant.scrollLeft = scrollLeft - walk;
});

// company section
scrollContainerCompany.addEventListener("mousedown", (e) => {
    isDown = true;
    scrollContainerCompany.classList.add("active");
    startX = e.pageX - scrollContainerCompany.offsetLeft;
    scrollLeft = scrollContainerCompany.scrollLeft;
});

scrollContainerCompany.addEventListener("mouseleave", () => {
    isDown = false;
    scrollContainerCompany.classList.remove("active");
});

scrollContainerCompany.addEventListener("mouseup", () => {
    isDown = false;
    scrollContainerCompany.classList.remove("active");
});

scrollContainerCompany.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - scrollContainerCompany.offsetLeft;
    const walk = (x - startX) * 2;
    scrollContainerCompany.scrollLeft = scrollLeft - walk;
});