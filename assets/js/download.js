document.addEventListener("DOMContentLoaded", function () {
  const tabBtns = document.querySelectorAll(".tab-btn");
  const panels = document.querySelectorAll(".tab-panel");

  tabBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      tabBtns.forEach((b) => b.classList.remove("active"));

      panels.forEach((p) => p.classList.remove("active"));

      this.classList.add("active");

      const targetId = this.getAttribute("data-tab");
      document.getElementById(targetId).classList.add("active");
    });
  });
});
