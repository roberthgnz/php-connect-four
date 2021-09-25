let cols = document.querySelectorAll(".col");

cols.forEach((col) => {
  col.addEventListener("mouseover", function ({ target }) {
    let emptyRows = [];
    if (target.classList.contains("col")) {
      Array.from(target.children).forEach((row) => {
        if (row.classList.contains("e")) emptyRows.push(row);
      });
    }
    let last = emptyRows.length;
    if (target.children[last]) target.children[last].classList.add("empty");
  });
  col.addEventListener("click", ({ currentTarget }) => {
    const col = currentTarget.getAttribute("data-col");
    location.href = `game.php?col=${col}`;
  });
});
